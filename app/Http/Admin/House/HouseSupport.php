<?php

namespace App\Http\Admin\House;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Models\Builder\HouseModel;
use App\Models\User;
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
class HouseSupport extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Отдел продаж';

  /**
   * @var string
   */
  protected $alias;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    $page = AdminNavigation::getPages()->findById('houses');

    $page->addPage(
      $this->makePage(400)->setIcon('fas fa-user-lock')
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
      AdminColumn::relatedLink('house.title', 'ЖК')->setWidth('350px'),
      AdminColumn::image('avatar', 'Аватар')->setWidth('350px'),
      AdminColumn::text('name', 'Имя')->setWidth('350px'),
      AdminColumn::text('phone', 'Телефон')->setWidth('350px'),
      AdminColumn::text('email', 'Емаил')->setWidth('350px'),
      AdminColumn::text('status', 'Должность')->setWidth('350px'),
      AdminColumn::link('link', 'Соц.сеть')->setWidth('350px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавить агента');

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
          AdminFormElement::select('house_id', 'ЖК')
            ->setModelForOptions(HouseModel::class, 'title')
            ->setUsageKey('id'),
          AdminFormElement::text('name', 'Имя')->required(),
          AdminFormElement::text('phone', 'Телефон')->required(),
        ], 6)->addColumn([
          AdminFormElement::text('email', 'Емеил')->required(),
          AdminFormElement::text('status', 'Должность')->required(),
          AdminFormElement::text('link', 'Соц.сеть')->required(),
        ]),

      AdminFormElement::image('avatar', 'Аватар')->setUploadPath(function(\Illuminate\Http\UploadedFile $file) {
        return '/storage/support';
      })->setSaveCallback(function ($file, $path, $filename, $settings) use ($id) {

        $file->move(public_path('/storage/support'), $filename);

        return ['path' => '/storage/support/' . $filename, 'value' => '/storage/support/' . $filename];
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
