<?php

namespace App\Http\Controllers;

use App\Http\Traits\MainInfo;
use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\HouseModel;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MainInfo;

    public function main() {

      return Inertia::render('AppPromo', [
        'userInfo' => $this->getUser(),
        'count_flats' => FlatModel::count(),
        'count_house' => HouseModel::count(),
        'count_people' => User::where('role', 0)->count() < 150 ? 150 : User::where('role', 0)->count(),
        'block_show' => false,
      ]);
    }

    public function promo() {

      return Inertia::render('AppPromo', [
        'userInfo' => $this->getUser(),
        'count_flats' => FlatModel::count(),
        'count_house' => HouseModel::count(),
        'count_people' => User::where('role', 0)->count() < 150 ? 150 : User::where('role', 0)->count(),
        'block_show' => true,
      ]);
    }
}
