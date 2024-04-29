<?php


namespace App\Services\Houses;


interface HousesInterface
{

  public function getHouseId($id);
  public function getHouseSlug($slug);
  public function getHouses($type, $limit, $dop, $offset);
  public function mainImage($id, $image, $type);

  public function filtration($options, $plan, $city, $area, $price, $date_build, $squad, $name_builder, $locations, $infostructures, $dops);

}
