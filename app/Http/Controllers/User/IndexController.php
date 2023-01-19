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

      if($request->image !== 'undefined') {
        $imageName = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('/storage/user'), $imageName);
      } else {
       $user = User::where('id', $request->user_id)->first();
       $imageName = $user->image;
      }

      User::where('id', $request->user_id)->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'status' => $request->status,
        'link' => $request->link,
        'description' => $request->description,
        'email' => $request->email,
        'image' => $imageName,
      ]);
      return response()->json($request->image, 200);
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
