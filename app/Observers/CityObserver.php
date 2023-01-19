<?php

namespace App\Observers;

use App\Models\Builder\Info\CityModel;
use App\Models\Builder\Info\RegionModel;

class CityObserver
{
    /**
     * Handle the CityModel "created" event.
     *
     * @param  \App\Models\CityModel  $cityModel
     * @return void
     */
    public function created(CityModel $cityModel)
    {
        //
    }

    /**
     * Handle the CityModel "updated" event.
     *
     * @param  \App\Models\CityModel  $cityModel
     * @return void
     */
    public function updated(CityModel $cityModel)
    {
        //
    }

    /**
     * Handle the CityModel "deleted" event.
     *
     * @param  \App\Models\CityModel  $cityModel
     * @return void
     */
    public function deleted(CityModel $cityModel)
    {
       RegionModel::where('city_id', $cityModel->id)->delete();
    }

    /**
     * Handle the CityModel "restored" event.
     *
     * @param  \App\Models\CityModel  $cityModel
     * @return void
     */
    public function restored(CityModel $cityModel)
    {
        //
    }

    /**
     * Handle the CityModel "force deleted" event.
     *
     * @param  \App\Models\CityModel  $cityModel
     * @return void
     */
    public function forceDeleted(CityModel $cityModel)
    {
        //
    }
}
