<?php


namespace App\Services\Image;


use App\Models\Builder\Flat\FlatImagesModel;
use App\Models\Builder\HouseImagesModel;
use App\Models\Builder\HouseMainImageModel;
use App\Models\Log\ImageLogModel;
use Illuminate\Support\Facades\Http;

class ImageService implements ImageInterface
{

  /**
   * method for add image
   * 0 - house
   * 1 - flat
   * 2 - main
   * @param $image_id
   * @param $type
   * @param $file
   * @return bool
   */

  public function add($image_id, $type, $file): bool
  {
    Http::post(env('SERVICE_URL') . '/api/add', [
      'type' => $type,
      'image' => $file,
      'image_id' => $image_id,
      'token' => env('SERVICE_TOKEN')
    ]);

    try {
      self::saveLog('(Удачно) Добавлено изображение', $file, false);

      return true;
    } catch (\Exception $e) {
      self::saveLog('(Не удачно) Добавлено изображение', $file, false);

      return false;
    }
  } //end

  /**
   * edit image
   * @param $type
   * @param $image
   * @return \Illuminate\Http\JsonResponse
   */

  public function edit($type, $image)
  {

    if ($type === 0) {

      HouseMainImageModel::where('image', $image)
        ->update([
          'isResize' => true
        ]);

      $title = '(Удачно) Изменено главное фото у дома';

    } else if ($type === 1) {

      HouseImagesModel::where('name', $image)
        ->update([
          'isResize' => true,
        ]);

      $title = '(Удачно) Изменено фото у дома';

    } else if ($type === 2) {

      FlatImagesModel::where('')
        ->update([
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

    Http::post(env('SERVICE_URL') . '/api/delete', [
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

    ImageLogModel::create([
      'title' => $title,
      'image' => $image,
      'error' => $error
    ]);

  } //end
}
