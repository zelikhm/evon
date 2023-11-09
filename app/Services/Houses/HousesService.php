<?php


namespace App\Services\Houses;


use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseMainImageModel;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseViewsModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use App\Models\User\FavoritesModel;
use App\Services\Image\ImageService;
use Illuminate\Support\Facades\Auth;

class HousesService implements HousesInterface
{

  private $dops_array;
  private $infos_array;
  private $imageService;

  /**
   * render array for info and dop
   * HousesService constructor.
   * @param ImageService $imageService
   */

  public function __construct(ImageService $imageService)
  {
    $this->imageService = $imageService;
    $this->dops_array = TypesModel::all();
    $this->infos_array = StructureModel::all();

  } //end

  public function getHouseId($id)
  {
    // TODO: Implement getHouseId() method.
  }

  public function getHouseSlug($slug)
  {
    // TODO: Implement getHouseSlug() method.
  }

  /**
   * get houses
   * @param $type
   * @param $limit
   * @param $dop
   * @param null $count
   * @return mixed
   */

  public function getHouses($type, $limit, $dop, $count = null)
  {
    if ($limit) {
      $houses = HouseModel::where('visible', 1)
        ->orderBy('updated_at', 'DESC')
        ->where('active', 2)
        ->join('house_characteristics_models', 'house_characteristics_models.house_id', 'house_models.id')
        ->select('house_models.*')
        ->where('house_characteristics_models.type', $type)
        ->distinct()
        ->with(['flats', 'user', 'mainImage'])
        ->limit($count !== null ? $count : 30)
        ->get();
    } else {
      $houses = HouseModel::where('visible', 1)
        ->orderBy('updated_at', 'DESC')
        ->where('active', 2)
        ->join('house_characteristics_models', 'house_characteristics_models.house_id', 'house_models.id')
        ->select('house_models.*')
        ->where('house_characteristics_models.type', $type)
        ->distinct()
        ->with(['flats', 'user', 'mainImage'])
        ->get();
    }

    foreach ($houses as $house) {

      $house->description = [];
      $house->description_en = [];
      $house->description_tr = [];

      if($house->mainImage === null) {
        $house->image = HouseImagesModel::where('house_id', $house->id)->first();
      } else {
        $house->image = $house->mainImage;
      }

      if ($dop) {
        $house->dop_array = $this->getDopForHouse($house->info->dop);
        $house->info_array = $this->getInfoForHouse($house->info->info);
      }

      $house->popular = HouseViewsModel::where('house_id', $house->id)->count() > 30;

      $house->maxPrice = (int)($house->flats->max('price'));
      $house->minPrice = (int)($house->flats->min('price'));

      $house->maxSquare = (int)($house->flats->max('square'));
      $house->minSquare = (int)($house->flats->min('square'));

      $house->builder = $house->user->first_name;

      $favorite = FavoritesModel::where('user_id', Auth::id())
        ->where('house_id', $house->id)
        ->first();

      if ($favorite !== null) {
        $house->favorite = true;
      } else {
        $house->favorite = false;
      }

    }

    return $houses;
  } //end

  /**
   * render dop for house
   * @param $dops
   * @return array|\Illuminate\Database\Eloquent\Collection
   */

  private function getDopForHouse($dops)
  {

    if ($dops !== null) {
      return $this->dops_array->whereIn('id', json_decode($dops));
    } else {
      return [];
    }

  } //end

  /**
   * render infos for house
   * @param $infos
   * @return array|\Illuminate\Database\Eloquent\Collection
   */

  private function getInfoForHouse($infos)
  {

    if ($infos !== null) {
      return $this->infos_array->whereIn('id', json_decode($infos));
    } else {
      return [];
    }

  } //end

  /**
   * added or edit main image for house
   * 0 - add
   * 1 - edit
   * @param $id
   * @param $image
   * @param $type
   */

  public function mainImage($id, $image, $type):void
  {
    if($image) {
      $image_name = time() . '.' . $image->getClientOriginalName();
      $image->move(public_path('/storage/buffer'), $image_name);
      $this->imageService->add($id, 2, $image, $image_name);
    } else {
      $image_name = '';
    }

    if($type === 0) {
      HouseMainImageModel::create([
        'house_id' => $id,
        'image' => $image_name,
      ]);
    } else {
      $image = HouseMainImageModel::where('house_id', $id)->first();

      if($image !== null) {
        HouseMainImageModel::where('house_id', $id)
          ->update([
            'image' => $image_name
          ]);
      } else {
        HouseMainImageModel::create([
            'house_id' => $id,
            'image' => $image_name
          ]);
      }
    }


  } //end
}
