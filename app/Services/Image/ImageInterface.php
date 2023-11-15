<?php


namespace App\Services\Image;


interface ImageInterface
{

  public function add($image_id, $type, $image_name);
  public function edit($type, $image, $id);
  public function delete($image_id, $type);

}
