<?php
$menu = "service";
$page = "service-helpdesk";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">แจ้งปัญหาการใช้งาน</h4>
      </div>
      <div class="card-body">

        <div class="row justify-content-end mb-2">
          <div class="col-xl-3 mb-2">
            <a href="/helpdesk/service" class="btn btn-sm btn-info btn-block">
              <i class="fa fa-file-lines pr-2"></i>หัวข้อบริการ
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/helpdesk/authorize" class="btn btn-sm btn-info btn-block">
              <i class="fa fa-file-lines pr-2"></i>สิทธิ์การจัดการ
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>