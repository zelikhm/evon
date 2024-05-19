<?php

namespace App\Http\Controllers\House;

use App\Http\Controllers\Controller;
use App\Jobs\FlatImage;
use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\House;
use App\Services\Houses\FlatService;
use Illuminate\Http\Request;

class FlatController extends Controller
{

  private $flatService;

  public function __construct(FlatService $flatService)
  {
    $this->flatService = $flatService;
  }

  /**
   * create flat for frame
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function create(Request $request)
  {
    $this->flatService->create($request);

    $frame = Frame::where('id', $request->frame_id)->first();

    return response()->json($this->getHouse($frame->house_id), 200);
  }

  /**
   * deleted flat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function delete(Request $request)
  {
    Flat::where('id', $request->flat_id)->delete();

    return response()->json('deleted', 205);
  }

  /**
   * edit flat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function edit(Request $request)
  {
//    if ($request->image_up === 'null') {
//      $imageUp = null;
//    } else if ($request->image_up) {
//      $imageUp = time() . '.flat.' . $request->file('image_up')->getClientOriginalExtension();
//      $request->image_up->move(public_path('/storage/buffer'), $imageUp);
//      $this->waterMark($imageUp, 'storage/flat/', false);
//      $imageUp = '/storage/flat/' . $imageUp;
//    } else {
//      $flat = Flat::where('id', $request->flat_id)->first();
//      if ($flat->imageUp !== null) {
//        $imageUp = $flat->imageUp;
//      }
//    }
//
//    if ($request->image_down === 'null') {
//      $imageDown = null;
//    } else if ($request->image_down) {
//      $imageDown = (time() + 100) . '.flat.' . $request->file('image_down')->getClientOriginalExtension();
//      $request->image_down->move(public_path('/storage/buffer'), $imageDown);
//      $this->waterMark($imageDown, 'storage/flat/', false);
//      $imageDown = '/storage/flat/' . $imageDown;
//    } else {
//      $flat = Flat::where('id', $request->flat_id)->first();
//      if ($flat->imageDown !== null) {
//        $imageDown = $flat->imageDown;
//      }
//    }

    $this->flatService->edit($request);

    House::where('id', $request->house_id)->update([
      'active' => 0,
    ]);

    return response()->json($this->getHouse($request->house_id), 200);
  }

  /**
   * edit status for flat
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function editStatus(Request $request)
  {
    Flat::where('id', $request->flat_id)->update([
      'status' => $request->status,
    ]);

    House::where('id', $request->house_id)->update([
      'active' => 0,
    ]);

    return response()->json($this->getHouse($request->house_id), 200);
  }
}
