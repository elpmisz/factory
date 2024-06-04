<?php

namespace App\Classes;

use PDO;

class AssetType
{
  public $dbcon;

  public function __construct()
  {
    $database = new Database();
    $this->dbcon = $database->getConnection();
  }

  public function hello()
  {
    return "ASSET-TYPE CLASS";
  }

  public function type_create($data)
  {
    $sql = "INSERT INTO factory.asset_type(`uuid`, `name`, `checklist`, `worker`, `weekly`, `monthly`, `month`) VALUES(UUID(),?,?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function type_count($data)
  {
    $sql = "SELECT COUNT(*) 
    FROM factory.asset_type
    WHERE name = ?
    AND status = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function type_view($data)
  {
    $sql = "SELECT * FROM factory.asset_type WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch();
  }

  public function type_update($data)
  {
    $sql = "UPDATE factory.asset_type SET
    name = ?,
    checklist = ?,
    worker = ?,
    weekly = ?,
    monthly = ?,
    month = ?,
    status = ?,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function type_delete($data)
  {
    $sql = "UPDATE factory.asset_type SET
    status = 0,
    updated = NOW()
    WHERE uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_count($data)
  {
    $sql = "SELECT COUNT(*) 
    FROM factory.asset_type_item
    WHERE type_id = ?
    AND name = ?
    AND status = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchColumn();
  }

  public function item_add($data)
  {
    $sql = "INSERT INTO factory.asset_type_item(type_id,name,type,text,required) VALUES(?,?,?,?,?)";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_view($data)
  {
    $sql = "SELECT b.*
    FROM factory.asset_type a
    LEFT JOIN factory.asset_type_item b
    ON a.id = b.type_id
    WHERE a.uuid =  ?
    AND b.status = 1";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function item_update($data)
  {
    $sql = "UPDATE factory.asset_type_item SET
    name = ?,
    type = ?,
    text = ?,
    required = ?
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function item_delete($data)
  {
    $sql = "UPDATE factory.asset_type_item SET
    status = 0
    WHERE id = ?";
    $stmt = $this->dbcon->prepare($sql);
    return $stmt->execute($data);
  }

  public function checklist_view($data)
  {
    $sql = "SELECT b.id,b.`name`
    FROM factory.asset_type a
    LEFT JOIN factory.asset_checklist b
    ON FIND_IN_SET(b.id, a.checklist)
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function worker_view($data)
  {
    $sql = "SELECT a.worker,CONCAT(b.firstname,' ',b.lastname) username
    FROM factory.asset_type a
    LEFT JOIN factory.user b
    ON FIND_IN_SET(b.id, a.worker)
    WHERE a.uuid = ?";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll();
  }

  public function type_data($type = null)
  {
    $sql = "SELECT COUNT(*) FROM factory.asset_type WHERE status IN (1,2)";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $column = ["a.id", "a.name", "b.name"];

    $keyword = (isset($_POST['search']['value']) ? trim($_POST['search']['value']) : '');
    $filter_order = (isset($_POST['order']) ? $_POST['order'] : '');
    $order_column = (isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] : '');
    $order_dir = (isset($_POST['order']['0']['dir']) ? $_POST['order']['0']['dir'] : '');
    $limit_start = (isset($_POST['start']) ? $_POST['start'] : '');
    $limit_length = (isset($_POST['length']) ? $_POST['length'] : '');
    $draw = (isset($_POST['draw']) ? $_POST['draw'] : '');

    $sql = "SELECT a.id,a.uuid,a.name,GROUP_CONCAT(b.name) checklist_name,
    GROUP_CONCAT(c.firstname,' ',c.lastname) worker,
    (
      CASE
        WHEN a.status = 1 THEN 'รายละเอียด'
        WHEN a.status = 2 THEN 'ระงับการใช้งาน'
        ELSE NULL
      END
    ) status_name,
    (
      CASE
        WHEN a.status = 1 THEN 'primary'
        WHEN a.status = 2 THEN 'warning'
        ELSE NULL
      END
    ) status_color
    FROM factory.asset_type a
    LEFT JOIN factory.asset_checklist b
    ON FIND_IN_SET(b.id, a.checklist)
    LEFT JOIN factory.user c
    ON FIND_IN_SET(c.id, a.worker) 
    WHERE a.status IN (1,2) ";

    if (!empty($type)) {
      $sql .= " AND (a.id = '{$type}' OR a.reference_id = '{$type}') ";
    }

    if (!empty($keyword)) {
      $sql .= " AND (a.name LIKE '%{$keyword}%' OR b.name LIKE '%{$keyword}%') ";
    }

    $sql .= " GROUP BY a.id ";

    if ($filter_order) {
      $sql .= " ORDER BY {$column[$order_column]} {$order_dir} ";
    } else {
      $sql .= " ORDER BY a.status ASC, a.name ASC ";
    }

    $sql2 = '';
    if ($limit_length) {
      $sql2 .= "LIMIT {$limit_start}, {$limit_length}";
    }

    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    $filter = $stmt->rowCount();
    $stmt = $this->dbcon->prepare($sql . $sql2);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $data = [];
    foreach ($result as $row) {
      $action = "<a href='/asset/type/edit/{$row['uuid']}' class='badge badge-{$row['status_color']} font-weight-light'>{$row['status_name']}</a> <a href='javascript:void(0)' class='badge badge-danger font-weight-light btn-delete' id='{$row['uuid']}'>ลบ</a>";
      $data[] = [
        $action,
        $row['name'],
        str_replace(",", ",<br>", $row['checklist_name']),
        str_replace(",", ",<br>", $row['worker']),
      ];
    }

    $output = [
      "draw"    => $draw,
      "recordsTotal"  =>  $total,
      "recordsFiltered" => $filter,
      "data"    => $data
    ];

    return $output;
  }

  public function checklist_select($keyword)
  {
    $sql = "SELECT a.id,a.name text
    FROM factory.asset_checklist a
    WHERE a.type_id = 1
    AND a.status = 1 ";
    if (!empty($keyword)) {
      $sql .= " AND (a.name LIKE '%{$keyword}%') ";
    }
    $sql .= " ORDER BY a.name";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function worker_select($keyword)
  {
    $sql = "SELECT a.login id,CONCAT(a.firstname,' ',a.lastname) text
    FROM factory.user a
    LEFT JOIN factory.login b
    ON a.login = b.id
    WHERE b.status = 1";
    if (!empty($keyword)) {
      $sql .= " AND (a.firstname LIKE '%{$keyword}%' OR a.lastname LIKE '{$keyword}') ";
    }
    $sql .= " ORDER BY a.firstname";
    $stmt = $this->dbcon->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function last_insert_id()
  {
    return $this->dbcon->lastInsertId();
  }
}
