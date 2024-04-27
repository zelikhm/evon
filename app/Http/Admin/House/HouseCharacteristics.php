<?php

namespace App\Http\Admin\House;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Http\Admin\House\Info\StructureAdmin;
use App\Http\Admin\House\Info\TypeAdmin;
use App\Models\Builder\HouseCharacteristic;
use App\Models\Builder\House;
use App\Models\Builder\Info\Structure;
use App\Models\Builder\Info\Type;
use App\Models\LandingModel;
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
 * @property \App\Models\Builder\HouseCharacteristic $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class HouseCharacteristics extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Характеристики для ЖК';

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
      AdminColumn::relatedLink('house.title', 'ЖК')->setWidth('350px'),
      AdminColumn::text('type', 'Тип здания')->setWidth('350px'),
      AdminColumn::text('floors', 'Этажи')->setWidth('350px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Добавить характеристики');

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

    if($id === null) {
      $form = AdminForm::elements([
        AdminFormElement::select('house_id', 'ЖК')
          ->setModelForOptions(House::class, 'title')
          ->setUsageKey('id'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::select('type', 'Тип здания', [
              'Вилла' => 'Вилла',
              'Новостройка' => 'Новостройка',
            ])->required(),
          ], 6)->addColumn([
            AdminFormElement::number('floors', 'Этажи'),
            AdminFormElement::number('count_flat', 'Стояки'),
          ]),

        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::number('toSea', 'До моря'),
            AdminFormElement::number('toSchool', 'До школы'),
            AdminFormElement::number('toBus', 'До остановки'),
          ], 6)->addColumn([
            AdminFormElement::number('toShop', 'До магазина'),
            AdminFormElement::number('toPark', 'До парка'),
            AdminFormElement::number('toChildrenSchool', 'До детского сада'),
          ]),

        AdminFormElement::textarea('exclusive', 'Эксклюзив для агенства'),
      ]);
    } else {
      $form = AdminForm::elements([
        AdminFormElement::select('house_id', 'ЖК')
          ->setModelForOptions(House::class, 'title')
          ->setUsageKey('id'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::multiselect('dop', 'Доп.Услуги')->SetDisplay('name')->setUsageKey('id')
              ->setOptions($this->types()),
            AdminFormElement::select('type', 'Тип здания', [
              'Вилла' => 'Вилла',
              'Новостройка' => 'Новостройка',
            ])->required(),
          ], 6)->addColumn([
            AdminFormElement::multiselect('info', 'Инфаструктура')->SetDisplay('name')->setUsageKey('id')
              ->setOptions($this->infos()),
            AdminFormElement::number('floors', 'Этажи'),
            AdminFormElement::number('count_flat', 'Стояки'),
          ]),

        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::number('toSea', 'До моря'),
            AdminFormElement::number('toSchool', 'До школы'),
            AdminFormElement::number('toBus', 'До остановки'),
          ], 6)->addColumn([
            AdminFormElement::number('toShop', 'До магазина'),
            AdminFormElement::number('toPark', 'До парка'),
            AdminFormElement::number('toChildrenSchool', 'До детского сада'),
          ]),

        AdminFormElement::textarea('exclusive', 'Эксклюзив для агенства'),
      ]);
    }



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

  /**
   * return types
   * @return array
   */

  public function types() {

    $types = Type::all();

    return $types->map(static function ($item, $types) {
      return [
        'id' => $item->id,
        'value' => $item->name,
      ];
    })->pluck('value', 'id')->toArray();

  }

  /**
   * return array info
   * @return array
   */

  public function infos() {

    $structure = Structure::all();

    return $structure->map(static function ($item, $structure) {
      return [
        'id' => $item->id,
        'value' => $item->name,
      ];
    })->pluck('value', 'id')->toArray();

  }
}
