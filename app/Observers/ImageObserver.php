<?php

namespace App\Observers;

use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseModel;

class ImageObserver
{
    /**
     * Handle the HouseImagesModel "created" event.
     *
     * @param  \App\Models\HouseImagesModel  $houseImagesModel
     * @return void
     */
    public function created(HouseImagesModel $houseImagesModel)
    {
      HouseModel::where('id', $houseImagesModel->house_id)->update([
        'active' => 0,
      ]);
    }

    /**
     * Handle the HouseImagesModel "updated" event.
     *
     * @param  \App\Models\HouseImagesModel  $houseImagesModel
     * @return void
     */
    public function updated(HouseImagesModel $houseImagesModel)
    {
      HouseModel::where('id', $houseImagesModel->house_id)->update([
        'active' => 0,
      ]);
    }

    /**
     * Handle the HouseImagesModel "deleted" event.
     *
     * @param  \App\Models\HouseImagesModel  $houseImagesModel
     * @return void
     */
    public function deleted(HouseImagesModel $houseImagesModel)
    {
        //
    }

    /**
     * Handle the HouseImagesModel "restored" event.
     *
     * @param  \App\Models\HouseImagesModel  $houseImagesModel
     * @return void
     */
    public function restored(HouseImagesModel $houseImagesModel)
    {
        //
    }

    /**
     * Handle the HouseImagesModel "force deleted" event.
     *
     * @param  \App\Models\HouseImagesModel  $houseImagesModel
     * @return void
     */
    public function forceDeleted(HouseImagesModel $houseImagesModel)
    {
        //
    }
}
