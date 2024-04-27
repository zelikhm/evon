<?php

namespace App\Observers;

use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\House;
use Carbon\Carbon;

class FlatObserver
{
    /**
     * Handle the FlatAdmin "created" event.
     *
     * @param  \App\Models\FlatAdmin  $flatModel
     * @return void
     */
    public function created(Flat $flatModel)
    {
        $frame = Frame::where('id', $flatModel->frame_id)->first();

        House::where('id', $frame->house_id)->update([
          'updated_at' => Carbon::now()->addHours(3),
        ]);
    }

    /**
     * Handle the FlatAdmin "updated" event.
     *
     * @param  \App\Models\FlatAdmin  $flatModel
     * @return void
     */
    public function updated(Flat $flatModel)
    {
      $frame = Frame::where('id', $flatModel->frame_id)->first();

      House::where('id', $frame->house_id)->update([
        'updated_at' => Carbon::now()->addHours(3),
      ]);
    }

    /**
     * Handle the FlatAdmin "deleted" event.
     *
     * @param  \App\Models\FlatAdmin  $flatModel
     * @return void
     */
    public function deleted(Flat $flatModel)
    {
        FlatImagesModel::where('flat_id', $flatModel->id)->delete();
    }

    /**
     * Handle the FlatAdmin "restored" event.
     *
     * @param  \App\Models\FlatAdmin  $flatModel
     * @return void
     */
    public function restored(Flat $flatModel)
    {
        //
    }

    /**
     * Handle the FlatAdmin "force deleted" event.
     *
     * @param  \App\Models\FlatAdmin  $flatModel
     * @return void
     */
    public function forceDeleted(Flat $flatModel)
    {
        //
    }
}
