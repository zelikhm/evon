<?php

namespace App\Http\Controllers;

use App\Http\Traits\MainInfo;
use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseModel;
use App\Models\User;

use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MainInfo;

    public function main(Request $request) {

      if(Auth::check()) {
        return redirect('/houses');
      }

      return Inertia::render('AppPromo', [
        'userInfo' => $this->getUser(),
        'language_select' => $request->language,
        'registration' => $request->registration,
        'message' => $request->message,
        'builder' => $request->builder,
        'count_flats' => FlatModel::count(),
        'count_house' => HouseModel::count(),
        'count_people' => User::where('role', 0)->count() < 150 ? 150 : User::where('role', 0)->count(),
      ]);
    }

    public function promo(Request $request) {

      if(Auth::check()) {
        return redirect('/houses');
      }

      $ip = $request->ip();
      $currentUserInfo = Location::get($ip);

      if($ip !== '127.0.0.1') {
        if($currentUserInfo->countryCode === 'TR') {
          return Inertia::location('/');
        }
      }

      return Inertia::render('AppPromo', [
        'userInfo' => $this->getUser(),
        'count_flats' => FlatModel::count(),
        'count_house' => HouseModel::count(),
        'count_people' => User::where('role', 0)->count() < 150 ? 150 : User::where('role', 0)->count(),
        'block_show' => true,
      ]);
    }
}
