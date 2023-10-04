<?php


namespace App\Services\Houses;


interface HousesInterface
{

  public function getHouseId($id);
  public function getHouseSlug($slug);
  public function getHouses($type, $limit, $dop, $count = null);

}
