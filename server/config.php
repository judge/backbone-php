<?php
  $username = "root";
  $password = "root";
  $database = "backbone";

  $connection = mysql_connect('localhost', $username, $password);
  mysql_select_db($database, $connection);
