<?php

namespace App\Observers;

use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\House;
use Carbon\Carbon;

class FrameObserver
{
    /**
     * Handle the FrameService "created" event.
     *
     * @param  \App\Models\FrameService  $frameModel
     * @return void
     */
    public function created(Frame $frameModel)
    {
        House::where('id', $frameModel->house_id)->update([
          'active' => 0,
        ]);
    }

    /**
     * Handle the FrameService "updated" event.
     *
     * @param  \App\Models\FrameService  $frameModel
     * @return void
     */
    public function updated(Frame $frameModel)
    {
      House::where('id', $frameModel->house_id)->update([
        'active' => 0,
        'updated_at' => Carbon::now(),
      ]);
    }

    /**
     * Handle the FrameService "deleted" event.
     *
     * @param  \App\Models\FrameService  $frameModel
     * @return void
     */
    public function deleted(Frame $frameModel)
    {
        Flat::where('frame_id', $frameModel->id)->delete();
    }

    /**
     * Handle the FrameService "restored" event.
     *
     * @param  \App\Models\FrameService  $frameModel
     * @return void
     */
    public function restored(Frame $frameModel)
    {
        //
    }

    /**
     * Handle the FrameService "force deleted" event.
     *
     * @param  \App\Models\FrameService  $frameModel
     * @return void
     */
    public function forceDeleted(Frame $frameModel)
    {
        //
    }
}
