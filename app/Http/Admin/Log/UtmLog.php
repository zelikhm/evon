<?php

namespace App\Http\Admin\Log;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Models\User\Company;
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
// * @property \App\Models\Log\UtmStat $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class UtmLog extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'UTM stat';

  /**
   * @var string
   */
  protected $alias;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    $page = AdminNavigation::getPages()->findById('logs');

    $page->addPage(
      $this->makePage(600)->setIcon('fas fa-user-lock')
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
      AdminColumn::text('ip', 'Айпи')->setWidth('350px'),
      AdminColumn::relatedLink('utm.title', 'Название метки')->setWidth('350px'),
      AdminColumn::checkbox('is_reg', 'Зарегистировался')
        ->setWidth('350px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавить метку');

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

      AdminFormElement::text('title', 'Название')
        ->required(),
      AdminFormElement::text('utm_code', 'Код метки')
        ->required(),

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
    return false;
  }

  /**
   * @return bool
   */
  public function isCreatable(): bool
  {
    return false;
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
