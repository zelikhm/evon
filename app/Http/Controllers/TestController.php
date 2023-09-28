<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index() {
      return Inertia::render('TestApp');
    }

    public function save(Request $request) {

      $image = time() . '.' . $request->image->getClientOriginalName();
      $request->image->move(public_path('/storage/buffer'), $image);

      $response = Http::attach(
        'image', $request->image, $image
      )->post('http://evon.image.service/api/save', [
//        'image' => $request->file('image'),
        'type' => 0,
        'image_id' => 0
      ]);

      dd(json_decode($response));
    }
}
