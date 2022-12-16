<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MainInfo;
use App\Models\User\CompilationInfoModel;
use App\Models\User\CompilationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CompilationController extends Controller
{

  use MainInfo;

  public function index()
  {
    return Inertia::render('', [
      'compilation' => $this->getCompilation(Auth::id()),
      'user' => Auth::user(),
      'notification' => $this->getNotification(),
    ]);

  }

  public function show($id)
  {

  }

  public function edit($id)
  {

  }

  /**
   * create compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      $compl = CompilationModel::create([
        'user_id' => $request->user_id,
        'title' => $request->title,
        'description' => $request->description,
        'isVisible' => $request->isVisible,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json($compl->id, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * add house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function addHouse(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      CompilationInfoModel::create([
        'compilation_id' => $request->compilation_id,
        'house_id' => $request->house_id,
        'created_at' => Carbon::now()->addHour(3),
        'updated_at' => Carbon::now()->addHour(3),
      ]);

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }

  /**
   * delete compilation
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {
    if ($request->token === env('TOKEN')) {
      CompilationInfoModel::where('compilation_id', $request->id)
        ->delete();
      CompilationModel::where('id', $request->id)
        ->delete();

      return response()->json(true, 200);
    } else {
      return response()->json('not auth', 401);
    }
  }
}
