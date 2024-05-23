<?php
session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");
include_once(__DIR__ . "/../../../vendor/autoload.php");

use App\Classes\AssetType;
use App\Classes\Validation;

$TYPE = new AssetType();
$VALIDATION = new Validation();

$param = (isset($params) ? explode("/", $params) : header("Location: /error"));
$action = (isset($param[0]) ? $param[0] : die(header("Location: /error")));
$param1 = (isset($param[1]) ? $param[1] : "");
$param2 = (isset($param[2]) ? $param[2] : "");

if ($action === "create") {
  try {
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $TYPE = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $reference = (isset($_POST['reference']) ? $VALIDATION->input($_POST['reference']) : "");

    $count = $TYPE->type_count([$name]);
    if (intval($count) > 0) {
      $VALIDATION->alert("danger", "ข้อมูลซ้ำในระบบ!", "/asset/type");
    }

    $TYPE->type_create([$name, $TYPE, $reference]);
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/asset/type");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "update") {
  try {
    $uuid = (isset($_POST['uuid']) ? $VALIDATION->input($_POST['uuid']) : "");
    $name = (isset($_POST['name']) ? $VALIDATION->input($_POST['name']) : "");
    $TYPE = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $reference = (isset($_POST['reference']) ? $VALIDATION->input($_POST['reference']) : "");
    $status = (isset($_POST['status']) ? $VALIDATION->input($_POST['status']) : "");

    $TYPE->type_update([$name, $TYPE, $reference, $status, $uuid]);
    $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!", "/asset/type");
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "delete") {
  try {
    $data = json_decode(file_get_contents("php://input"), true);
    $uuid = $data['uuid'];

    if (!empty($uuid)) {
      $TYPE->type_delete([$uuid]);
      $VALIDATION->alert("success", "ดำเนินการเรียบร้อย!");
      echo json_encode(200);
    } else {
      $VALIDATION->alert("danger", "ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง!");
      echo json_encode(500);
    }
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "data") {
  try {
    $TYPE = (isset($_POST['type']) ? $VALIDATION->input($_POST['type']) : "");
    $result = $TYPE->type_data($TYPE);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "checklist-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $TYPE->checklist_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "worker-select") {
  try {
    $keyword = (isset($_POST['q']) ? $VALIDATION->input($_POST['q']) : "");
    $result = $TYPE->worker_select($keyword);
    echo json_encode($result);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "month-select") {
  try {
    $result = $VALIDATION->month_th();
    $key++;
    $data = [];
    foreach ($result as $key => $value) {
      $data[] = [
        "id" => $key,
        "text" => $value,
      ];
    }
    echo json_encode($data);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

if ($action === "input-type-select") {
  try {
    $result = $VALIDATION->input_type();
    $data = [];
    foreach ($result as $key => $value) {
      $key++;
      $data[] = [
        "id" => $key,
        "text" => $value,
      ];
    }
    echo json_encode($data);
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
