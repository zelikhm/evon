<?php

namespace App\Observers;

use App\Models\Builder\HouseImage;
use App\Models\Builder\House;
use Carbon\Carbon;

class ImageObserver
{
    /**
     * Handle the HouseImage "created" event.
     *
     * @param  \App\Models\HouseImage  $houseImagesModel
     * @return void
     */
    public function created(HouseImage $houseImagesModel)
    {
      House::where('id', $houseImagesModel->house_id)->update([
        'active' => 0,
      ]);
    }

    /**
     * Handle the HouseImage "updated" event.
     *
     * @param  \App\Models\HouseImage  $houseImagesModel
     * @return void
     */
    public function updated(HouseImage $houseImagesModel)
    {
      House::where('id', $houseImagesModel->house_id)->update([
        'active' => 0,
        'updated_at' => Carbon::now(),
      ]);
    }

    /**
     * Handle the HouseImage "deleted" event.
     *
     * @param  \App\Models\HouseImage  $houseImagesModel
     * @return void
     */
    public function deleted(HouseImage $houseImagesModel)
    {
        //
    }

    /**
     * Handle the HouseImage "restored" event.
     *
     * @param  \App\Models\HouseImage  $houseImagesModel
     * @return void
     */
    public function restored(HouseImage $houseImagesModel)
    {
        //
    }

    /**
     * Handle the HouseImage "force deleted" event.
     *
     * @param  \App\Models\HouseImage  $houseImagesModel
     * @return void
     */
    public function forceDeleted(HouseImage $houseImagesModel)
    {
        //
    }
}
