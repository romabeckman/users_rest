<?php

require_once dirname(__FILE__) . '/../bootstrap.php';

$jsonDriver = Providers\Factory::jsonDriver();
//$jsonDriver->insert('Users', [
//    'name' => 'João',
//    'email' => 'joao@email.com',
//    'password' => '12345']
//);

print_r($jsonDriver->fetch('Users', ['email' => 'maria@email.com']));
?>