<?php


namespace App\Services\User;


use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompilationService implements CompilationInterface
{

  use MainInfo;
  use AuthCheck;

  /**
   * get house for compilation builder
   * @param $slug
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
   */

    public function get($slug)
    {
      HouseModel::where('slug', $slug)->firstOrFail();

      $house = $this->getHouseSlug($slug);

      $house->company = User::where('id', $house->user_id)->first();

      return $house;
    } //end
}
