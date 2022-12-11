<?php

namespace App\Http\Traits;

use App\Models\Builder\HouseModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
use App\Models\User\CompilationModel;

trait MainInfo {

  /**
   * get all houses
   * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
   */

  protected function getAllHouse() {
    return HouseModel::with(['info', 'supports', 'files', 'frames', 'images'])->get();
  }

  /**
   * get house
   * @param $id
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouse($id) {
    return HouseModel::with(['info', 'supports', 'files', 'frames', 'images'])
      ->where('id', $id)
      ->first();
  }

  /**
   * get house
   * @param $slug
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

  protected function getHouseSlug($slug) {
    return HouseModel::with(['info', 'supports', 'files', 'frames', 'images'])
      ->where('slug', $slug)
      ->first();
  }

  /**
   * get all compilation
   * @param $id
   * @return mixed
   */

  protected function getCompilation($id) {
    return CompilationModel::where('user_id', $id)->with(['values'])->get;
  }


  /**
   * get all dops
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function dops() {
    return TypesModel::all();
  }

  /**
   * get all infos
   * @return \Illuminate\Database\Eloquent\Collection
   */

  protected function infos() {
    return StructureModel::all();
  }
}
