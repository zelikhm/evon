<?php

namespace App\Http\Controllers;

use App\Services\Image\ImageService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
  public function index()
  {
    return Inertia::render('TestApp');
  }

  public function save(Request $request, ImageService $imageService)
  {

    $image = time() . '.' . $request->image->getClientOriginalName();
    $request->image->move(public_path('/storage/buffer'), $image);

    $status = $imageService->add(0, 0, $request->image, $image);

    dd($status);
  }

  public function test()
  {

  }
}
