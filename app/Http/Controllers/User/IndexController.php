<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthCheck;
use App\Http\Traits\MainInfo;
use App\Models\Builder\HouseSupport;
use App\Models\Log\UtmStat;
use App\Models\User;
use App\Rules\Password;
use App\Services\Mail\RegisterMailService;
use App\Services\User\RegisterService;
use App\Services\User\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{

  use AuthCheck;

  /**
   * set trial
   * @param UserService $userService
   * @return \Symfony\Component\HttpFoundation\Response
   */

  public function trial(Request $request) {
    $user = User::where('id', $request->user_id ? $request->user_id : Auth::id())
      ->with(['subscription'])
      ->first();

    if($user->subscription === null && $user->free_subscription === 1) {
      User\Subscription::create([
        'user_id' => $request->user_id ? $request->user_id : Auth::id(),
        'active' => 1,
        'finished_at' => Carbon::now()->addDays(20),
        'free' => 0,
        'free_link' => 0,
      ]);

      $user->free_subscription = 0;
      $user->save();

      return $request->isApi ? response()->json(true, 200) : Inertia::location('/profile?setTrial=1');
    } else {
      return $request->isApi ? response()->json(false, 401) : Inertia::location('/profile?setTrial=0');
    }
  } //end

  /**
   * get user
   * @param Request $request
   * @return mixed
   */

  public function get(Request $request)
  {
    if ($this->checkToken($request->token)) {

      $user = User::where('token', $request->token)
        ->with(['company', 'subscriptionInfo', 'verification'])
        ->first();

      $user->hasVerification = $user->isVerification();

      return response()->json($user, 200);

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

      User\Subscription::where('id', $request->id)->update(['free_link' => 0]);

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

  public function sendRegister(Request $request, RegisterService $registerService, RegisterMailService $registerMailService) {

    $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'type_id' => 'required'
    ]);

    $status = $registerService->startRegister($request->all());

    if($request->type_id < 3)
    {
      $registerMailService->sendMailUser($request);
    }

    $registerMailService->sendMailAdmin($request);

    if($status['status'] === false) {
      return $request->isApi === true ? response()-json(true, 200) : Inertia::location('/?registration=false&message=1&builder=' . $status['builder'] . '&language='.$request->language_id);
    } else {
      return $request->isApi === true ? response()-json(false, 400) : Inertia::location('/?registration=true&message=0&builder=' . $status['builder'] . '&language='.$request->language_id);
    }

  }

  /**
   * edit utm for reg
   * @param $ip
   * @return bool
   */

  public function utm($ip)
  {
    try {
      UtmStat::where('ip', $ip)
        ->update([
          'is_reg' => 1,
        ]);

      return true;
    }catch (\Exception $exception) {
      return false;
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
