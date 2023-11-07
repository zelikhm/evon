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
use App\Models\User\CompanyModel;
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
 * // * @property \App\Models\User\VerificationModel $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Verification extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Верификации';

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
  public function onDisplay($id = null)
  {
    $columns = [
      AdminColumn::text('id', '#')
        ->setWidth('50px')
        ->setHtmlAttribute('class', 'text-center'),
      AdminColumn::relatedLink('user.first_name', 'Пользователь')->setWidth('350px'),
      AdminColumn::text('link', 'link')->setWidth('350px'),
      AdminColumn::text('text', 'text')->setWidth('350px'),
      AdminColumn::url('file', 'file')->setWidth('350px'),

      AdminColumn::custom('Верификация', function (\Illuminate\Database\Eloquent\Model $model) {
        if ($model->isVerification == 0) {
          return 'Не верефицирован';
        } else if ($model->isVerification == 1) {
          return 'На верификации';
        } else if ($model->isVerification == 2) {
          return 'Верифицирован';
        }
      })->setWidth('350px'),
    ];

    $display = AdminDisplay::datatables()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(false, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setColumnFilters([
      null, // Не ищем по первому столбцу
      // Поиск текста
      AdminColumnFilter::select(new User, 'user_id')->setDisplay('email')->setPlaceholder('Пользователь')->setColumnName('user.id'),
      null,
      null,
      null,
      null,
    ]);

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
        AdminFormElement::select('user_id', 'Пользователь')->setOptions($this->getUser()),

        AdminFormElement::text('link', 'Ссылка'),
        AdminFormElement::text('text', 'text'),
        AdminFormElement::file('file', 'Файл')->setUploadPath(function(\Illuminate\Http\UploadedFile $file) {
          return '/storage/verification';
        })->setSaveCallback(function ($file, $path, $filename, $settings) use ($id) {

          $file->move(public_path('/storage/verification'), $filename);

          return ['path' => '/storage/verification/' . $filename, 'value' => '/storage/verification/' . $filename];
        }),

        AdminFormElement::select('isVerification', 'Статус верификации', [
          0 => 'Не верефицирован',
          1 => 'На верефикации',
          2 => 'Верифицирован',
        ])->required(),

      ]);

      $tabs[] = AdminDisplay::tab($main)
        ->setLabel("Пользователь")
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
