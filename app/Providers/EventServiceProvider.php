<?php

namespace App\Providers;

use App\Models\Builder\Flat\Flat;
use App\Models\Builder\Flat\Frame;
use App\Models\Builder\House;
use App\Models\Builder\Info\City;
use App\Observers\CityObserver;
use App\Observers\FlatObserver;
use App\Observers\FrameObserver;
use App\Observers\HouseObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        City::observe(CityObserver::class);
        House::observe(HouseObserver::class);
        Flat::observe(FlatObserver::class);
        Frame::observe(FrameObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
