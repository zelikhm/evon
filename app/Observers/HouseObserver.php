<?php

namespace App\Observers;

use App\Models\Builder\Flat\Frame;
use App\Models\Builder\HouseCharacteristic;
use App\Models\Builder\HouseFile;
use App\Models\Builder\HouseImage;
use App\Models\Builder\House;
use App\Models\Builder\HouseNew;
use App\Models\Builder\HouseSupport;
use App\Models\Builder\HouseView;
use App\Models\User\CompilationInfo;
use App\Models\User\Favorite;

class HouseObserver
{
  /**
   * Handle the House "created" event.
   *
   * @param \App\Models\House $houseModel
   * @return void
   */
  public function created(House $houseModel)
  {
    //
  }

  /**
   * Handle the House "updated" event.
   *
   * @param \App\Models\House $houseModel
   * @return void
   */
  public function updated(House $houseModel)
  {
    //
  }

  /**
   * Handle the House "deleted" event.
   *
   * @param \App\Models\House $houseModel
   * @return void
   */
  public function deleted(House $houseModel)
  {
    HouseView::where('house_id', $houseModel->id)->delete();
    HouseImage::where('house_id', $houseModel->id)->delete();
    HouseNew::where('house_id', $houseModel->id)->delete();
    HouseSupport::where('house_id', $houseModel->id)->delete();
    HouseCharacteristic::where('house_id', $houseModel->id)->delete();
    HouseFile::where('house_id', $houseModel->id)->delete();
    Frame::where('house_id', $houseModel->id)->delete();
    CompilationInfo::where('house_id', $houseModel->id)->delete();
    Favorite::where('house_id', $houseModel->id)->delete();
  }

  /**
   * Handle the House "restored" event.
   *
   * @param \App\Models\House $houseModel
   * @return void
   */
  public function restored(House $houseModel)
  {
    //
  }

  /**
   * Handle the House "force deleted" event.
   *
   * @param \App\Models\House $houseModel
   * @return void
   */
  public function forceDeleted(House $houseModel)
  {
    //
  }
}
