<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseSupportModel;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{

  use AuthCheck;

  /**
   * get user
   * @param Request $request
   * @return mixed
   */

  public function get(Request $request)
  {
    if ($this->checkToken($request->token)) {

      return User::where('token', $request->token)
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
    if ($this->checkToken($request->token)) {

      if($request->image !== 'undefined') {
        $imageName = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('/storage/user'), $imageName);
        $imageName = '/storage/user/' . $imageName;
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

      return response()->json(User::where('id', $request->user_id)->first(), 200);

    } else {

      return response()->json('not auth', 401);

    }
  }
}
