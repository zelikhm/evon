<?php

namespace App\Http\Controllers;

use App\Http\Traits\AuthCheck;
use App\Models\User\ClientModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;

class HelpController extends Controller
{
  use AuthCheck;

  public function getHelp(Request $request)
  {

    $ip = $request->ip();
    $currentUserInfo = Location::get($ip);

    if($currentUserInfo->countryCode !== 'RU' && Auth::user()->openClient !== 1) {
      return Inertia::location('/');
    }

    return Inertia::render('AppClients', [
      'user' => $this->getUser(),
    ]);

  }

  /**
   * force delete client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request) {

    if($this->checkToken($request->token)) {

      ClientModel::where('id', $request->id)
        ->where('user_id', $request->user_id)
        ->delete();

      return response()->json(true, 205);

    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * send client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function sendClient(Request $request)
  {

    if ($this->checkToken($request->token)) {

      ClientModel::create([
        'user_id' => $request->user_id,
        'name' => $request->name,
        'phone' => $request->phone,
        'soc' => $request->soc,
        'client_text' => $request->client_text,
        'jk' => $request->jk,
        'status_client' => $request->status_client,
        'status_order' => $request->status_order,
        'comment' => $request->comment,
      ]);

      return response()->json(ClientModel::where('user_id', $request->user_id)->get(), 200);

    } else {

      return response()->json('not auth', 401);

    }
  }

  /**
   * edit client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editClient(Request $request) {

    if ($this->checkToken($request->token)) {

      ClientModel::where('id', $request->client_id)
        ->where('user_id', $request->user_id)
        ->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'soc' => $request->soc,
        'client_text' => $request->client_text,
        'jk' => $request->jk,
        'status_client' => $request->status_client,
        'status_order' => $request->status_order,
        'comment' => $request->comment,
      ]);

      return response()->json(ClientModel::where('user_id', $request->user_id)->get(), 200);

    } else {

      return response()->json('not auth', 401);

    }

  }

  /**
   * get client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getClient(Request $request) {

    return response()->json(
      ClientModel::where('user_id', $request->user_id
      )->get(), 200);

  }
}
