<?php

namespace App\Http\Admin\House;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Http\Admin\House\Info\Structure;
use App\Http\Admin\House\Info\Type;
use App\Models\Builder\HouseModel;
use App\Models\Builder\Info\StructureModel;
use App\Models\Builder\Info\TypesModel;
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
class HouseCharacteristics extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Характеристики';

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
      AdminColumn::text('status', 'Статус')->setWidth('350px'),
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

    $form = AdminForm::elements([
      AdminFormElement::select('house_id', 'ЖК')
        ->setModelForOptions(HouseModel::class, 'title')
        ->setUsageKey('id'),
      AdminFormElement::columns()
        ->addColumn([
          AdminFormElement::multiselect('dop', 'Доп.Услуги')->SetDisplay('name')->setUsageKey('value')
            ->setOptions($this->types()),
          AdminFormElement::select('type', 'Тип здания', [
            'Эконом' => 'Эконом',
            'Премиум' => 'Премиум',
            'Люкс' => 'Люкс',
          ])->required(),
        ], 6)->addColumn([
          AdminFormElement::multiselect('info', 'Инфаструктура')->SetDisplay('name')->setUsageKey('value')
            ->setOptions($this->infos()),
          AdminFormElement::select('status', 'Статус', [
            'Сдан' => 'Продажи закрыты',
            'В процессе' => 'Свободно',
            'Не достроено' => 'Акция',
          ])->required(),
        ]),

      AdminFormElement::columns()
        ->addColumn([
          AdminFormElement::number('floors', 'Этажи'),
          AdminFormElement::number('toSea', 'До моря'),
          AdminFormElement::number('toSchool', 'До школы'),
        ], 6)->addColumn([
          AdminFormElement::number('toShop', 'До магазина'),
          AdminFormElement::number('toPark', 'До парка'),
          AdminFormElement::number('toChildrenSchool', 'До детского сада'),
          AdminFormElement::number('toBus', 'До остановки'),
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
    return true;
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

    $types = TypesModel::all();

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

    $structure = StructureModel::all();

    return $structure->map(static function ($item, $types) {
      return [
        'id' => $item->id,
        'value' => $item->name,
      ];
    })->pluck('value', 'id')->toArray();

  }
}
