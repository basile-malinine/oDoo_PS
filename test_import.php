<?php
  require_once 'vendor/autoload.php';
  require_once 'lib/ripcord-1.0/ripcord.php';

  $url = 'http://127.0.0.1:8069';
//  $db = 'odoo14';
  $db = 'hotel';
  $username = 'roo';
  $password = 'roo';

  $common = ripcord::client("{$url}/xmlrpc/2/common");
  $uid = $common->authenticate($db, $username, $password, ['interactive' => true]);
  $models = ripcord::client("{$url}/xmlrpc/2/object");

  $faker = Faker\Factory::create();

  // Иммитация экспорта Отелей
  for ($hz_id = 1000; $hz_id < 1099; $hz_id++) {
    $new_hotel = [
        'hotel' => [
            'name' => $faker->company,
            'num_stars' => 'a',
            'city' => $faker->city,
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'hotelier' => $faker->firstName . ' ' . $faker->lastName,
            'commission' => $faker->numberBetween(10, 15),
            'arrival_time_std' => (string)$faker->numberBetween(12, 17),
            'hz_id' => $hz_id,
        ],
    ];

    $result = $models->execute_kw($db, $uid, $password, 'hotels.import_hz',
        'import_test', [[], $new_hotel]);
    print_r($result);
    print_r(PHP_EOL);
  }
//  $result = $models->execute_kw($db, $uid, $password, 'hotels.import_hz',
//      'get_city_id', [[], 'Ленинград']);
//  print_r($result);

  exit();

  // Вывести все контакты
function echoHotels()
{
    global $models, $db, $uid, $password;
    $ids = $models->execute_kw($db, $uid, $password,
        'hotels.hotel', 'search',
        [[['id', '!=', 0]]]);

    $result = $models->execute_kw($db, $uid, $password,
        'hotels.hotel', 'read',
        [$ids],
        ['fields' => ['id', 'name', 'num_stars',
            'city_id', 'contracts_ids', 'phone', 'email',
            'commission', 'invoices_ids', 'contacts_ids']]);

    print_r($result);
    print_r(PHP_EOL);
}

function echoContacts()
{
    global $models, $db, $uid, $password;
    $ids = $models->execute_kw($db, $uid, $password,
        'res.partner', 'search',
        [[['id', '!=', 0]]]);

    $result = $models->execute_kw($db, $uid, $password,
        'res.partner', 'read',
        [$ids],
        ['fields' => ['id', 'name', 'phone', 'email', 'is_hotelier']]);

    print_r($result);
    print_r(PHP_EOL);
}



echoContacts();
echoHotels();
exit();

