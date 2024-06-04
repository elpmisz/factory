<?php
$menu = "dashboard";
$page = "dashboard-counter";
include_once(__DIR__ . "/../layout/header.php");

use App\Classes\DashboardCounter;

$DASHBOARD = new DashboardCounter();
$card = $DASHBOARD->counter_card();
?>
<div class="row mb-2">
  <div class="col-xl-3 mb-2">
    <div class="card bg-primary text-white shadow">
      <div class="card-body">
        <h3 class="text-right"><?php echo (!empty($card['total']) ? number_format($card['total'], 0) : 0) ?></h3>
        <h5 class="text-right">ยอดผลิตทั้งหมด</h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 mb-2">
    <div class="card bg-info text-white shadow">
      <div class="card-body">
        <h3 class="text-right"><?php echo (!empty($card['year']) ? number_format($card['year'], 0) : 0) ?></h3>
        <h5 class="text-right">ยอดผลิตรายปี</h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 mb-2">
    <div class="card bg-success text-white shadow">
      <div class="card-body">
        <h3 class="text-right"><?php echo (!empty($card['month']) ? number_format($card['month'], 0) : 0) ?></h3>
        <h5 class="text-right">ยอดผลิตรายเดือน</h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 mb-2">
    <div class="card bg-danger text-white shadow">
      <div class="card-body">
        <h3 class="text-right"><?php echo (!empty($card['date']) ? number_format($card['date'], 0) : 0) ?></h3>
        <h5 class="text-right">ยอดผลิตรายวัน</h5>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-4 mb-2">
    <div class="row mb-2">
      <div class="col-xl-12">
        <div class="card shadow">
          <div class="card-header">
            กรองข้อมูล
          </div>
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-xl-12 mb-2">
                <select class="form-control form-control-sm machine-select"></select>
              </div>
              <div class="col-xl-12 mb-2">
                <select class="form-control form-control-sm job-select"></select>
              </div>
              <div class="col-xl-12 mb-2">
                <select class="form-control form-control-sm shift-select"></select>
              </div>
              <div class="col-xl-12 mb-2">
                <input type="text" class="form-control form-control-sm date-select" placeholder="-- DATE --">
              </div>
              <div class="col-xl-12 mb-2">
                <button type="button" class="btn btn-sm btn-block btn-success search-btn">
                  <i class="fa fa-search pr-2"></i>ค้นหา
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-8 mb-2">
    <div class="card shadow  mb-2">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-12">
            <div id="job-daily"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mb-2">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover data">
                    <thead>
                      <tr>
                        <th width="10%">MACHINE</th>
                        <th width="20%">JOB NAME</th>
                        <th width="10%">SHIFT</th>
                        <th width="10%">TARGET</th>
                        <th width="10%">ACTUAL</th>
                        <th width="10%">USAGE (kWh)</th>
                        <th width="10%">START</th>
                        <th width="10%">FINISH</th>
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
  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  filter_datatable();

  $(document).on("click", ".search-btn", function() {
    let machine = ($(".machine-select").val() !== null ? $(".machine-select").val() : "");
    let job = ($(".job-select").val() !== null ? $(".job-select").val() : "");
    let shift = ($(".shift-select").val() !== null ? $(".shift-select").val() : "");
    let date = ($(".date-select").val() !== null ? $(".date-select").val() : "");

    if (machine || job || shift || date) {
      $(".data").DataTable().destroy();
      filter_datatable(machine, job, shift, date);

      axios.post("/dashboard-counter/job-daily", {
          machine: machine,
          job: job,
          shift: shift,
          date: date,
        })
        .then((res) => {
          var result = res.data;
          var datas = result.map(item => Number(item.total));
          var categories = result.map(item => item.date);
          jobDaily(datas, categories);
        }).catch((error) => {
          console.log(error);
        });

    } else {
      $(".data").DataTable().destroy();
      filter_datatable();
    }
  });

  function filter_datatable(machine, job, shift, date) {
    $(".data").DataTable({
      serverSide: true,
      searching: false,
      scrollX: true,
      order: [],
      ajax: {
        url: "/dashboard-counter/data",
        type: "POST",
        data: {
          machine: machine,
          job: job,
          shift: shift,
          date: date,
        }
      },
      columnDefs: [{
        targets: [2, 3, 4],
        className: "text-center",
      }, {
        targets: [5],
        className: "text-right",
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

  $(".machine-select").select2({
    placeholder: "-- MACHINE --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/dashboard-counter/machine-select",
      method: "POST",
      dataType: "json",
      delay: 100,
      processResults: function(data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });

  $(".job-select").select2({
    placeholder: "-- JOB NAME --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/dashboard-counter/job-select",
      method: "POST",
      dataType: "json",
      delay: 100,
      processResults: function(data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });

  $(".shift-select").select2({
    placeholder: "-- SHIFT --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/dashboard-counter/shift-select",
      method: "POST",
      dataType: "json",
      delay: 100,
      processResults: function(data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });

  $(".date-select").on("keydown paste", function(e) {
    e.preventDefault();
  });

  $(".date-select").daterangepicker({
    autoUpdateInput: false,
    // minDate: moment(),
    showDropdowns: true,
    startDate: moment(),
    endDate: moment().startOf("day").add(1, "day"),
    locale: {
      "format": "DD/MM/YYYY",
      "applyLabel": "ยืนยัน",
      "cancelLabel": "ยกเลิก",
      "daysOfWeek": [
        "อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"
      ],
      "monthNames": [
        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
        "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
      ]
    },
    "applyButtonClasses": "btn-success",
    "cancelClass": "btn-danger"
  });

  $(".date-select").on("apply.daterangepicker", function(ev, picker) {
    $(this).val(picker.startDate.format("DD/MM/YYYY") + " - " + picker.endDate.format("DD/MM/YYYY"));
  });

  $(".date-select").on('cancel.daterangepicker', function(ev, picker) {
    $(this).val("");
  });

  // CHART

  axios.post("/dashboard-counter/job-daily")
    .then((res) => {
      var result = res.data;
      var datas = result.map(item => Number(item.total));
      var categories = result.map(item => item.date);

      jobDaily(datas, categories);

    }).catch((error) => {
      console.log(error);
    });

  function jobDaily(datas, categories) {
    var options = {
      chart: {
        height: 400,
        width: "100%",
        type: "area",
        animations: {
          initialAnimation: {
            enabled: false
          }
        }
      },
      series: [{
        name: "Series 1",
        data: datas
      }],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.7,
          opacityTo: 0.9,
          stops: [0, 90, 100]
        }
      },
      xaxis: {
        categories: categories,
        title: {
          text: 'DATE'
        }
      },
    };

    var chart = new ApexCharts(document.querySelector("#job-daily"), options);

    chart.render();
  }
</script>