<?php

return array(

   /* Use SQLite
   'default' => 'sqlite',
   'connections' => array(
      'sqlite' => array(
         'driver'   => 'sqlite',
         'database' => ':memory:',
         'prefix'   => ''
      ),
   ) */

   /* Use MySQL */
   'default' => 'mysql',
   'connections' => array(
      'mysql' => array(
         'driver'    => 'mysql',
         'host'      => 'localhost',
         'database'  => 'spartapark',
         'username'  => 'root',
         'password'  => '',
         'charset'   => 'utf8',
         'collation' => 'utf8_unicode_ci',
         'prefix'    => '',
      )
   )
);