<?php

namespace App\Classes;

use PDO;

class Helpdesk
{
  private $dbcon;

  public function __construct()
  {
    $db = new Database();
    $this->dbcon = $db->getConnection();
  }

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
