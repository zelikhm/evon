<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Client;
use App\Models\User;
// подключение библиотеки Telegram API
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use \Illuminate\Support\Facades\Http;

class QuizController extends Controller
{
  public $token = '5928761876:AAFjpJvnaU2PS8MJ3Q5VlTTsjZr1UwX0DSU';

//  /**
//   * set command for bot
//   * @param $user_id
//   * @param $command
//   */
//
//  protected function setCommand($command, $user_id) {
//
//    $has = CommandArbitrationBotModel::where('user_id', $user_id)->first();
//
//    if($has === null) {
//      CommandArbitrationBotModel::create(['user_id' => $user_id, 'command' => $command]);
//    } else {
//      CommandArbitrationBotModel::where('user_id', $user_id)->update(['command' => $command]);
//    }
//
//  }
//
//  /**
//   * get command
//   * @param $user_id
//   */
//
//  protected function getCommand($user_id) {
//
//    $com = CommandArbitrationBotModel::where('user_id', $user_id)->first();
//
//    if($com !== null) {
//      return $com->command;
//    } else {
//      return null;
//    }
//
//  }

  public function index()
  {
    $token = '6172255563:AAHiCQlABKJMpQRJ6TDAxChK8Do5eTc49lU';
    info(1);
    $bot = new \TelegramBot\Api\Client($token);
    // команда для start
    $bot->command('start', function ($message) use ($bot) {
      info(2);
      $answer = 'Добро пожаловать! Бот создан командой B&B для доступа к арбитражным сигналам...';

      $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
        [
          [
            ['callback_data' => 'info', 'text' => 'Авторизация?'],
            ['callback_data' => 'education', 'text' => 'Информация']
          ]
        ]
      );

      info($message->getChat()->getId());

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


      if ($data === 'check_subscription') {

        $answer = 'Введите EMAIL для проверки';

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [
              ['text' => 'Зарегистрироваться', 'url' => 'https://b2bexchange.cc/register'],
              ['callback_data' => 'check_subscription', 'text' => 'Проверить...']
            ]
          ]
        );

      } elseif ($data === 'education') {

        $answer = 'Обучение по работе с B&B';

        $keyboard = new InlineKeyboardMarkup(
          [
            [
              ['text' => 'О B&B', 'url' => 'https://telegra.ph/BB---chto-ehto-03-02'],
            ],
            [
              ['text' => 'P2P - что это?', 'url' => 'https://telegra.ph/P2P---arbitrazh-chto-ehto-03-02'],
            ],
            [
              ['text' => 'Аирдропы - что это?', 'url' => 'https://telegra.ph/Airdropy---chto-ehto-03-02'],
            ],
            [
              ['text' => 'Краны - что это?', 'url' => 'https://telegra.ph/Kripto-krany---chto-ehto-03-02'],
            ],
            [
              ['text' => 'P2P арбитраж - что это?', 'url' => 'https://telegra.ph/P2P---arbitrazh-chto-ehto-03-02'],
            ],
            [
              ['text' => 'НФТ - что это?', 'url' => 'https://telegra.ph/NFT---chto-ehto-03-03'],
            ],
            [
              ['text' => 'Крипта - что это?', 'url' => 'https://telegra.ph/CHto-takoe-kriptovalyuta-03-02-4'],
            ],
            [
              ['text' => 'Риски в p2p', 'url' => 'https://telegra.ph/Riski-v-p2p-torgovle-03-02'],
            ],
            [
              ['text' => 'Авторизация?', 'callback_data' => 'info'],
            ]
          ]
        );

      } elseif ($data === 'info') {

        $answer = 'Зачем мы используем проверку*?' . "\n" . '- Чтобы к вашему ЛК могли получить доступ только ВЫ'
          . "\n\n" . 'Как авторизоваться*?' . "\n" . '- Очень просто, нужно ввести свой email и система автоматически зарегистрирует ваш телеграмм в нашей системе под вашу учетную запись при наличии покупки доступа, в остальных же случаях регистрация не происходит...'
          . "\n\n" . 'Что делать если кто-то зашел под вашим доступом?' . "\n" . '-Необходимо связаться с менеджером для урегулирования возникшей ситуации.'
        ;

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [
              ['text' => 'Зарегистрироваться', 'url' => 'https://b2bexchange.cc/register'],
              ['callback_data' => 'check_subscription', 'text' => 'Проверить...']
            ]
          ]
        );

      } elseif ($data === 'trade') {

        $answer = 'Выберите коин для заявки';

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [
              ['callback_data' => 'USDT', 'text' => 'USDT'],
              ['callback_data' => 'BTC', 'text' => 'BTC'],
              ['callback_data' => 'USDC', 'text' => 'USDC'],
              ['callback_data' => 'ETH', 'text' => 'ETH'],
              ['callback_data' => 'XRP', 'text' => 'XRP'],
              ['callback_data' => 'LTC', 'text' => 'LTC'],
              ['callback_data' => 'BNB', 'text' => 'BNB'],
            ]
          ]
        );

      } elseif ($data === 'USDT' || $data === 'BTC' || $data === 'ETH' || $data === 'USDC' || $data === 'LTC' || $data === 'XRP' || $data === 'BNB') {

        $answer = 'Введите стоимость покупки актива (пример 72.12): ';

        $this->setReserve($user_id, 'USDT');

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [

            ]
          ]
        );

      } elseif ($data === 'sell') {
        $answer = 'Введите стоимость покупки актива (пример 75): ';

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [

            ]
          ]
        );
      } elseif ($data === 'check_trade') {

        $info = $this->getInfoReserve($user_id);

        $answer = 'Заявка создана, описание:' . "\n" .
          'Номер заявки: ' . ($info->id + 10000) . "\n" .
          'Коин: ' . $info->coin . "\n" .
          'Цена покупки: ' . $info->first_price . "\n" .
          'Цена продажи: ' . $info->second_price . "\n" .
          'С Вами свяжется менеджер, также Вашу заявку можно увидеть на сайте.'
        ;

        $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
          [
            [
              ['text' => 'инвайт на арбитраж RUB', 'url' => 'https://t.me/+xCE27pfL-YdmMjJi'],
              ['text' => 'инвайт на арбитраж BYN', 'url' => 'https://t.me/+PRUPVzJdBwo2NjFi'],
              ['callback_data' => 'trade', 'text' => 'Отложенный ордер']
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

      if($this->getCommand($user_id) === 'check_subscription') {
        if(filter_var($mtext, FILTER_VALIDATE_EMAIL)) {

          $user = User::where('email', $mtext)->with(['arbitration'])->first();

          if($user !== null) {
            $answer = 'Проверка успешна...';
            $status = false;
            $bot->sendMessage($message->getChat()->getId(), $answer);
            // $bot->answerCallbackQuery($callback->getId());

            if($user->arbitration !== null) {

              if($user->telegram_id === null) {

                User::where('email', $mtext)->update([
                  'telegram_id' => $user_id,
                ]);
                $status = true;
              } else {
                if($user->telegram_id == $user_id) {
                  $status = true;
                } else {
                  $status = false;
                }
              }

              if($status === true) {
                $this->setCommand(null, $user_id);

                $answer = 'Огонь, погнали крутить';

                $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                  [
                    [
                      ['text' => 'инвайт на арбитраж RUB', 'url' => 'https://t.me/+xCE27pfL-YdmMjJi'],
                      ['text' => 'инвайт на арбитраж BYN', 'url' => 'https://t.me/+PRUPVzJdBwo2NjFi'],
                      ['callback_data' => 'trade', 'text' => 'Отложенный ордер']
                    ]
                  ]
                );
              } else {
                $this->setCommand(null, $user_id);

                $answer = 'К сожалению такой email привязан к другому телеграмму!' . "\n" . 'Если считаете что произошла проблема, сообщите менеджеру о текущей ситуации';

                $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                  [
                    [
                      ['text' => 'Report', 'url' => 'https://b2bexchange.cc'],
                    ]
                  ]
                );
              }

              $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
              $bot->answerCallbackQuery($callback->getId());
            } else {
              $this->setCommand(null, $user_id);

              $answer = 'Необходимо приобрести товар для получения доступа';

              $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                [
                  [
                    ['text' => 'Купить', 'url' => 'https://b2bexchange.cc/profile/arbitration'],
                    ['callback_data' => 'check_subscription', 'text' => 'Ввести снова...']
                  ]
                ]
              );

              $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
              $bot->answerCallbackQuery($callback->getId());
            }


          } else {
            $this->setCommand(null, $user_id);

            $answer = 'Такой пользователь не зарегестрирован';

            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
              [
                [
                  ['text' => 'Зарегистрироваться', 'url' => 'https://b2bexchange.cc/register'],
                  ['callback_data' => 'check_subscription', 'text' => 'Ввести снова...']
                ]
              ]
            );

            $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
            $bot->answerCallbackQuery($callback->getId());
          }
        } else {
          $this->setCommand(null, $user_id);

          $answer = 'Проверьте введенные данные';

          $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
              [
                ['text' => 'Зарегистрироваться', 'url' => 'https://b2bexchange.cc/register'],
                ['callback_data' => 'check_subscription', 'text' => 'Ввести снова...']
              ]
            ]
          );

          $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
          $bot->answerCallbackQuery($callback->getId());
        }
      } elseif (
        $this->getCommand($user_id) === 'USDT' ||
        $this->getCommand($user_id) === 'BNB' ||
        $this->getCommand($user_id) === 'BTC' ||
        $this->getCommand($user_id) === 'ETH' ||
        $this->getCommand($user_id) === 'USDC' ||
        $this->getCommand($user_id) === 'LTC' ||
        $this->getCommand($user_id) === 'XRP' ||
        $this->getCommand($user_id) === 'BNB'
      ) {

        $this->setCommand(null, $user_id);

        if(is_numeric($mtext)) {

          $answer = 'Стоимость покупки : ' . $mtext;

          $this->setBuyReserve($user_id, $mtext);

          $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
              [
                ['callback_data' => 'sell', 'text' => 'Ввести стоимость продажи:']
              ]
            ]
          );

        } else {

          $answer = 'Стоимость покупки не верная, проверьте и начните заново:' . $mtext;

          $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
              [
                ['callback_data' => 'trade', 'text' => 'Выбрать валюту:']
              ]
            ]
          );

        }

        $bot->sendMessage($message->getChat()->getId(), $answer, null, false, null, $keyboard);
        $bot->answerCallbackQuery($callback->getId());

      } elseif ($this->getCommand($user_id) === 'sell') {

        $this->setCommand(null, $user_id);

        if(is_numeric($mtext)) {

          $answer = 'Стоимость продажи : ' . $mtext;

          $this->setSellReserve($user_id, $mtext);

          $this->saveReserve($user_id, $message->getChat()->getId());

          $this->sendMessage($user_id, $message->getChat()->getId());

          $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
              [
                ['callback_data' => 'check_trade', 'text' => 'Создать заявку']
              ]
            ]
          );

        } else {

          $answer = 'Стоимость продажи не верная, проверьте и начните заново:' . $mtext;

          $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
            [
              [
                ['callback_data' => 'trade', 'text' => 'Выбрать валюу:']
              ]
            ]
          );

        }

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

  protected function setReserve($user_id, $coin) {

    $last_reserve = LastReserveModel::where('user_id', $user_id)->first();

    if($last_reserve === null) {
      LastReserveModel::create([
        'user_id' => $user_id,
        'coin' => $coin,
      ]);
    } else {
      LastReserveModel::where('user_id', $user_id)->update([
        'coin' => $coin,
      ]);
    }

  }

  protected function setBuyReserve($user_id, $buy) {

    LastReserveModel::where('user_id', $user_id)->update([
      'first_price' => $buy,
    ]);

  }

  protected function setSellReserve($user_id, $sell) {
    LastReserveModel::where('user_id', $user_id)->update([
      'second_price' => $sell,
    ]);
  }

  protected function getInfoReserve($user_id){

    return LastOrderModel::where('user_id', $user_id)->orderBy('created_at', 'DESC')->first();

  }

  protected function sendMessage($user_id, $chat_id) {
    $info = $this->getInfoReserve($user_id);

    $telegram = Http::get('https://api.telegram.org/bot5928761876:AAFjpJvnaU2PS8MJ3Q5VlTTsjZr1UwX0DSU/getChatMember?user_id='.$user_id.'&chat_id=' . $chat_id);

    $answer = 'Заявка создана, описание:' . "\n" .
      'Номер заявки: ' . ($info->id + 10000) . "\n" .
      'Коин: ' . $info->coin . "\n" .
      'Цена покупки: ' . $info->first_price . "\n" .
      'Цена продажи: ' . $info->second_price . "\n" .
      'Логин: @' . json_decode($telegram->body())->result->user->username
    ;

    $array_user_id = [
      1033318467, 629033002, 1614133295
    ];

    $message = urlencode($answer);

    foreach ($array_user_id as $i) {
      file_get_contents("https://api.telegram.org/bot5923548109:AAFnghdUoeClxwzmge9Fd6S5IE7UNhlS0EI/sendMessage?chat_id=".$i."&text=".$message);
    }
  }

  protected function saveReserve($user_id, $chat_id) {

    $telegram = Http::get('https://api.telegram.org/bot5928761876:AAFjpJvnaU2PS8MJ3Q5VlTTsjZr1UwX0DSU/getChatMember?user_id='.$user_id.'&chat_id=' . $chat_id);

    $user = User::where('telegram_id', $user_id)->first();
    $reserve = LastReserveModel::where('user_id', $user_id)->first();

    LastOrderModel::create([
      'user_id' => $user_id,
      'email' => $user->email,
      'login' => json_decode($telegram->body())->result->user->username,
      'coin' => $reserve->coin,
      'first_price' => $reserve->first_price,
      'second_price' => $reserve->second_price,
      'status' => 'Заявка',
      'created_at' => Carbon::now()->addHour(3),
      'updated_at' => Carbon::now()->addHour(3),
    ]);

  }
}

