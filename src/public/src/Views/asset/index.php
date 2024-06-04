<?php
$menu = "service";
$page = "service-asset";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ข้อมูลทรัพย์สิน</h4>
      </div>
      <div class="card-body">

        <div class="row mb-2">
          <div class="col-xl-3 mb-2">
            <a href="/asset/department" class="btn btn-sm btn-warning btn-block">
              <i class="fa fa-file-lines pr-2"></i>แผนก/ฝ่าย
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/asset/location" class="btn btn-sm btn-warning btn-block">
              <i class="fa fa-file-lines pr-2"></i>สถานที่
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/asset/brand" class="btn btn-sm btn-warning btn-block">
              <i class="fa fa-file-lines pr-2"></i>ยี่ห้อ
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/asset/checklist" class="btn btn-sm btn-warning btn-block">
              <i class="fa fa-file-lines pr-2"></i>รายการตรวจสอบ
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/asset/type" class="btn btn-sm btn-warning btn-block">
              <i class="fa fa-file-lines pr-2"></i>ประเภท
            </a>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/asset/authorize" class="btn btn-sm btn-warning btn-block">
              <i class="fa fa-file-lines pr-2"></i>สิทธิ์การจัดการ
            </a>
          </div>

          <div class="col-xl-3"></div>

          <div class="col-xl-3 mb-2">
            <a href="javascript:void(0)" class="btn btn-sm btn-success btn-block machine-report">
              <i class="fa fa-download pr-2"></i>นำข้อมูลออก
            </a>
          </div>
        </div>

        <div class="row justify-content-end mb-2">
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm type-select"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm department-select"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <select class="form-control form-control-sm location-select"></select>
          </div>
          <div class="col-xl-3 mb-2">
            <a href="/asset/create" class="btn btn-sm btn-primary btn-block">
              <i class="fa fa-plus pr-2"></i>เพิ่ม
            </a>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-xl-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover data">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="20%">ชื่อ</th>
                    <th width="10%">เลขที่ทรัพย์สิน</th>
                    <th width="10%">รหัสอุปกรณ์</th>
                    <th width="10%">ประเภท</th>
                    <th width="10%">ฝ่าย/แผนก</th>
                    <th width="10%">สถานที่</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  filter_datatable();

  // $(document).on("change", ".checklist-select", function() {
  //   let checklist = ($(this).val() ? $(this).val() : "");
  //   if (checklist) {
  //     $(".data").DataTable().destroy();
  //     filter_datatable(checklist);
  //   } else {
  //     $(".data").DataTable().destroy();
  //     filter_datatable();
  //   }
  // });

  function filter_datatable(checklist) {
    $(".data").DataTable({
      serverSide: true,
      searching: true,
      scrollX: true,
      order: [],
      ajax: {
        url: "/asset/data",
        type: "POST",
        data: {
          checklist: checklist
        }
      },
      columnDefs: [{
        targets: [0],
        className: "text-center",
      }],
      "oLanguage": {
        "sLengthMenu": "แสดง _MENU_ ลำดับ ต่อหน้า",
        "sZeroRecords": "ไม่พบข้อมูลที่ค้นหา",
        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ ลำดับ",
        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 ลำดับ",
        "sInfoFiltered": "",
        "sSearch": "ค้นหา :",
        "oPaginate": {
          "sFirst": "หน้าแรก",
          "sLast": "หน้าสุดท้าย",
          "sNext": "ถัดไป",
          "sPrevious": "ก่อนหน้า"
        }
      },
    });
  };
</script>