<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use AdminDisplayFilter;
use AdminColumnFilter;
use App\Models\LandingModel;
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
 * // * @property \App\Models\User $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Users extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Пользователи';

  /**
   * @var string
   */
  protected $alias;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    $page = AdminNavigation::getPages()->findById('settings');

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
      AdminColumn::text('email', 'Логин или email')->setWidth('350px'),
      AdminColumn::custom('Роль', function (\Illuminate\Database\Eloquent\Model $model) {
        if ($model->role === 0) {
          return 'Риелтор';
        } elseif ($model->role === 1) {
          return 'Застройщик';
        } elseif ($model->role === 2) {
          return 'Модератор';
        } elseif ($model->role === 3) {
          return 'Администратор';
        }
      })->setWidth('350px'),
      AdminColumn::text('first_name', 'Имя / Название компании')->setWidth('350px'),

      AdminColumn::custom('Агенство недвижимости', function (\Illuminate\Database\Eloquent\Model $model) {

        if ($model->company !== null) {
          return $model->company->title;
        } else {
          return 'Нет компании';
        }

      })->setWidth('350px'),

      AdminColumn::custom('Тариф / подписка', function (\Illuminate\Database\Eloquent\Model $model) {

        $subscription = User\SubscriptionModel::where('user_id', $model->id)->first();

        if ($subscription !== null) {
          $link = '/admin/subscription_models/' . $subscription->id . '/edit';
          return '<a href='. $link .' style="color: green">Оформлена</a>';
        } else {
          return '<b style="color: red">Не оформлена</b>';
        }

      })->setWidth('350px'),

      AdminColumn::custom('Дата окончания', function (\Illuminate\Database\Eloquent\Model $model) {

        $subscription = User\SubscriptionModel::where('user_id', $model->id)->first();

        if ($subscription !== null) {
          return $subscription->finished_at > Carbon::now() ? $subscription->finished_at : '<b style="color: red">Закончена</b>';
        } else {
          return '<b style="color: red">Не оформлена</b>';
        }

      })->setWidth('350px'),

    ];

    $display = AdminDisplay::datatables()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->with('company', 'subscriptionInfo');

    $display->setColumnFilters([
      null, // Не ищем по первому столбцу

      // Поиск текста
      AdminColumnFilter::text()->setPlaceholder('email'),

      AdminColumnFilter::select([
        0 => 'Риелтор',
        1 => 'Застройщик'
      ], 'role')->setDisplay('title')->setPlaceholder('Выберите роль')->setColumnName('role'),

      AdminColumnFilter::text()->setPlaceholder('first_name'),

      AdminColumnFilter::select(new CompanyModel, 'company_id')->setDisplay('title')->setPlaceholder('Выберите компанию')->setColumnName('company_id'),

      null,

      AdminColumnFilter::range()->setColumnName('subscriptionInfo.finished_at')->setFrom(
        AdminColumnFilter::date()->setColumnName('subscriptionInfo.finished_at')->setPlaceholder('From Date')->setFormat('Y-m-d')
      )->setTo(
        AdminColumnFilter::date()->setColumnName('subscriptionInfo.finished_at')->setPlaceholder('To Date')->setFormat('Y-m-d')
      ),
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

    $form = AdminForm::elements([
      AdminFormElement::columns()
        ->addColumn([
          AdminFormElement::text('email', 'Email/Логин'),
          AdminFormElement::text('phone', 'Телефон (риелтор)')
            ->required(),
          AdminFormElement::text('first_name', 'Имя \ Название компании'),
          AdminFormElement::password('password', 'Пароль')->hashWithBcrypt(),
        ], 6)->addColumn([
          AdminFormElement::text('last_name', 'Фамилия'),
          AdminFormElement::text('status', 'Статус'),
          AdminFormElement::select('role', 'Роль', [
            '0' => 'Риелтер',
            '1' => 'Застройщик',
            '2' => 'Модератор',
            '3' => 'Администратор',
          ])->required(),
          AdminFormElement::text('link', 'Языки'),
        ]),

      AdminFormElement::select('company_id', 'Компания')->setModelForOptions(CompanyModel::class),

      AdminFormElement::image('image', 'Изображение')->setUploadPath(function (\Illuminate\Http\UploadedFile $file) {
        return '/storage/user';
      })->setSaveCallback(function ($file, $path, $filename, $settings) use ($id) {

        $file->move(public_path('/storage/user'), $filename);

        return ['path' => '/storage/user/' . $filename, 'value' => '/storage/user/' . $filename];
      }),


    ]);

    $card->getButtons()->setButtons([
      'save_and_continue' => (new Save())->setText('Применить'),
//            'save_and_close' => (new SaveAndClose())->setText('Сохранить и закрыть'),
      'delete' => (new Delete()),
    ]);

    return $card->addBody([$form]);
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
