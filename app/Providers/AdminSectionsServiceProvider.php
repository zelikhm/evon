<?php

namespace App\Providers;

use App\Http\Admin\Log\PaymentLogModel;
use App\Models\Builder\HouseFile;
use App\Models\Builder\HouseImage;
use App\Models\Builder\Info\Region;
use App\Models\Log\ImageLog;
use App\Models\News\AdminNew;
use App\Models\Tarif;
use App\Models\TarifRussion;
use App\Models\Trace;
use App\Models\User\Client;
use App\Models\User\Company;
use App\Models\User\Subscription;
use App\Models\User\Verification;
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
    \App\Models\Builder\House::class => 'App\Http\Admin\House\HouseAdmin',
    \App\Models\Builder\Info\Type::class => 'App\Http\Admin\House\Info\TypeAdmin',
    \App\Models\Builder\Info\Structure::class => 'App\Http\Admin\House\Info\StructureAdmin',
    \App\Models\Builder\Info\City::class => 'App\Http\Admin\House\Info\City',
    \App\Models\Builder\HouseCharacteristic::class => 'App\Http\Admin\House\HouseCharacteristics',
    \App\Models\Builder\HouseNew::class => 'App\Http\Admin\House\HouseNews',
    \App\Models\Builder\HouseSupport::class => 'App\Http\Admin\House\HouseSupport',
    \App\Models\Builder\Flat\Frame::class => 'App\Http\Admin\House\Flat\Frame',
    \App\Models\Builder\Flat\Flat::class => 'App\Http\Admin\House\Flat\FlatAdmin',
    HouseImage::class => 'App\Http\Admin\House\Images',
    HouseFile::class => 'App\Http\Admin\House\Files',
    //
    AdminNew::class => 'App\Http\Admin\News\AdminNews',
    Company::class => 'App\Http\Admin\CompanyAdmin',
    //
    Tarif::class => 'App\Http\Admin\Tarif',
    TarifRussion::class => 'App\Http\Admin\TarifRussion',
    Subscription::class => 'App\Http\Admin\Subscription',
    Trace::class => 'App\Http\Admin\Trace',
    \App\Models\Log\PaymentLog::class => 'App\Http\Admin\Log\PaymentLogModel',
    \App\Models\Log\Utm::class => 'App\Http\Admin\Log\Utm',
    \App\Models\Log\UtmStat::class => 'App\Http\Admin\Log\UtmLog',
    //
    Client::class => 'App\Http\Admin\Client',
    Verification::class => 'App\Http\Admin\Verification',
    //
    ImageLog::class => 'App\Http\Admin\Log\ImageLog'
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
