<?php

namespace App\Jobs;

use App\Models\Builder\Flat\Flat;
use App\Models\Builder\HouseImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class FlatImage implements ShouldQueue
{
  private $flat_id;
  private $image_name;
  private $side;

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(
    $flat_id,
    $image_name,
    $side
  )
  {
    $this->flat_id = $flat_id;
    $this->image_name = $image_name;
    $this->side = $side;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $image_source = Flat::where('id', $this->flat_id)
      ->first();

    if($this->side === 0) {
      $image = ImageManager::imagick()->read(public_path() . $image_source->imageUp);
    } else {
      $image = ImageManager::imagick()->read(public_path() . $image_source->imageDown);
    }

    $image->place(
      public_path() . '/images/watermark.png',
      'center',
    );
    $image->save(public_path() . '/storage/flats/' . $this->image_name);

    if (File::exists(public_path() . $image_source->name)) {
      File::delete(public_path() . $image_source->name);
    }

    if($this->side === 0) {
      $image_source->imageUp = '/storage/flats/' . $this->image_name;
      $image_source->save();
    } else {
      $image_source->imageDown = '/storage/flats/' . $this->image_name;
      $image_source->save();
    }
  }
}
