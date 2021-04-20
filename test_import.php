<?php
  require_once 'vendor/autoload.php';
  require_once 'lib/ripcord-1.0/ripcord.php';

  $url = 'http://127.0.0.1:8069';
  $db = 'odoo14';
  $username = 'roo';
  $password = '6grkyxnt';

  $common = ripcord::client("{$url}/xmlrpc/2/common");
  $uid = $common->authenticate($db, $username, $password, ['interactive' => true]);
  $models = ripcord::client("{$url}/xmlrpc/2/object");

  $models->execute_kw($db, $uid, $password, 'hotels.import_hz',
      'import_test', [[], 'Hello, odoo!']);


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

