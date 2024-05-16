<?php


namespace App\Services\Houses;


use App\Models\Builder\HouseImage;
use App\Models\Builder\HouseMainImage;
use App\Models\Builder\House;
use App\Models\Builder\HouseView;
use App\Models\Builder\Info\Structure;
use App\Models\Builder\Info\Type;
use App\Models\User\Favorite;
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
    $this->dops_array = Type::all();
    $this->infos_array = Structure::all();

  } //end

  public function getHouseId($id)
  {
    // TODO: Implement getHouseId() method.
  }

  public function getHouseSlug($slug)
  {
    // TODO: Implement getHouseSlug() method.
  }

  public function getCountHouses($type)
  {
    return House::where('visible', 1)
      ->orderBy('updated_at', 'DESC')
      ->where('active', 2)
      ->join('house_characteristics', 'house_characteristics.house_id', 'houses.id')
      ->select('houses.*')
      ->where('house_characteristics.type', $type)
      ->distinct()
      ->count();
  }

  public function filtration($options, $plan, $city, $area, $price, $date_build, $squad, $name_builder, $locations, $infostructures, $dops)
  {

  }

  /**
   * get houses
   * @param $type
   * @param $limit
   * @param $dop
   * @param $offset
   * @return mixed
   */

  public function getHouses($type, $limit, $dop, $offset)
  {
    $houses = House::where('house_characteristics.type', $type)
      ->join('house_characteristics', 'house_characteristics.house_id', 'houses.id')
      ->orderBy('updated_at', 'DESC')
      ->where('active', 2)
      ->where('visible', 1)
      ->select('houses.*')
      ->distinct()
      ->with(['flats', 'user', 'mainImage']);

    if ($limit) {
      $houses->limit($limit);
    }

    if ($offset) {
      $houses->offset($offset);
    }

    foreach ($houses as $house) {
      $house->description = [];
      $house->description_en = [];
      $house->description_tr = [];

      if ($house->mainImage === null) {
        $house->image = HouseImage::where('house_id', $house->id)->first();
      } else {
        $house->image = $house->mainImage;
      }

      if ($dop) {
        $house->dop_array = $this->getDopForHouse($house->info->dop);
        $house->info_array = $this->getInfoForHouse($house->info->info);
      }

      $house->popular = HouseView::where('house_id', $house->id)->count() > 30;

      $house->maxPrice = (int)($house->flats->max('price'));
      $house->minPrice = (int)($house->flats->min('price'));

      $house->maxSquare = (int)($house->flats->max('square'));
      $house->minSquare = (int)($house->flats->min('square'));

      $house->builder = $house->user->first_name;

      $favorite = Favorite::where('user_id', Auth::id())
        ->where('house_id', $house->id)
        ->first();

      $house->favorite = $favorite !== null;

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

  public function mainImage($id, $image, $type): void
  {
    if ($image) {
      $image_name = time() . '.' . $image->getClientOriginalName();
      $image->move(public_path('/storage/buffer'), $image_name);
      $this->imageService->add($id, 2, $image, $image_name);
    } else {
      $image_name = '';
    }

    if ($type === 0) {
      HouseMainImage::create([
        'house_id' => $id,
        'image' => $image_name,
      ]);
    } else {
      $image = HouseMainImage::where('house_id', $id)->first();

      if ($image !== null) {
        HouseMainImage::where('house_id', $id)
          ->update([
            'image' => $image_name
          ]);
      } else {
        HouseMainImage::create([
          'house_id' => $id,
          'image' => $image_name
        ]);
      }
    }


  } //end
}
