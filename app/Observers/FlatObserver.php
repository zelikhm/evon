<?php

namespace App\Observers;

use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\Flat\FlatModel;

class FlatObserver
{
    /**
     * Handle the FlatModel "created" event.
     *
     * @param  \App\Models\FlatModel  $flatModel
     * @return void
     */
    public function created(FlatModel $flatModel)
    {
        //
    }

    /**
     * Handle the FlatModel "updated" event.
     *
     * @param  \App\Models\FlatModel  $flatModel
     * @return void
     */
    public function updated(FlatModel $flatModel)
    {
        //
    }

    /**
     * Handle the FlatModel "deleted" event.
     *
     * @param  \App\Models\FlatModel  $flatModel
     * @return void
     */
    public function deleted(FlatModel $flatModel)
    {
        FlatImagesModel::where('flat_id', $flatModel->id)->delete();
    }

    /**
     * Handle the FlatModel "restored" event.
     *
     * @param  \App\Models\FlatModel  $flatModel
     * @return void
     */
    public function restored(FlatModel $flatModel)
    {
        //
    }

    /**
     * Handle the FlatModel "force deleted" event.
     *
     * @param  \App\Models\FlatModel  $flatModel
     * @return void
     */
    public function forceDeleted(FlatModel $flatModel)
    {
        //
    }
}
