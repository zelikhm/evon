<?php

namespace App\Providers;

use App\Http\Admin\Log\PaymentLogModel;
use App\Models\Builder\HouseFilesModel;
use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\Info\RegionModel;
use App\Models\Log\ImageLogModel;
use App\Models\News\AdminNewsModel;
use App\Models\TarifModel;
use App\Models\TarifRussionModel;
use App\Models\TraceModel;
use App\Models\User\ClientModel;
use App\Models\User\CompanyModel;
use App\Models\User\SubscriptionModel;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use AdminNavigation;

class AdminSectionsServiceProvider extends ServiceProvider
{

  /**
   * @var array
   */
  protected $sections = [
    \App\Models\User::class => 'App\Http\Admin\Users',
    //houses
    \App\Models\Builder\HouseModel::class => 'App\Http\Admin\House\House',
    \App\Models\Builder\Info\TypesModel::class => 'App\Http\Admin\House\Info\Type',
    \App\Models\Builder\Info\StructureModel::class => 'App\Http\Admin\House\Info\Structure',
    \App\Models\Builder\Info\CityModel::class => 'App\Http\Admin\House\Info\City',
    \App\Models\Builder\HouseCharacteristicsModel::class => 'App\Http\Admin\House\HouseCharacteristics',
    \App\Models\Builder\HouseNewsModel::class => 'App\Http\Admin\House\HouseNews',
    \App\Models\Builder\HouseSupportModel::class => 'App\Http\Admin\House\HouseSupport',
    \App\Models\Builder\Flat\FrameModel::class => 'App\Http\Admin\House\Flat\Frame',
    \App\Models\Builder\Flat\FlatModel::class => 'App\Http\Admin\House\Flat\Flat',
    HouseImagesModel::class => 'App\Http\Admin\House\Images',
    HouseFilesModel::class => 'App\Http\Admin\House\Files',
    //
    AdminNewsModel::class => 'App\Http\Admin\News\AdminNewsModel',
    CompanyModel::class => 'App\Http\Admin\Company',
    //
    TarifModel::class => 'App\Http\Admin\Tarif',
    TarifRussionModel::class => 'App\Http\Admin\TarifRussion',
    SubscriptionModel::class => 'App\Http\Admin\Subscription',
    TraceModel::class => 'App\Http\Admin\Trace',
    \App\Models\Log\PaymentLogModel::class => 'App\Http\Admin\Log\PaymentLogModel',
    //
    ClientModel::class => 'App\Http\Admin\Client',
    //
    ImageLogModel::class => 'App\Http\Admin\Log\ImageLog'
  ];

  /**
   * Register sections.
   *
   * @param \SleepingOwl\Admin\Admin $admin
   * @return void
   */
  public function boot(\SleepingOwl\Admin\Admin $admin)
  {
    $this->app->call([
      $this,
      'registerNavigation'
    ]);

    parent::boot($admin);
  }

  public function registerNavigation()
  {
    AdminNavigation::setFromArray([
      [
        'title' => 'Настройки',
        'id' => 'settings',
        'icon' => 'fab fa-dev',
        'priority' => 100,
      ],
      [
        'title' => 'Жилые комплексы',
        'id' => 'houses',
        'icon' => 'fab fa-dev',
        'priority' => 200,
      ],
      [
        'title' => 'Файлы',
        'id' => 'files',
        'icon' => 'fab fa-dev',
        'priority' => 300,
      ],
      [
        'title' => 'Подписки',
        'id' => 'subscription',
        'icon' => 'fab fa-dev',
        'priority' => 400,
      ],
      [
        'title' => 'Клиенты',
        'id' => 'client',
        'icon' => 'fab fa-dev',
        'priority' => 500,
      ],
      [
        'title' => 'Логи',
        'id' => 'logs',
        'icon' => 'fab fa-dev',
        'priority' => 600,
      ]
    ]);
  }
}
