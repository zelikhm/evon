<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\Mail\RegisterMailService;
use App\Services\User\VerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VerificationController extends Controller
{

  /**
   * send verification
   * @param Request $request
   * @param VerificationService $verificationService
   * @return \Symfony\Component\HttpFoundation\Response
   */

    public function send(Request $request, VerificationService $verificationService, RegisterMailService $registerMailService)
    {

      if($request->isApi) {
        return response()->json($verificationService->sendVerification($request, $request->user_id, $registerMailService), 200);
      } else {
        if (!$request->link && !$request->file === null) {
          return Inertia::location(RouteServiceProvider::HOME);
        }

        $status = $verificationService->sendVerification($request, Auth::id(), $registerMailService);

        return $status === false ? Inertia::location('/profile?verification=0') : Inertia::location('/profile?verification=1');
      }

    } //end
}
