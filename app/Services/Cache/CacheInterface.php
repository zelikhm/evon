<?php


namespace App\Services\Cache;


use App\Services\Houses\HousesService;

interface CacheInterface
{

  public function updateCacheHouses(HousesService $housesService);
  public function updateCacheVillages(HousesService $housesService);

}
