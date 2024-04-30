<?php

namespace App\Http\Admin\House;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use AdminColumnEditable;
use App\Models\Builder\HouseCharacteristic;
use App\Models\Builder\House;
use App\Models\Builder\Info\City;
use App\Models\Builder\Info\Region;
use App\Models\LandingModel;
use App\Models\User;
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
// * @property \App\Models\LandingModel $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class HouseAdmin extends Section implements Initializable
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
    $display = AdminDisplay::datatablesAsync()->setDatatableAttributes(['bInfo' => false])->setDisplaySearch(true, 'Поиск')->paginate(40);

    $display->setColumns([
      AdminColumn::text('id', '#')
        ->setWidth('50px')
        ->setHtmlAttribute('class', 'text-center'),
      AdminColumn::relatedLink('user.email', 'Пользователь')->setWidth('350px'),
      AdminColumn::text('title', 'Название')->setWidth('350px')->setSearchCallback(function ($column, $query, $search) {
        return $query->orWhere('title', 'like', '%' . $search . '%');
      }),
      AdminColumn::text('city', 'Город')->setWidth('350px'),
      AdminColumn::text('area', 'Район')->setWidth('350px'),

      AdminColumn::custom('ХАРАКТЕРИСТИКИ', function(\Illuminate\Database\Eloquent\Model $model) {

        $chara = HouseCharacteristic::where('house_id', $model->id)->first();

        if($chara !== null) {
          return 'Заполнена ' . "<a href=/admin/house_characteristics_models/$chara->id/edit>клик</a>";
        } else {
          return '<p style="color:red">Не заполнено</p>';
        }

      }),
      AdminColumnEditable::checkbox('visible','Скрыто', 'Опубликовано')->setLabel('Отображение'),
      AdminColumn::custom('Модерация', function(\Illuminate\Database\Eloquent\Model $model) {
        if($model->active === 0) {
          return 'На модерации';
        } elseif ($model->active === 1) {
          return 'Не прошел';
        } elseif ($model->active === 2) {
          return'Одобрено';
        }
      })->setWidth('350px'),
    ]);

    $control = $display->getColumns()->getControlColumn();

    $button = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
      return '/house/success?house_id=' . $model->getKey();
    }, 'Прошел модерацию', 100);

    $button->setIcon('fa fa-thumbs-up');
    $button->setHtmlAttribute('class', 'btn-success btn-delete');
    $button->hideText();

    $control->addButton($button);

    $button->setCondition(function(\Illuminate\Database\Eloquent\Model $model) {
      $house = House::where('id', $model->getKey())->first();

      if($house->active === 2) {
        return false;
      } else {
        return true;
      }
    });

    $button1 = new \SleepingOwl\Admin\Display\ControlLink(function (\Illuminate\Database\Eloquent\Model $model) {
      return '/house/failed?house_id=' . $model->getKey();
    }, 'На модерацию', 100);

    $button1->setIcon('fa fa-thumbs-up');
    $button1->setHtmlAttribute('class', 'btn-danger btn-delete');
    $button1->hideText();

    $control->addButton($button1);

    $button1->setCondition(function(\Illuminate\Database\Eloquent\Model $model) {
      $house = House::where('id', $model->getKey())->first();

      if($house->active !== 2) {
        return false;
      } else {
        return true;
      }
    });

    $display->setApply(function (Builder $query) {
      $query->OrderBy('active', 'asc');
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

    $model = House::where('id', $id)->first();

    if($model !== null) {
      if($model->city) {
        $city = City::where('title', $model->city)->first();
        $regions = Region::where('city_id', $city->id)->get();

        $options = $regions->map(static function ($item, $regions) {
          return [
            'value' => $item->title,
          ];
        })->pluck('value')->toArray();
      }

      if($model->area) {
        $area = Region::where('title', $model->area)->first();
      }
    }


    if($id === null) {
      $form = AdminForm::elements([
        AdminFormElement::checkbox('visible', 'Опубликовано?'),
        AdminFormElement::select('user_id', 'Пользователь')
          ->setModelForOptions(User::class, 'email')
          ->setUsageKey('id'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::text('title', 'Заголовок'),
            AdminFormElement::select('city', 'Город')->setModelForOptions(City::class)->SetUsageKey('title'),
            AdminFormElement::text('longitude', 'Долгота'),
            AdminFormElement::number('percent', 'Процент')->setMin(0),
            AdminFormElement::text('slug', 'Слаг (для ссылки, название на английском)')->required(),
          ], 6)->addColumn([
//            AdminFormElement::select('area', 'Район')->setModelForOptions(Region::where('city_id', $city->id)->get()),
            AdminFormElement::text('latitude', 'Широта'),
            AdminFormElement::text('comment', 'Комментарий'),
            AdminFormElement::select('active', 'Прошел модерацию?', [
              '0' => 'На модерации',
              '1' => 'Не прошел модерацию',
              '2' => 'Прошел модерацию',
            ]),
            AdminFormElement::select('created', 'Срок сдачи')->setEnum($this->getCreated()),
          ]),

        AdminFormElement::textarea('description', 'Описание'),
        AdminFormElement::textarea('description_tr', 'Описание (tr)'),
        AdminFormElement::textarea('description_en', 'Описание (en)'),
      ]);

    } else {
      $form = AdminForm::elements([
        AdminFormElement::checkbox('visible', 'Опубликовано?'),
        AdminFormElement::select('user_id', 'Пользователь')
          ->setModelForOptions(User::class, 'email')
          ->setUsageKey('id'),
        AdminFormElement::columns()
          ->addColumn([
            AdminFormElement::text('title', 'Заголовок'),
            AdminFormElement::select('city', 'Город')->setModelForOptions(City::class)->setUsageKey('title'),
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
            AdminFormElement::select('created', 'Срок сдачи')->setEnum($this->getCreated()),
          ]),

        AdminFormElement::textarea('description', 'Описание'),
        AdminFormElement::textarea('description_tr', 'Описание (tr)'),
        AdminFormElement::textarea('description_en', 'Описание (en)'),
      ]);

    }


    $card->getButtons()->setButtons([
      'save_and_continue' => (new Save())->setText('Применить'),
//      'save_and_close' => (new SaveAndClose())->setText('Сохранить и закрыть'),
      'delete' => (new Delete()),
    ]);

    return $card->addBody([$form]);
  }

  protected function getCreated() {
    $date = Carbon::now();

    $array = ['Сдан' => 'сдан'];

    $array_created = collect();

    $month = $date->month;

    for ($i = 0; $i < 7; $i++) {
      if($i === 0) {

        if($month < 4) {
          for ($l = 1; $l < 5; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        } elseif ($month > 3 && $month < 7) {
          for ($l = 2; $l < 5; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        } elseif ($month > 6 && $month < 10) {
          for ($l = 3; $l < 5; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        } elseif ($month > 9 && $month < 13) {
          for ($l = 4; $l < 5; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        }

      } elseif ($i >= 1 && $i < 6) {
        for ($l = 1; $l < 5; $l++) {
          $array_created->push($date->year + $i  . '/' . $l);
        }
      } elseif ($i === 6) {

        if($month > 3 && $month < 7) {
          for ($l = 1; $l < 2; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        } elseif ($month > 6 && $month < 10) {
          for ($l = 1; $l < 3; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        } elseif ($month > 9 && $month < 13) {
          for ($l = 1; $l < 4; $l++) {
            $array_created->push($date->year + $i  . '/' . $l);
          }
        }

      }

    }

    $array_created->push('Сдан');

    $options = $array_created->map(static function ($item, $array_created) {
      return [
        'value' => $item,
      ];
    })->pluck('value')->toArray();

    return $options;
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
