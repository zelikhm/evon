<?php

namespace App\Http\Traits;

use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;

trait MainInfo {

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
