<?php
  require_once 'vendor/autoload.php';
  require_once 'lib/ripcord-1.0/ripcord.php';
  // $url = 'http://192.168.100.93:8069';
  // $db = 'test-odoo-db';
  // $username = 'basile-m@yandex.ru';
  // $password = '6grkyxnt';
  
  $url = 'http://127.0.0.1:8069';
  $db = 'odoo14';
  $username = 'roo';
  $password = 'roo';

//  $common = ripcord::client("{$url}/xmlrpc/2/common");
//  $uid = $common->authenticate($db, $username, $password, []);
//
//  print_r($uid);
//  print_r(PHP_EOL);

  $uid = 2; // ???
  $models = ripcord::client("{$url}/xmlrpc/2/object");

//  print_r($models);

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

//echoContacts();
//echoHotels();
//exit();

function testHotel() {
    global $models, $db, $uid, $password;
    $models->execute_kw($db, $uid, $password,
        'hotels.hotel', 'import_test', [[], ['a' => 'Hello World!']]);
}

/**
   * Создать контакт
   * @param $fieldsSet array поля и их значение [fieldname => value, fieldname => value, ...]
   * @return mixed
   */
function createContact(array $fieldsSet) {
    global $models, $db, $uid, $password;
    return $models->execute_kw($db, $uid, $password,
        'res.partner', 'create', [$fieldsSet]);
}

function createHotel(array $fieldsSet) {
    global $models, $db, $uid, $password;
    return $models->execute_kw($db, $uid, $password,
        'hotels.hotel', 'create', [$fieldsSet]);
}

function updateHotel(array $ids, array $fieldsSet)
{
    global $models, $db, $uid, $password;
    $models->execute_kw($db, $uid, $password, 'hotels.hotel', 'write',
        [$ids, $fieldsSet]);
}

function createContract(array $fieldsSet) {
    global $models, $db, $uid, $password;
    return $models->execute_kw($db, $uid, $password,
        'hotels.contract', 'create', [$fieldsSet]);
}




$faker = Faker\Factory::create();

// Add Contact
$fieldsSet = [
    'name' => $faker->name,
    'city' => $faker->city,
    'email' => $faker->email,
];
//$contact_id = createContact($fieldsSet);

// Add Hotel
$fieldsSet = [
//    'name' => 'Отель 0001',
//    'num_stars' => 'd',
//    'phone' => $faker->phoneNumber,
//    'email' => $faker->email,
    'contacts_ids' => [
        0 => 13,
        1 => 14,
        2 => 15,
        3 => 16,
        4 => 18,
    ],
    'hotelier_id' => 17,
    'city_id' => 2,
];
//$hotel_id = createHotel($fieldsSet);
//print_r($hotel_id);
updateHotel([3], $fieldsSet);


exit();








/**
   * Обновить поля записи контактов
   * @param $ids array идентификаторы контактов, для обновления
   * @param $fieldsSet array поля и их значение [fieldname => value, fieldname => value, ...]
   */
  function updateContacts(array $ids, array $fieldsSet)
  {
    global $models, $db, $uid, $password;
    $models->execute_kw($db, $uid, $password, 'res.partner', 'write',
        [$ids, $fieldsSet]);
  }

  /**
   * @param $ids array
   */
  // function deleteContacts(array $ids) {
  //   global $models, $db, $uid, $password;
  //   $models->execute_kw($db, $uid, $password,
  //       'res.partner', 'unlink',
  //       array($ids));
  // }




  // $faker = Faker\Factory::create();
  // for ($i = 0; $i < 10; $i++) {
  //   $fieldsSet = [
  //       'name' => $faker->name,
  //       'city' => $faker->city,
  //       'email' => $faker->email,
  //   ];
  //   createContact($fieldsSet);
  // }
  // echoPartners();

//  createContact($fieldsSet);


//  updateContacts([10], $fieldsSet);
//  deleteContacts([10]);


//  //  Вывод всех полей модели res.partner
//  $res = $models->execute_kw($db, $uid, $password,
//      'res.partner', 'fields_get',
//      [],
////      ['attributes' => [
////          'string',
////          'help',
////          'type'
////      ]]
//  );
//  foreach ($res as $key => $value) {
//      print_r($key . PHP_EOL);
//  }
