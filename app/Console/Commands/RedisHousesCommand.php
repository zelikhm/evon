<?php

namespace App\Console\Commands;

use App\Services\Houses\HousesService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisHousesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'houses:houses';

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
    public function handle(HousesService $housesService)
    {
      $houses = $housesService->getHouses('Новостройка', false, true, null);

      Cache::put('houses_full', $houses, 21600);

      dd(true);
    }
}
