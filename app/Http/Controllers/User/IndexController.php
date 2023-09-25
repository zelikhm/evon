<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseSupportModel;
use App\Models\User;
use App\Rules\Password;
use App\Services\User\RegisterService;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

      return response()->json(User::where('token', $request->token)
        ->with(['company', 'subscriptionInfo'])
        ->first(), 200);

    } else {

      return response()->json('not auth', 401);

    }
  }

  /**
   * set link
   * @param Request $request
   */

  public function setLink(Request $request) {

    if($this->checkToken($request->token)) {

      User\SubscriptionModel::where('id', $request->id)->update(['free_link' => 0]);

      return response()->json(true, 200);
    } else {

      return response()->json('not auth', 401);
    }

  }

  /**
   * save lang
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function lang(Request $request) {

    if ($this->checkToken($request->token)) {

      User::where('id', $request->id)->update(['lang' => $request->lang]);

      return response()->json($request->lang, 200);
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
        'phone' => $request->phone,
        'description' => $request->description,
        'email' => $request->email,
        'image' => $imageName,
      ]);

      return response()->json(User::where('id', $request->user_id)->with(['company'])->first(), 200);

    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * send register
   * @param Request $request
   */

  public function sendRegister(Request $request, RegisterService $registerService) {

    $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'type_id' => 'required'
    ]);

    $status = $registerService->startRegister($request->all());

    if($status['status'] === false) {
      return Inertia::location('/?registration=false&message=1&builder=' . $status['builder']);
    } else {
      return Inertia::location('/?registration=true&message=0&builder=' . $status['builder']);
    }

  }

  /**
   * send email user
   * @param $email
   * @param $language
   */

  public function sendUserEmail($email, $language) {


  }
}
