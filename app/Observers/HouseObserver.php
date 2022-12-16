<?php

namespace App\Observers;

use App\Models\HouseModel;

class HouseObserver
{
    /**
     * Handle the HouseModel "created" event.
     *
     * @param  \App\Models\HouseModel  $houseModel
     * @return void
     */
    public function created(HouseModel $houseModel)
    {
        //
    }

    /**
     * Handle the HouseModel "updated" event.
     *
     * @param  \App\Models\HouseModel  $houseModel
     * @return void
     */
    public function updated(HouseModel $houseModel)
    {
        //
    }

    /**
     * Handle the HouseModel "deleted" event.
     *
     * @param  \App\Models\HouseModel  $houseModel
     * @return void
     */
    public function deleted(HouseModel $houseModel)
    {
        //
    }

    /**
     * Handle the HouseModel "restored" event.
     *
     * @param  \App\Models\HouseModel  $houseModel
     * @return void
     */
    public function restored(HouseModel $houseModel)
    {
        //
    }

    /**
     * Handle the HouseModel "force deleted" event.
     *
     * @param  \App\Models\HouseModel  $houseModel
     * @return void
     */
    public function forceDeleted(HouseModel $houseModel)
    {
        //
    }
}
