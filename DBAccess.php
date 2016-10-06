<?php

class DBAccess 
{

  function connect() 
  {
    return new PDO('mysql:host=127.0.0.1;dbname=sporty2', 'root', '');
  }

}

$db = new DBAccess();
$db->connect();
echo "connection";
