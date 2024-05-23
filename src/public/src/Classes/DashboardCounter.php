<?php

namespace App\Classes;

use PDO;

class DashboardCounter
{
  public $dbcon;

  public function __construct()
  {
    $database = new Database();
    $this->dbcon = $database->getConnection();
  }

  public function hello()
  {
    return "DASHBOARD-COUNTER CLASS";
  }

  public function counter_view($data)
  {
    $sql = "SELECT RIGHT(a.count_machine,2) machine,a.count_cnt1 input,a.count_cnt2 output
    FROM planner.count_meter a
    WHERE RIGHT(a.count_machine,2) = ?
    ORDER BY a.count_id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function plan_view($data)
  {
    $sql = "SELECT b.req_job job,a.req_piece target
    FROM planner.inspection_request a
    LEFT JOIN planner.inspection_log b 
    ON a.req_id = b.req_id
    WHERE b.machine = ?
    ORDER BY a.req_id DESC 
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function energy_view($data)
  {
    $sql = "SELECT ROUND((a.electric_imptwh / 1000),4) energy
    FROM planner.electric_meter a
    WHERE RIGHT(a.electric_machine,2) = ?
    ORDER BY a.electric_id DESC
    LIMIT 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (!empty($row['energy']) ? $row['energy'] : 0);
  }
}
