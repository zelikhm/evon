<?php


namespace App\Services\Houses;


use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseViewsModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use App\Models\User\FavoritesModel;
use Illuminate\Support\Facades\Auth;

class HousesService implements HousesInterface
{

  private $dops_array;
  private $infos_array;

  /**
   * render array for info and dop
   * HousesService constructor.
   */

  public function __construct()
  {

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
        ->with(['info', 'files', 'frames', 'flats', 'user', 'news', 'images'])
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
        ->with(['flats', 'user'])
        ->get();
    }

    foreach ($houses as $house) {

      $house->description = [];
      $house->description_en = [];
      $house->description_tr = [];

//      $house->image = $this->getPhoto($house);

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
}
