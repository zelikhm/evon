<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheService;
use App\Services\Houses\HousesService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisVillagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'houses:villages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(HousesService $housesService, CacheService $cacheService)
    {
      $cacheService->updateCacheVillages($housesService);
    }
}
