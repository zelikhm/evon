<?php


namespace App\Services\Image;


use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\HouseImage;
use App\Models\Builder\HouseMainImage;
use App\Models\Log\ImageLog;
use Illuminate\Support\Facades\Http;

class ImageService implements ImageInterface
{
  const NAME = 'id';

  /**
   * method for add image
   * 0 - house
   * 1 - flat
   * 2 - main
   * @param $image_id
   * @param $type
   * @return bool
   */

  public function add($image_id, $type, $image_name): bool
  {

    $photo = fopen('storage/buffer/'.$image_name, 'r');

    $response = Http::attach(
      'image', $photo, $image_name
    )->post(env('SERVICE_URL') . 'api/add', [
      'type' => $type,
      'imageName' => $image_name,
      'image_id' => $image_id,
      'token' => env('SERVICE_TOKEN')
    ]);

    try {
      self::saveLog('(Удачно) Добавлено изображение', $photo, false);

      return true;
    } catch (\Exception $e) {
      self::saveLog('(Не удачно) Добавлено изображение', $photo, false);

      return false;
    }
  } //end

  /**
   * edit image
   * @param $type
   * @param $image
   * @param $id
   * @param null $type_flat_image
   * @return \Illuminate\Http\JsonResponse
   */

  public function edit($type, $image, $id, $type_flat_image = null)
  {

    if ($type === 0) {

      HouseMainImage::where(self::NAME, $id)
        ->update([
          'image' => $image,
          'isResize' => true
        ]);

      $title = '(Удачно) Изменено главное фото у дома';

    } else if ($type === 1) {

      HouseImage::where(self::NAME, $id)
        ->update([
          'name' => $image,
          'isResize' => true,
        ]);

      $title = '(Удачно) Изменено фото у дома';

    } else if ($type === 2) {

      FlatImagesModel::where(self::NAME, $id)
        ->update([
          'name' => $image,
          'isResize' => true
        ]);

      $title = '(Удачно) Изменено фото у квартиры';

    }

    self::saveLog($title, $image, false);

    return response()->json(true, 200);

  } //end

  /**
   * method for delete image with help type
   * 0 - main
   * 1 - house
   * 2 - flat
   * @param $image
   * @param $type
   * @return bool
   */

  public function delete($image, $type)
  {

    Http::post(env('SERVICE_URL') . 'api/delete', [
      'type' => $type,
      'image' => $image,
      'token' => env('SERVICE_TOKEN')
    ]);

    try {
      self::saveLog('(Удачно) Удалено изображение', $image, false);

      return true;
    } catch (\Exception $e) {
      self::saveLog('(Не удачно) Удалено изображение', $image, true);

      return false;
    }

  } //end

  /**
   * save log
   * @param $title
   * @param $image
   * @param $error
   */

  private static function saveLog($title, $image, $error):void
  {

    ImageLog::create([
      'title' => $title,
      'image' => $image,
      'error' => $error
    ]);

  } //end
}
