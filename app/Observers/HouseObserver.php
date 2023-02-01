<?php

namespace App\Observers;

use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\HouseCharacteristicsModel;
use App\Models\Builder\HouseFilesModel;
use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseModel;
use App\Models\Builder\HouseNewsModel;
use App\Models\Builder\HouseSupportModel;
use App\Models\Builder\HouseViewsModel;
use App\Models\User\CompilationInfoModel;

class HouseObserver
{
  /**
   * Handle the HouseModel "created" event.
   *
   * @param \App\Models\HouseModel $houseModel
   * @return void
   */
  public function created(HouseModel $houseModel)
  {
    //
  }

  /**
   * Handle the HouseModel "updated" event.
   *
   * @param \App\Models\HouseModel $houseModel
   * @return void
   */
  public function updated(HouseModel $houseModel)
  {
    //
  }

  /**
   * Handle the HouseModel "deleted" event.
   *
   * @param \App\Models\HouseModel $houseModel
   * @return void
   */
  public function deleted(HouseModel $houseModel)
  {
    HouseViewsModel::where('house_id', $houseModel->id)->delete();
    HouseImagesModel::where('house_id', $houseModel->id)->delete();
    HouseNewsModel::where('house_id', $houseModel->id)->delete();
    HouseSupportModel::where('house_id', $houseModel->id)->delete();
    HouseCharacteristicsModel::where('house_id', $houseModel->id)->delete();
    HouseFilesModel::where('house_id', $houseModel->id)->delete();
    FrameModel::where('house_id', $houseModel->id)->delete();
    CompilationInfoModel::where('house_id', $houseModel->id)->delete();
  }

  /**
   * Handle the HouseModel "restored" event.
   *
   * @param \App\Models\HouseModel $houseModel
   * @return void
   */
  public function restored(HouseModel $houseModel)
  {
    //
  }

  /**
   * Handle the HouseModel "force deleted" event.
   *
   * @param \App\Models\HouseModel $houseModel
   * @return void
   */
  public function forceDeleted(HouseModel $houseModel)
  {
    //
  }
}
