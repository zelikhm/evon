<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\CompilationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use function Ramsey\Collection\Map\replace;

class BuilderCompilationController extends Controller
{
    public function compilation($slug, CompilationService $compilationService)
    {
      $link = base64_decode($slug);

      $house = $compilationService->get($link);

      if(Auth::check()) {
        $user = $this->getUser();
      } else {
        $user = [];
      }

      $compilation = [
        'company' => null,
        'user' => User::where('id', $house->user_id)->first(),
        'isVisible' => 1,
      ];

      return Inertia::render('Builder/Compilation', [
        'house' => $house,
        'compilation' => $compilation,
        'city_array' => $this->getCity(),
        'area_array' => $this->getRegions(),
        'user' => $user,
        'dops' => $this->getDop(),
        'infos' => $this->getInfo(),
        'client' => $link[1] == 'partner' ? false : true,

      ]);
    } //end

  /**
   * get link for builder compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getLink(Request $request) {

      $link = $request->slug;

      return response()->json(env('APP_URL') . 'compilation/builder/compilation/' .  base64_encode($link), 200);
  } //end
}
