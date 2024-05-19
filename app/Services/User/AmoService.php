<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Http;

class AmoService
{

  private $email;
  private $phone;
  private $client_id;
  private $name;

  /**
   * generate client and save order
   * @param $name
   * @param $email
   * @param $phone
   * @return void
   */

  public function save($name, $email, $phone)
  {
    $this->email = $email;
    $this->phone = $phone;
    $this->name = $name;

    $this->client_id = $this->client();
    $this->order();
  }

  /**
   * save client
   * @return mixed
   */

  public function client()
  {
    $link_contact = 'https://' . config('app.amo_subdomain') . '.amocrm.ru/api/v4/contacts';

    $response = Http::withToken(config('app.amo_token'))->post($link_contact, [
      [
        'name' => $this->name,
        "custom_fields_values" => [
          [
            "field_id" => 229383,
            "values" => [
              [
                "value" => $this->email,
              ]
            ]
          ],
          [
            "field_id" => 229381,
            "values" => [
              [
                "value" => $this->phone
              ]
            ]
          ],
        ],
      ]
    ]);

    dd(json_decode($response->body()));

    return json_decode($response->body())->_embedded->contacts[0]->id;
  }

  /**
   * save order
   * @return void
   */

  public function order()
  {
    $link_order = 'https://' . config('app.amo_subdomain') . '.amocrm.ru/api/v4/leads';

    Http::withToken(config('app.amo_token'))->post($link_order, [
      [
        'name' => 'Сделка с ' . $this->name,
        '_embedded' => [
          'contacts' => [
            [
              'id' => $this->client_id
            ]
          ]
        ]
      ]
    ]);
  }

}
