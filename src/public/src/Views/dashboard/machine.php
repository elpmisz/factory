<?php
$menu = "dashboard";
$page = "dashboard-machine";

include_once(__DIR__ . "/../layout/header.php");

use App\Classes\DashboardCounter;

$DASHBOARD = new DashboardCounter();
?>
<div class="row">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">รายงาน MACHINE</h4>
      </div>
      <div class="card-body">

        <div class="row">
          <?php
          $machines = range(1, 9);
          foreach ($machines as $machine) :
            $mc = $machine;
            $machine = str_pad($machine, 2, "0", STR_PAD_LEFT);
            $counter = $DASHBOARD->counter_view([$machine]);
            $plan = $DASHBOARD->plan_view([$machine]);
            $weld_drive = [1, 2, 3, 4, 5, 6];
          ?>
            <div class="col-xl-6 mb-2">
              <div class="card shadow">
                <div class="card-header bg-success">
                  <h5 class="text-white">MACHINE <?php echo $machine ?></h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-xl-6 mb-2">
                      <div class="card shadow">
                        <div class="card-body">
                          <h3 class="text-right"><?php echo $plan['job'] ?></h3>
                          <h5 class="text-right"><i class="fa fa-file-lines pr-2"></i>JOB</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 mb-2">
                      <div class="card shadow">
                        <div class="card-body">
                          <h3 class="text-right"><?php echo $plan['target'] ?></h3>
                          <h5 class="text-right"><i class="fa fa-bullseye pr-2"></i>TARGET</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-6 mb-2">
                      <div class="card shadow">
                        <div class="card-body">
                          <h3 class="text-right"><?php echo $counter['input'] ?></h3>
                          <h5 class="text-right"><i class="fa fa-upload pr-2"></i>INPUT</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 mb-2">
                      <div class="card shadow">
                        <div class="card-body">
                          <h3 class="text-right"><?php echo $counter['output'] ?></h3>
                          <h5 class="text-right"><i class="fa fa-download pr-2"></i>OUTPUT</h5>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php if (in_array($machine, $weld_drive)) : ?>
                    <div class="row">
                      <div class="col-xl-6 mb-2">
                        <div class="card shadow">
                          <div class="card-body">
                            <h3 class="text-right"><?php echo $DASHBOARD->energy_view(["{$mc}1"]) ?></h3>
                            <h5 class="text-right"><i class="fa fa-plug pr-2"></i>ENERGY (DRIVE)</h5>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 mb-2">
                        <div class="card shadow">
                          <div class="card-body">
                            <h3 class="text-right"><?php echo $DASHBOARD->energy_view(["{$mc}2"]) ?></h3>
                            <h5 class="text-right"><i class="fa fa-plug pr-2"></i>ENERGY (WELD)</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php else : ?>
                    <div class="row">
                      <div class="col-xl-12 mb-2">
                        <div class="card shadow">
                          <div class="card-body">
                            <h3 class="text-right"><?php echo $DASHBOARD->energy_view(["{$mc}3"]) ?></h3>
                            <h5 class="text-right"><i class="fa fa-plug pr-2"></i>ENERGY</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </div>
</div>


<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  var generateDayWiseTimeSeries = function(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
      var x = baseval;
      var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

      series.push([x, y]);
      baseval += 86400000;
      i++;
    }
    return series;
  }
</script>