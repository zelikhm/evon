<?php

namespace App\Services\Houses;

use App\Jobs\FlatImage;
use App\Models\Builder\Flat\Flat;

class FlatService
{
  private $flat;

  /**
   * create flat
   * @param $data
   * @return void
   */

  public function create($data)
  {
    $this->flat = \App\Models\Builder\Flat\Flat::create([
      'frame_id' => $data->frame_id,
      'number' => $data->number,
      'square' => $data->square,
      'count' => $data->count,
      'floor' => $data->floor,
      'status' => $data->status,
      'number_from_stairs' => $data->stairs,
      'price' => $data->price,
      'imageUp' => null,
      'imageDown' => null,
    ]);

    if ($data->image_up) {
      $this->imageUp($data);
    }

    if ($data->image_down) {
      $this->imageDown($data);
    }
  }

  /**
   * edit flat
   * @param $data
   * @return void
   */

  public function edit($data)
  {

    $this->flat = Flat::where('id', $data->flat_id)->first();

    Flat::where('id', $data->flat_id)->update([
        'number' => $data->number,
        'square' => $data->square,
        'count' => $data->count,
        'floor' => $data->floor,
        'status' => $data->status,
        'number_from_stairs' => $data->stairs,
        'price' => $data->price,
      ]);

    if($data->image_up === 'null') {
      $this->flat->imageUp = null;
      $this->flat->save();
    } else if ($data->image_up) {
      $this->imageUp($data);
    }

    if($data->image_down === 'null') {
      $this->flat->imageDown = null;
      $this->flat->save();
    } else if ($data->image_down) {
      $this->imageDown($data);
    }
  }

  /**
   * image up for flat
   * @param $data
   * @return void
   */

  public function imageUp($data)
  {
    $image = time() . '.flat.' . $data->image_up->getClientOriginalname();
    $data->image_up->move(public_path('/storage/buffer/'), $image);
    $this->flat->imageUp = '/storage/buffer/' . $image;
    $this->flat->save();

    FlatImage::dispatch(
      $this->flat->id,
      $image,
      0
    )->delay(2);
  }

  /**
   * image down for flat
   * @param $data
   * @return void
   */

  public function imageDown($data)
  {
    $image = time() . '.flat.' . $data->image_down->getClientOriginalname();
    $data->image_down->move(public_path('/storage/buffer/'), $image);
    $this->flat->imageDown = '/storage/buffer/' . $image;
    $this->flat->save();

    FlatImage::dispatch(
      $this->flat->id,
      $image,
      1
    )->delay(2);
  }
}
