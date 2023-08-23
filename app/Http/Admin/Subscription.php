<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use AdminColumnEditable;
use AdminColumnFilter;
use App\Models\LandingModel;
use App\Models\User;
use App\Models\User\CompanyModel;
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
// * @property \App\Models\LandingModel $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Subscription extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Подписки';

  /**
   * @var string
   */
  protected $alias;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    $page = AdminNavigation::getPages()->findById('subscription');

    $page->addPage(
      $this->makePage(200)->setIcon('fas fa-user-lock')
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
      AdminColumn::relatedLink('user.email', 'email/login')->setWidth('350px')->setSearchCallback(function ($column, $query, $search) {
        return $query->where('user_id', $search);
      }),
      AdminColumn::relatedLink('company.title', 'Название компании')->setWidth('350px'),
      AdminColumn::datetime('finished_at', 'Дата окончания')->setFormat('d.m.Y')->setWidth('150px'),
      AdminColumnEditable::checkbox('free', 'Бесплатная', 'Не бесплатная')->setLabel('Подписка'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->with('company', 'user');

    $display->setColumnFilters([
      null, // Не ищем по первому столбцу

      // Поиск текста
      AdminColumnFilter::text()->setPlaceholder('email'),

      AdminColumnFilter::select(new CompanyModel, 'company_id')->setDisplay('title')->setPlaceholder('Выберите компанию')->setColumnName('company.id'),

      AdminColumnFilter::range()->setColumnName('finished_at')->setFrom(
        AdminColumnFilter::date()->setColumnName('finished_at')->setPlaceholder('From Date')->setFormat('Y-m-d')
      )->setTo(
        AdminColumnFilter::date()->setColumnName('finished_at')->setPlaceholder('To Date')->setFormat('Y-m-d')
      ),
      AdminColumnFilter::select([0 => 'Бесплатная', 1 => 'Платная'] ,'free')->setPlaceholder('Подписка'),
    ]);

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавить подписку');

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

      AdminFormElement::select('user_id', 'Пользователь')
        ->setModelForOptions(User::class, 'email')
        ->setUsageKey('id'),
      AdminFormElement::datetime('finished_at', 'Время окончания'),
      AdminFormElement::checkbox('free', 'Бесплатная?'),
      AdminFormElement::checkbox('free_link', 'Бесплатная ссылка?'),

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
    if($user->role !== 3) {
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
