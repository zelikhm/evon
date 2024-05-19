<?php

namespace App\Services\Houses;

use App\Models\Builder\Flat\Frame;
use Carbon\Carbon;

class FrameService
{
  /**
   * create frame
   * @param $data
   * @return mixed
   */

  public function create($data)
  {
    $frame = Frame::create([
      'house_id' => $data->house_id,
      'name' => $data->name,
    ]);

    return $frame;
  }

  /**
   * edit frame
   * @param $data
   * @return void
   */

  public function edit($data)
  {
    Frame::where('id', $data->frame_id)
      ->update([
        'name' => $data->name,
      ]);
  }
}
