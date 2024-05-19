<?php

namespace App\Jobs;

use App\Models\Builder\HouseImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class Image implements ShouldQueue
{
  private $house_id;
  private $image_id;
  private $name;
  private $category;
  private $blur;

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(
    $image_id,
    $image_name,
    $blur = false
  )
  {
    $this->image_id = $image_id;
    $this->name = $image_name;
    $this->blur = $blur;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $image_source = HouseImage::where('id', $this->image_id)
      ->first();

    $image = ImageManager::imagick()->read(public_path() . $image_source->name);
    $image->place(
      public_path().'/images/watermark.png',
      'center',
    );
    $image->save(public_path() . '/storage/images/'.$this->name);

    if(File::exists(public_path() . $image_source->name)) {
      File::delete(public_path() . $image_source->name);
    }

    $image_source->name = '/storage/images/'.$this->name;
    $image_source->save();
  }
}
