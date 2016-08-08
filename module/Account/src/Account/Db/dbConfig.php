<?php

return array(
  'driver'         => 'Pdo_Mysql',
  'dsn'            => 'mysql:host=localhost;dbname=account',
  'driver_options' => array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
  ),
  'username' => 'root',
  'password' => '',
);

