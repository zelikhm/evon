<?php

namespace App\Http\Controllers;

use App\Http\Traits\AuthCheck;
use App\Models\User\ClientModel;
use Carbon\Carbon;
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

    if ($ip !== '127.0.0.1') {
      if ($currentUserInfo->countryCode === 'TR' && Auth::user()->openClient !== 1) {
        return Inertia::location('/');
      }
    }

    return Inertia::render('AppClients', [
      'user' => $this->getUser(),
      'client' => ClientModel::where('user_id', $this->getUser()->id)->get(),
    ]);
  }

  public function editStatus(Request $request) {

    if($this->checkToken($request->token)) {

      $client = ClientModel::where('id', $request->id)
        ->update([
          'status_client' => $request->status,
        ]);

      return response()->json($request->status ,200);

    } else {
      return response()->json('not auth', 401);
    }

  }

  /**
   * force delete client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {

    if ($this->checkToken($request->token)) {

      ClientModel::where('id', $request->client_id)
        ->where('user_id', $request->user_id)
        ->delete();

      $clients = ClientModel::where('user_id', $request->user_id)->get();

      return response()->json($clients, 200);
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
        'status_client' => 0,
        'comment' => $request->comment,
        'isJk' => $request->isJk,
        'target_buy' => $request->target_buy,
        'date_travel' => $request->date_travel,
        'buy_form_id' => $request->buy_form_id,
        'commission' => $request->isJk === 1 ? '75%' : '40%'
      ]);



      return response()->json(
        ClientModel::where('user_id', $request->user_id)
          ->get(), 200);
    } else {

      return response()->json('not auth', 401);
    }
  }

  /**
   * edit client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editClient(Request $request)
  {

    if ($this->checkToken($request->token)) {

      $client = ClientModel::where('id', $request->client_id)
        ->where('user_id', $request->user_id)
        ->update([
          'name' => $request->name,
          'phone' => $request->phone,
          'soc' => $request->soc,
          'client_text' => $request->client_text,
          'comment' => $request->comment,
          'isJk' => $request->isJk,
          'target_buy' => $request->target_buy,
          'date_travel' => $request->date_travel,
          'buy_form_id' => $request->buy_form_id,
          'commission' => $request->isJk === 1 ? '75%' : '40%'
        ]);

      return response()->json(
        ClientModel::where('user_id', $request->user_id)
          ->get(), 200);
    } else {

      return response()->json('not auth', 401);
    }
  }

  /**
   * get client
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function getClient(Request $request)
  {

    return response()->json(
      ClientModel::where(
        'user_id',
        $request->user_id
      )->get(),
      200
    );
  }
}
