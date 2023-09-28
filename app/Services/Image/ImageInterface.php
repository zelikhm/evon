<?php


namespace App\Services\Image;


interface ImageInterface
{

  public function add($image_id, $type, $file);
  public function edit($type, $image);
  public function delete($image_id, $type);

}
