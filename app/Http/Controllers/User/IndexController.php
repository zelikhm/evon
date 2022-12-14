<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{

  /**
   * get user
   * @param Request $request
   * @return mixed
   */

  public function get(Request $request)
  {
    if ($request->token === env('TOKEN')) {

      return User::where('id', $request->user_id)
        ->with(['company'])
        ->first();

    } else {

      return response()->json('not auth', 401);

    }
  }

  /**
   * edit user
   * @param Request $request
   */

  public function edit(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      User::where('id', $request->user_id)->update([
        'first_name' => $request->name,
        'status' => $request->status,
        'link' => $request->link,
        'description' => $request->description,
        'email' => $request->email,
        'image' => $request->image,
      ]);
      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * added company for user
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addedCompany(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      User\CompanyModel::create([
        'user_id' => $request->user_id,
        'title' => $request->title,
        'image' => $request->image,
        'banner' => $request->banner
      ]);

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * edit company for user
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editCompany(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      User\CompanyModel::where('user_id', $request->user_id)
        ->where('id', $request->id)
        ->update([
          'title' => $request->title,
          'image' => $request->image,
          'banner' => $request->banner,
        ]);

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }
}
