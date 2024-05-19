<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\House;
use App\Services\Houses\FrameService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrameController extends Controller
{
  private $frameService;

  public function __construct(FrameService $frameService)
  {
    $this->frameService = $frameService;
  }

  /**
   * create frame for house
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request)
  {
    $this->frameService->create($request);

    return response()->json(Frame::where('house_id', $request->house_id)->with(['flats'])->get(), 200);
  }

  /**
   * edit frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function edit(Request $request)
  {
    $this->frameService->edit($request);

    House::where('id', $request->house_id)->update([
      'active' => 0,
    ]);

    return response()->json(Frame::where('house_id', $request->house_id)->with(['flats'])->get(), 200);
  }

  /**
   * deleted frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {
    Frame::where('id', $request->frame_id)->delete();

    return response()->json('deleted', 205);
  }
}
