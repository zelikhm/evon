<?php

namespace App\Observers;

use App\Models\Builder\Info\City;
use App\Models\Builder\Info\Region;

class CityObserver
{
    /**
     * Handle the City "created" event.
     *
     * @param  \App\Models\City  $cityModel
     * @return void
     */
    public function created(City $cityModel)
    {
        //
    }

    /**
     * Handle the City "updated" event.
     *
     * @param  \App\Models\City  $cityModel
     * @return void
     */
    public function updated(City $cityModel)
    {
        //
    }

    /**
     * Handle the City "deleted" event.
     *
     * @param  \App\Models\City  $cityModel
     * @return void
     */
    public function deleted(City $cityModel)
    {
       Region::where('city_id', $cityModel->id)->delete();
    }

    /**
     * Handle the City "restored" event.
     *
     * @param  \App\Models\City  $cityModel
     * @return void
     */
    public function restored(City $cityModel)
    {
        //
    }

    /**
     * Handle the City "force deleted" event.
     *
     * @param  \App\Models\City  $cityModel
     * @return void
     */
    public function forceDeleted(City $cityModel)
    {
        //
    }
}
