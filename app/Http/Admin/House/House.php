<?php

namespace App\Http\Admin\House;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Models\Builder\HouseModel;
use App\Models\Builder\Info\CityModel;
use App\Models\Builder\Info\RegionModel;
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
class House extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Жилые комплексы';

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
      AdminColumn::relatedLink('user.email', 'Пользователь')->setWidth('350px'),
      AdminColumn::text('title', 'Название')->setWidth('350px'),
      AdminColumn::text('city', 'Город')->setWidth('350px'),
      AdminColumn::text('area', 'Район')->setWidth('350px'),
      AdminColumn::custom('Модерация', function(\Illuminate\Database\Eloquent\Model $model) {
        if($model->active === 0) {
          return 'На модерации';
        } elseif ($model->active === 1) {
          return 'Не прошел';
        } elseif ($model->active === 2) {
          return'Одобрено';
        }
      })->setWidth('350px'),
    ];

    $display = AdminDisplay::datatablesAsync()
      ->paginate(40)
      ->setColumns($columns)
      ->setDisplaySearch(true, 'поиск')
      ->setHtmlAttribute('class', 'table-primary table-hover');

    $display->setApply(function (Builder $query) {
      $query->OrderBy('id', 'asc');
    })->setNewEntryButtonText('Создать жилой комлекс');

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

    $model = HouseModel::where('id', $id)->first();

    if($model->city) {
      $city = CityModel::where('title', $model->city)->first();
      $regions = RegionModel::where('city_id', $city->id)->get();

      $options = $regions->map(static function ($item, $regions) {
        return [
//          'id' => $item->id,
          'value' => $item->title,
        ];
      })->pluck('value')->toArray();
    }

    if($model->area) {
      $area = RegionModel::where('title', $model->area)->first();
    }

    if($id === null) {
      $form = AdminForm::elements([
        AdminFormElement::select('user_id', 'Пользователь')
          ->setModelForOptions(User::class, 'email')
          ->setUsageKey('id'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::text('title', 'Заголовок'),
            AdminFormElement::select('city', 'Город')->setModelForOptions(CityModel::class)->SetUsageKey('title'),
            AdminFormElement::text('longitude', 'Долгота'),
            AdminFormElement::number('percent', 'Процент')->setMin(0),
            AdminFormElement::text('slug', 'Слаг (для ссылки, название на английском)')->required(),
          ], 6)->addColumn([
//            AdminFormElement::select('area', 'Район')->setModelForOptions(RegionModel::where('city_id', $city->id)->get()),
            AdminFormElement::text('latitude', 'Широта'),
            AdminFormElement::text('comment', 'Комментарий'),
            AdminFormElement::select('active', 'Прошел модерацию?', [
              '0' => 'На модерации',
              '1' => 'Не прошел модерацию',
              '2' => 'Прошел модерацию',
            ]),
            AdminFormElement::select('created', 'Срок сдачи', [
              'Сдан' => 'Сдан',
              'Не сдан' => 'Не сдан',
              'В разработке' => 'В разработке',
            ]),
          ]),

        AdminFormElement::textarea('description', 'Описание'),
      ]);

    } else {
      $form = AdminForm::elements([
        AdminFormElement::select('user_id', 'Пользователь')
          ->setModelForOptions(User::class, 'email')
          ->setUsageKey('id'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::text('title', 'Заголовок'),
            AdminFormElement::select('city', 'Город')->setModelForOptions(CityModel::class)->setUsageKey('title'),
            AdminFormElement::text('longitude', 'Долгота'),
            AdminFormElement::number('percent', 'Процент')->setMin(0),
            AdminFormElement::text('slug', 'Слаг (для ссылки, название на английском)')->required(),
          ], 6)->addColumn([
            AdminFormElement::select('area', 'Район')->setEnum($options),
            AdminFormElement::text('latitude', 'Широта'),
            AdminFormElement::text('comment', 'Комментарий'),
            AdminFormElement::select('active', 'Прошел модерацию?', [
              '0' => 'На модерации',
              '1' => 'Не прошел модерацию',
              '2' => 'Прошел модерацию',
            ]),
            AdminFormElement::select('created', 'Срок сдачи', [
              'Сдан' => 'Сдан',
              'Не сдан' => 'Не сдан',
              'В разработке' => 'В разработке',
            ]),
          ]),

        AdminFormElement::textarea('description', 'Описание'),
      ]);

    }


    $card->getButtons()->setButtons([
      'save_and_continue' => (new Save())->setText('Применить'),
//      'save_and_close' => (new SaveAndClose())->setText('Сохранить и закрыть'),
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
