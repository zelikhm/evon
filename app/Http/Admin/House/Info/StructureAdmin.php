<?php

namespace App\Http\Admin\House\Info;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Models\LandingModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
class StructureAdmin extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Инфраструктура';

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
      $this->makePage(300)->setIcon('fas fa-user-lock')
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
      AdminColumn::text('name', 'Название')->setWidth('350px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавь структуру');

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

      AdminFormElement::text('name', 'Название'),
      AdminFormElement::text('name_tr', 'Название (tr)'),
      AdminFormElement::text('name_en', 'Название (en)'),
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
    return true;
  }

  /**
   * @return void
   */
  public function onRestore(int $id)
  {
    // remove if unused
  }
}
