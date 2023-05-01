<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Models\Bot\QuizModel;
use App\Models\User;
use Illuminate\Http\Request;
use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\BotApi;

class QuizController extends Controller
{
    public $api_key = '6172255563:AAHiCQlABKJMpQRJ6TDAxChK8Do5eTc49lU';

  /**
   * set command for bot
   * @param $user_id
   * @param $command
   */

  protected function setCommand($command, $user_id) {

    $has = QuizModel::where('user_id', $user_id)->first();

    if($has === null) {
      QuizModel::create(['user_id' => $user_id, 'command' => $command]);
    } else {
      QuizModel::where('user_id', $user_id)->update(['command' => $command]);
    }

  }

  public function index()
  {
    info('yes');
    $bot = new \TelegramBot\Api\Client($this->api_key);
    // команда для start
    $bot->command('start', function ($message) use ($bot) {
//      $user_id = $message->getFrom()->getId();

//      $this->setCommand('start', $user_id);

      $answer = 'Добро пожаловать! Бот создан командой B&B для игры в квиз... ' . "\n" . 'Для продолжения необходимо нажать "начать" и получать удовольствия от игры';

      $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
        [
          [
            ['callback_data' => 'question', 'text' => 'Начать'],
            ['callback_data' => 'info', 'text' => 'Статистика']
          ]
        ]
      );

      $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
    });

    // команда для помощи
    $bot->command('help', function ($message) use ($bot) {
      $answer = 'Команды:
        /help - вывод справки';
      $bot->sendMessage($message->getChat()->getId(), $answer);
    });

    $bot->on(function ($Update) use ($bot) {
      $callback_mes_id = $Update->getCallbackQuery()->getInlineMessageId();
      $callback = $Update->getCallbackQuery();
      $message = $callback->getMessage(); // получаем сообщение
      $user_id = $callback->getFrom()->getId(); // уникальный идентификатор chat_id
      $data = $callback->getData(); // название команды переданный с кнопки у сообщения
      $this->setCommand($data, $user_id);


      if ($data === 'question') {

        $answer = 'Ожидайте, генерируем вопрос!';

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [
              ['callback_data' => 'answer', 'text' => 'Ответить...']
            ]
          ]
        );

      }

      $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
      $bot->answerCallbackQuery($callback->getId());

      if (empty($data)) return true; else return false;

    }, function ($Update) {
      try {
        $callback = $Update->getCallbackQuery();
        if (is_null($callback) || !strlen($callback->getData()))
          return false;
        return true;
      } catch (\Exception $e) {
        return false;
      }
    });

    $bot->on(function ($Update) use ($bot) {
      $message = $Update->getMessage();
      if($message !== null) {
        $mtext = $message->getText();
        $user_id = $message->getChat()->getId();
      }

      $callback = $Update->getCallbackQuery();

      if($this->getCommand($user_id) === 'question') {

        $answer = '';
        $keyboard = [];

        $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
        $bot->answerCallbackQuery($callback->getId());

      }

//            $bot->sendMessage($message->getChat()->getId(), 'keke', 'HTML', true, null, []);

    }, function ($message) {
      return true;
    });

    // Запуск бота
    if (!empty($bot->getRawBody())) {
      try {
        $bot->run();
      } catch (\Exception $e) {
        // можно добавить функцию уведомления администратора о возможных ошибках
      }
    }
  }
}
