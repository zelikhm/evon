<?php

namespace App\Http\Admin\House;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use AdminDisplayFilter;
use App\Models\Builder\HouseModel;
use App\Models\LandingModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Display\Column\Image;
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
class Images extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Изображения комплекса';

  /**
   * @var string
   */
  protected $alias;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    $page = AdminNavigation::getPages()->findById('files');

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
      AdminColumn::relatedLink('house.title', 'Название ЖК')->setWidth('100px'),
      AdminColumn::image('name', 'Изображение')->setWidth('500px'),
      AdminColumn::custom('Категория', function(\Illuminate\Database\Eloquent\Model $model) {
        if($model->category === 0) {
          return '3D Рендеры';
        } elseif ($model->category === 1) {
          return 'Инфраструктура';
        } elseif ($model->category === 2) {
          return 'Дизайн';
        } elseif ($model->category === 3) {
          return 'Ход строительсва';
        }
      })->setWidth('150px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setFilters(
        AdminDisplayFilter::field('house.id')->setTitle('House ID [:value]')
      )
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавить изображение');

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

      AdminFormElement::select('house_id', 'ЖК')->setModelForOptions(HouseModel::class),

      AdminFormElement::select('category', 'Категория')->SetOptions([
        0 => '3D Рендеры',
        1 => 'Инфраструктура',
        2 => 'Дизайн',
        3 => 'Ход строительсва',
      ]),

      AdminFormElement::image('name', 'Изображение')->setUploadPath(function(\Illuminate\Http\UploadedFile $file) {
        return '/storage/images';
      })->setSaveCallback(function ($file, $path, $filename, $settings) use ($id) {

        $file->move(public_path('/storage/images'), $filename);

        return ['path' => '/storage/images/' . $filename, 'value' => '/storage/images/' . $filename];
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
