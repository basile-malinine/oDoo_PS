<?php
  require_once 'vendor/autoload.php';
  require_once 'lib/ripcord-1.0/ripcord.php';

  $url = 'http://95.165.173.247:8069';
//  $url = 'http://127.0.0.1:8069';
  $db = 'odoo14';
//  $db = 'hotels';
  $username = 'roo';
  $password = 'roo';

  $arr_exp['hotel'] = [
          'id' => '1',
          'created' => '1561369106',
          'changed' => '1619719545',
          'name' => 'Отель Вечный Зов',
          'num_stars' => '812',
          'address' => 'Народный пр., 5, Москва, 105187',
          'phone' => '+7985-227-65-09',
          'email' => 'vechny-zov@mail.ru',
          'fine_period' => '14',
          'fine_size' => '1',
          'arrival_time_std' => '14:00',
          'departure_time_std' => '05:00',
          'commission' => '12' ,
      ];
  $arr_exp['city'] = [
          'id' => '847',
          'name' => 'Москва',
      ];
  $arr_exp['hotelier'] = [
          'id' => '17',
          'hotel_id' => '1',
          'created' => '1561368703',
          'access' => '1619719119',
          'name' => 'Heorhi Lazarevich',
          'city' => 'Минск',
          'address' => 'ул. Натуралистов д.4 кв. 12',
          'phone' => '296846163',
          'email' => 'smtpdrupal8+ownerzov@gmail.com',
      ];
  $arr_exp['room_types'] = [
          0 => [
              'id' => '5',
              'hotel_id' => '1',
              'created' => '1561369106',
              'changed' => '1619719119',
              'name' => 'Двухместный номер эконом-класса с 1 кроватью или 2 отдельными кроватями',
              'currency_code' => 'RUB',
              'price' => '290000',
              'quantity' => '',
          ],
          1 => [
              'id' => '6',
              'hotel_id' => '1',
              'created' => '1561475902',
              'changed' => '1619718583',
              'name' => 'Небольшой одноместный номер',
              'currency_code' => 'RUB',
              'price' => '120000',
              'quantity' => '',
          ],
          2 => [
              'id' => '7',
              'hotel_id' => '1',
              'created' => '1561633012',
              'changed' => '1564398067',
              'name' => ' Стандартный двухместный номер с 1 кроватью или 2 отдельными кроватями',
              'currency_code' => 'RUB',
              'price' => ' 320000',
              'quantity' => '',
          ],
          3 => [
              'id' => '8',
              'hotel_id' => '1',
              'created' => '1561633870',
              'changed' => '1619719545',
              'name' => 'Полулюкс',
              'currency_code' => 'RUB',
              'price' => '460000',
              'quantity' => '',
          ],
          4 => [
              'id' => '9',
              'hotel_id' => '1',
              'created' => '1561633870',
              'changed' => '1564398518',
              'name' => 'Семейный полулюкс',
              'currency_code' => 'RUB',
              'price' => '490000',
              'quantity' => '',
          ],
          5 => [
              'id' => '10',
              'hotel_id' => '1',
              'created' => '1561633870',
              'changed' => '1619719545',
              'name' => 'Люкс',
              'currency_code' => 'RUB',
              'price' => '650000',
              'quantity' => '',
          ],
          6 => [
              'id' => '11',
              'hotel_id' => '1',
              'created' => '1561633870',
              'changed' => '1619718583',
              'name' => 'Трехместный номер "Комфорт"',
              'currency_code' => 'RUB',
              'price' => '310000',
              'quantity' => '',
          ],
      ];

  $common = ripcord::client("{$url}/xmlrpc/2/common");
  $uid = $common->authenticate($db, $username, $password, ['interactive' => true]);
  $models = ripcord::client("{$url}/xmlrpc/2/object");
  $result = $models->execute_kw($db, $uid, $password, 'hotels.import_hz',
      'import_hz', [[], $arr_exp]);
