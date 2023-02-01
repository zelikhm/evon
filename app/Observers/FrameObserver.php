<?php

namespace App\Observers;

use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\HouseModel;

class FrameObserver
{
    /**
     * Handle the FrameModel "created" event.
     *
     * @param  \App\Models\FrameModel  $frameModel
     * @return void
     */
    public function created(FrameModel $frameModel)
    {
        HouseModel::where('id', $frameModel->house_id)->update([
          'active' => 0,
        ]);
    }

    /**
     * Handle the FrameModel "updated" event.
     *
     * @param  \App\Models\FrameModel  $frameModel
     * @return void
     */
    public function updated(FrameModel $frameModel)
    {
      HouseModel::where('id', $frameModel->house_id)->update([
        'active' => 0,
      ]);
    }

    /**
     * Handle the FrameModel "deleted" event.
     *
     * @param  \App\Models\FrameModel  $frameModel
     * @return void
     */
    public function deleted(FrameModel $frameModel)
    {
        FlatModel::where('frame_id', $frameModel->id)->delete();
    }

    /**
     * Handle the FrameModel "restored" event.
     *
     * @param  \App\Models\FrameModel  $frameModel
     * @return void
     */
    public function restored(FrameModel $frameModel)
    {
        //
    }

    /**
     * Handle the FrameModel "force deleted" event.
     *
     * @param  \App\Models\FrameModel  $frameModel
     * @return void
     */
    public function forceDeleted(FrameModel $frameModel)
    {
        //
    }
}
