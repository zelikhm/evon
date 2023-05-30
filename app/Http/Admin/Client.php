<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use AdminDisplayFilter;
use AdminColumnFilter;
use AdminColumnEditable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Delete;
use SleepingOwl\Admin\Section;

/**
 * Class Administrators
 *
 * // * @property \App\Models\User\ClientModel $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Client extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Клиенты пользователей';

  /**
   * @var string
   */
  protected $alias;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    $page = AdminNavigation::getPages()->findById('client');

    $page->addPage(
      $this->makePage(100)->setIcon('fas fa-user-lock')
    );
  }

  /**
   *
   * @return DisplayInterface
   */
  public function onDisplay()
  {
    $columns = [
      AdminColumn::text('id', '#')
        ->setWidth('50px')
        ->setHtmlAttribute('class', 'text-center'),
      AdminColumn::relatedLink('user.first_name', 'Пользователь')->setWidth('350px'),
      AdminColumn::text('name', 'Клиент')->setWidth('350px'),
      AdminColumn::text('phone', 'Телефон')->setWidth('350px'),
      AdminColumn::text('soc', 'Whatsapp/telegram')->setWidth('350px'),
      AdminColumn::text('client_text', 'Что пишет клиент')->setWidth('350px'),
      AdminColumn::link('jk', 'Ссылка на жк или подборку')->setWidth('350px'),

      AdminColumnEditable::checkbox('isJk')->setLabel('Опеределился с жк'),

      AdminColumn::custom('Статус клиента', function (\Illuminate\Database\Eloquent\Model $model) {
        if ($model->status_client == 0) {
          return 'Заявка';
        } else if ($model->status_client == 1) {
          return 'Обработка';
        } else if ($model->status_client == 2) {
          return 'Работа с клиентом';
        } else if ($model->status_client == 3) {
          return 'Завершено успешно';
        } else if ($model->status_client == 4) {
          return 'Завершено не удачно';
        }
      })->setWidth('350px'),

      AdminColumn::custom('Статус обращения', function (\Illuminate\Database\Eloquent\Model $model) {
        if ($model->status_order == 0) {
          return 'Заявка';
        } else if ($model->status_order == 1) {
          return 'Отклонено';
        } else if ($model->status_order == 2) {
          return 'Завершено';
        }
      })->setWidth('350px'),

      AdminColumn::text('comment', 'Комментарий')->setWidth('350px'),
    ];

    $display = AdminDisplay::datatables()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Создать пользователя');

    return $display;
  }

  /**
   * @param int|null $id
   * @param array $payload
   * @return FormInterface
   */
  public function onEdit($id = null, array $payload = [])
  {
    $card = AdminForm::card();

    $display = AdminDisplay::tabbed();
    $display->setTabs(function () use ($id) {
      $tabs = [];

      $main = AdminForm::form();

      $main->setElements([
        AdminFormElement::checkbox('isJk', 'Определился с жк?'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::number('commission', 'Вознаграждение')->setStep(0.01),
          ], 6)->addColumn([
            AdminFormElement::select('status_client', 'Статус клиента', [
              0 => 'Заявка',
              1 => 'Обработка',
              2 => 'Работа с клиентом',
              3 => 'Завершено успешно',
              4 => 'Завершено не удачно',
            ])->required(),
            AdminFormElement::select('status_order', 'Статус заказа', [
              0 => 'Заявка',
              1 => 'Отклонено',
              2 => 'Завершено',
            ])->required(),
          ]),


        AdminFormElement::html('<hr>'),

        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::select('user_id', 'Пользователь')->setOptions($this->getUser()),
            AdminFormElement::text('name', 'ФИО'),
            AdminFormElement::text('phone', 'Телефон')
              ->required(),
          ], 6)->addColumn([
            AdminFormElement::text('client_text', 'Запрос клиента'),
            AdminFormElement::text('jk', 'ссылка на жк/подборку'),
            AdminFormElement::text('soc', 'WhatsApp/Telegramm'),
            AdminFormElement::text('comment', 'Комментарий')->required(),
          ]),
      ]);

      $tabs[] = AdminDisplay::tab($main)
        ->setLabel("Основная инофрмация")
        ->setIcon('<i class="fa fa-credit-card"></i>');

      $manager = AdminForm::form();

      $manager->setElements([
        AdminFormElement::text('manager_name', 'ФИО менеджера'),
        AdminFormElement::text('manager_phone', 'Телефон'),
      ]);

      $tabs[] = AdminDisplay::tab($manager)
        ->setLabel("Менеджер")
        ->setIcon('<i class="fa fa-credit-card"></i>');

      return $tabs;
    });

    return $display;
  }

  /**
   * get user
   * @return mixed
   */

  protected function getUser()
  {
    $users = \App\Models\User::all();

    return $users->map(static function ($item, $key) {
      return [
        'id' => $item->id,
        'value' => $item->first_name . '-' . $item->last_name,
      ];
    })->pluck('value', 'id')->toArray();
  }


  /**
   * @param array $payload
   * @return FormInterface
   * @throws \Exception
   */
  public function onCreate(array $payload = [])
  {
    return $this->onEdit(null, $payload);
  }

  /**
   * @param Model $model
   * @return bool
   */
  public function isEditable(Model $model): bool
  {
    return true;
  }

  /**
   * @return bool
   */
  public function isCreatable(): bool
  {
    return true;
  }

  /**
   * @param Model $model
   * @return bool
   */
  public function isDeletable(Model $model): bool
  {
    $user = Auth::user();
    if ($user->role !== 3) {
      return false;
    } else {
      return true;
    }

  }

  /**
   * @return void
   */
  public function onRestore(int $id)
  {
    // remove if unused
  }
}
