<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\File;

class GenerateReport
{

  /**
   * get info
   * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
   */

  public function info()
  {
    $users = User::select('email', 'phone', 'first_name', 'last_name')->get();
//    $json = json_encode($user, JSON_UNESCAPED_UNICODE);

    $userCollection = $users->map(function ($user) {
      return [
        'email' => $user->email,
        'phone' => $user->phone,
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
      ];
    });

// Преобразуем коллекцию в массив строк CSV
    $csvData = $userCollection->map(function ($user) {
      return implode(', ', $user);
    })->prepend('email,phone,first_name,last_name')->implode("\n");

// Путь к файлу, в который мы хотим записать данные
    $filePath = storage_path('app/users.csv');

// Записываем данные в файл
    File::put($filePath, $csvData);

    return response()->download($filePath, 'users.csv');
  }

}
