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

  public function counter_card()
  {
    $sql = "SELECT SUM(a.actual) total,
    SUM(IF(YEAR(a.`open`) = YEAR(DATE_SUB(NOW(), INTERVAL 1 DAY)),a.actual,0)) `year`,
    SUM(IF(YEAR(a.`open`) = YEAR(DATE_SUB(NOW(), INTERVAL 1 DAY)) AND MONTH(a.`open`) = MONTH(DATE_SUB(NOW(), INTERVAL 1 DAY)),a.actual,0)) `month`,
    SUM(IF(DATE(a.`open`) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)),a.actual,0)) `date`
    FROM factory.counter_data a";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function job_daily($machine, $job, $shift, $start, $end)
  {
    $sql = "SELECT DATE_FORMAT(a.open, '%d/%m/%Y') `date`,SUM(a.actual) total
    FROM factory.counter_data a
    WHERE a.actual != '' ";
    if (!empty($machine)) {
      $sql .= " AND (a.machine = '{$machine}') ";
    }
    if (!empty($job)) {
      $sql .= " AND (a.job = '{$job}') ";
    }
    if (!empty($shift)) {
      $sql .= " AND (a.shift = '{$shift}') ";
    }
    if (!empty($start) && !empty($end)) {
      $sql .= " AND (DATE(a.open) BETWEEN STR_TO_DATE('{$start}', '%d/%m/%Y') AND STR_TO_DATE('{$end}', '%d/%m/%Y')) ";
    }
    if (!empty($start) && empty($end)) {
      $sql .= " AND (DATE(a.open) = STR_TO_DATE('{$start}', '%d/%m/%Y')) ";
    }
    $sql .= "GROUP BY DATE(a.`open`)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function machine_daily($machine, $job, $shift, $start, $end)
  {
    $sql = "SELECT a.machine,DATE(a.open) open,SUM(a.actual) total
    FROM factory.counter_data a
    WHERE a.actual != '' ";
    if (!empty($machine)) {
      $sql .= " AND (a.machine = '{$machine}') ";
    }
    if (!empty($job)) {
      $sql .= " AND (a.job = '{$job}') ";
    }
    if (!empty($shift)) {
      $sql .= " AND (a.shift = '{$shift}') ";
    }
    if (!empty($start) && !empty($end)) {
      $sql .= " AND (DATE(a.open) BETWEEN STR_TO_DATE('{$start}', '%d/%m/%Y') AND STR_TO_DATE('{$end}', '%d/%m/%Y')) ";
    }
    if (!empty($start) && empty($end)) {
      $sql .= " AND (DATE(a.open) = STR_TO_DATE('{$start}', '%d/%m/%Y')) ";
    }
    $sql .= "GROUP BY a.machine";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function machine_select($keyword)
  {
    $sql = "SELECT a.machine id, a.machine text
    FROM factory.counter_data a ";
    if (!empty($keyword)) {
      $sql .= " WHERE a.machine LIKE '%{$keyword}%' ";
    }
    $sql .= "GROUP BY a.machine";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function job_select($keyword)
  {
    $sql = "SELECT a.job id, CONCAT('[',a.job,'] ',a.bom) text
    FROM factory.counter_data a ";
    if (!empty($keyword)) {
      $sql .= " WHERE a.job LIKE '%{$keyword}%' ";
    }
    $sql .= "GROUP BY a.job";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function shift_select()
  {
    $sql = "SELECT a.shift id, a.shift text
    FROM factory.counter_data a
    WHERE a.shift IS NOT NULL
    GROUP BY a.shift ";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
