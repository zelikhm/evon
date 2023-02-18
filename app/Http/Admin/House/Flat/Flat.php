<?php

namespace App\Http\Admin\House\Flat;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Models\Builder\Flat\FlatModel;
use App\Models\Builder\Flat\FrameModel;
use App\Models\Builder\HouseModel;
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
class Flat extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Квартиры';

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
      AdminColumn::relatedLink('house.title', 'ЖК')->setWidth('350px'),
      AdminColumn::relatedLink('frame.name', 'Корпус')->setWidth('350px'),
      AdminColumn::text('frame_id', 'айди корпуса')->setWidth('350px')->setSearchCallback(function ($column, $query, $search) {
        return $query->orWhere('frame_id', $search);
      }),
      AdminColumn::text('number', 'Номер')->setWidth('350px'),
      AdminColumn::text('square', 'Площадь')->setWidth('350px'),
      AdminColumn::text('count', 'Планировка')->setWidth('350px'),
      AdminColumn::text('floor', 'Этаж')->setWidth('350px'),
      AdminColumn::custom('Статус', function(\Illuminate\Database\Eloquent\Model $model) {
        if($model->status == 0) {
          return 'Акция';
        } elseif ($model->status == 1) {
          return 'Перепродажа';
        } elseif ($model->status == 2) {
          return'Бронь';
        } elseif ($model->status == 3) {
          return'Продажи закрыты';
        } elseif ($model->status == 4) {
          return 'В продаже';
        }
      })->setWidth('350px'),
      AdminColumn::text('price', 'Цена')->setWidth('350px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавь квартиру');

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
          AdminFormElement::select('frame_id', 'ЖК')
            ->setOptions($this->getFlats(), 'name')
            ->setUsageKey('id'),

          AdminFormElement::number('number', 'Номер'),
          AdminFormElement::number('square', 'Площадь'),
          AdminFormElement::select('count', 'Планировка')->setOptions([
            '1 + 1' => '1 + 1',
            '1 + 1(D)' => '1 + 1(D)',
            '2 + 1' => '2 + 1',
            '2 + 1(D)' => '2 + 1(D)',
            '3 + 1' => '3 + 1',
            '3 + 1(D)' => '3 + 1(D)',
            '4 + 1' => '4 + 1',
            '4 + 1(D)' => '4 + 1(D)',
            '5 + 1' => '5 + 1',
            '5 + 1(D)' => '5 + 1(D)',
            'Duplex' => 'Duplex',
            'Studia' => 'Studia',
          ]),

          AdminFormElement::image('imageUp', 'Верхнее')->setUploadPath(function(\Illuminate\Http\UploadedFile $file) {
            return '/storage/flat';
          })->setSaveCallback(function ($file, $path, $filename, $settings) use ($id) {

            $file->move(public_path('/storage/flat'), $filename);

            return ['path' => '/storage/flat/' . $filename, 'value' => '/storage/flat/' . $filename];
          }),

        ], 6)->addColumn([
          AdminFormElement::number('floor', 'Этаж'),
          AdminFormElement::select('status', 'Статус')->setOptions([
            0 => 'Акция',
            1 => 'Перепродажа',
            2 => 'Бронь',
            3 => 'Продажи закрыты',
            4 => 'В продаже',

          ]),
          AdminFormElement::number('number_from_stairs', 'От леснечной клетки'),
          AdminFormElement::number('price', 'Цена')->setStep(0.01),

          AdminFormElement::image('imageDown', 'Нижнее')->setUploadPath(function(\Illuminate\Http\UploadedFile $file) {
            return '/storage/flat';
          })->setSaveCallback(function ($file, $path, $filename, $settings) use ($id) {

            $file->move(public_path('/storage/flat'), $filename);

            return ['path' => '/storage/flat/' . $filename, 'value' => '/storage/flat/' . $filename];
          }),
        ]),

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

  protected function getFlats() {
    $flats = FrameModel::with(['house'])->get();

    return $flats->map(static function ($item, $types) {
      return [
        'id' => $item->id,
        'value' => $item->house->title . ' ' . $item->name,
      ];
    })->pluck('value', 'id')->toArray();
  }
}
