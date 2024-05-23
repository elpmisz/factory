<?php
$menu = "service";
$page = "service-asset";
include_once(__DIR__ . "/../layout/header.php");
?>

<div class="row mb-2">
  <div class="col-xl-12">
    <div class="card shadow">
      <div class="card-header">
        <h4 class="text-center">ASSET</h4>
      </div>
      <div class="card-body">

        <div class="row justify-content-end mb-2">
          <div class="col-xl-12">
            <form action="/factory/asset/machine/add" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">

              <div class="row mb-2">
                <label class="col-xl-4 col-form-label text-xl-right">ASSET IMAGE</label>
                <div class="col-xl-6">
                  <table class="table table-borderless">
                    <tr class="tr-file">
                      <td class="text-center" width="5%">
                        <button type="button" class="btn btn-sm btn-success increase-file">+</button>
                        <button type="button" class="btn btn-sm btn-danger decrease-file">-</button>
                      </td>
                      <td>
                        <input type="file" class="form-control-file" name="file[]" accept=".jpeg, .png, .jpg">
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="row mb-2">
                <label class="col-xl-4 col-form-label text-xl-right">NAME</label>
                <div class="col-xl-6">
                  <input type="text" class="form-control form-control-sm" name="name" required>
                  <div class="invalid-feedback">
                    REQUIRED!
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <label class="col-xl-4 col-form-label text-xl-right">ASSET NO.</label>
                <div class="col-xl-4">
                  <input type="text" class="form-control form-control-sm" name="code" required>
                  <div class="invalid-feedback">
                    REQUIRED!
                  </div>
                </div>
              </div>
              <div class="row mb-2">
                <label class="col-xl-4 col-form-label text-xl-right">TYPE</label>
                <div class="col-sm-4">
                  <select class="form-control form-control-sm type-select" name="type_id" required></select>
                  <div class="invalid-feedback">
                    REQUIRED!
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-xl-6">
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">DEPARTMENT</label>
                    <div class="col-xl-8">
                      <select class="form-control form-control-sm department-select" name="department_id"></select>
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">LOCATION</label>
                    <div class="col-xl-8">
                      <select class="form-control form-control-sm location-select" name="location_id"></select>
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">SERIAL NUMBER</label>
                    <div class="col-xl-8">
                      <input type="text" class="form-control form-control-sm" name="serial_number" required>
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">ASSET CODE</label>
                    <div class="col-xl-8">
                      <input type="text" class="form-control form-control-sm" name="asset_code" required>
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">kW</label>
                    <div class="col-xl-8">
                      <input type="number" class="form-control form-control-sm" name="kw" step="0.01">
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-6">
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">BRAND</label>
                    <div class="col-xl-8">
                      <select class="form-control form-control-sm brand-select" name="brand_id" required></select>
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">MODEL</label>
                    <div class="col-xl-8">
                      <select class="form-control form-control-sm model-select" name="model_id" disabled></select>
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">PURCHASE</label>
                    <div class="col-xl-8">
                      <input type="text" class="form-control form-control-sm date-select" name="purchase_date">
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <label class="col-xl-4 col-form-label text-xl-right">EXPIRE</label>
                    <div class="col-xl-8">
                      <input type="text" class="form-control form-control-sm date-select" name="expire_date">
                      <div class="invalid-feedback">
                        REQUIRED!
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-2 div-specific-field"></div>

              <div class="row mb-2">
                <label class="col-xl-4 col-form-label text-xl-right">REMARK</label>
                <div class="col-xl-6">
                  <textarea class="form-control form-control-sm" name="text" rows="4"></textarea>
                </div>
              </div>

              <div class="row justify-content-center mb-2">
                <div class="col-xl-3 mb-2">
                  <button type="submit" class="btn btn-sm btn-success btn-block">
                    <i class="fas fa-check pr-2"></i>SUBMIT
                  </button>
                </div>
                <div class="col-xl-3 mb-2">
                  <a href="/asset" class="btn btn-sm btn-danger btn-block">
                    <i class="fa fa-arrow-left pr-2"></i>BACK TO HOME
                  </a>
                </div>
              </div>


            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . "/../layout/footer.php"); ?>
<script>
  $(".decrease-file").hide();
  $(document).on("click", ".increase-file", function() {
    let row = $(".tr-file:last");
    let clone = row.clone();
    clone.find("input").val("");
    clone.find(".increase-file").hide();
    clone.find(".decrease-file").show();
    clone.find(".decrease-file").on("click", function() {
      $(this).closest("tr").remove();
    });
    row.after(clone);
    clone.show();
  });

  $(document).on("change", "input[name='file[]']", function() {
    let file = $(this).val();
    let size = ($(this)[0].files[0].size / (1024 * 1024)).toFixed(2);
    let extension = file.split(".").pop().toLowerCase();
    let allow = ["png", "jpeg", "jpg"];
    if (size > 1) {
      Swal.fire({
        icon: "error",
        title: "No more than 5 Mb!",
      })
      $(this).val("");
    }

    if ($.inArray(extension, allow) === -1) {
      Swal.fire({
        icon: "error",
        title: "Only Image files JPG and PNG",
      })
      $(this).val("");
    }
  });

  $(document).on("change", ".type-select", function() {
    let type = $(this).val();

    axios.post("/factory/asset/machine/type-item", {
        type: type
      })
      .then((res) => {
        let result = res.data;
        if (result.length > 0) {
          $(".div-specific-field").show();
          let div = '';
          result.forEach((v, k) => {
            let type = parseInt(v.type);
            div += '<div class="col-xl-6">';
            div += '<div class="row mb-2">';
            div += '<label class="col-xl-4 col-form-label text-xl-right">' + v.name + '</label>';
            div += '<div class="col-xl-8">';
            div += '<input type="hidden" name="item_id[]" value="' + v.id + '" readonly>';
            div += '<input type="hidden" name="item_type[]" value="' + v.type + '" readonly>';
            if (type === 1) {
              div += '<input type="text" class="form-control form-control-sm" name="item_value[]" ' + v.required_name + '>';
            }
            if (type === 2) {
              div += '<input type="number" class="form-control form-control-sm" step="0.01" name="item_value[]" ' + v.required_name + '>';
            }
            if (type === 3) {
              let text = v.text;
              let option = text.split(",");
              div += '<select class="form-control form-control-sm option-select" name="item_value[]" ' + v.required_name + '>';
              div += '<option value="">-- SELECT --</option>';
              option.forEach((value, index) => {
                div += '<option value="' + index + '">' + value + '</option>';
              });
              div += '</select>';
            }
            if (type === 4) {
              div += '<input type="text" class="form-control form-control-sm date-select" name="item_value[]" ' + v.required_name + '>';
            }
            div += '<div class="invalid-feedback">REQUIRED!</div>';
            div += '</div>';
            div += '</div>';
            div += '</div>';
          });
          $(".div-specific-field").empty().html(div);
        } else {
          $(".div-specific-field").hide();
          $("input[name='item_id[]'],input[name='item_type[]'],input[name='item_value[]']").val("");
          $("input[name='item_value[]']").prop("required", false);
        }

        $(".option-select").select2({
          placeholder: "-- SELECT --",
          width: "100%",
          allowClear: true,
        });

        $(".date-select").daterangepicker({
          autoUpdateInput: false,
          singleDatePicker: true,
          showDropdowns: true,
          locale: {
            "format": "DD/MM/YYYY",
          },
          "applyButtonClasses": "btn-success",
          "cancelClass": "btn-danger"
        });

        $(".date-select").on("apply.daterangepicker", function(ev, picker) {
          $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });

        $(".date-select").on("keydown paste", function(e) {
          e.preventDefault();
        });
      }).catch((error) => {
        console.log(error);
      });
  });

  $(".type-select").select2({
    placeholder: "-- TYPE --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/factory/asset/machine/type-select",
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

  $(".department-select").select2({
    placeholder: "-- DEPARTMENT --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/factory/asset/machine/department-select",
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

  $(".location-select").select2({
    placeholder: "-- LOCATION --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/factory/asset/machine/location-select",
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

  $(".brand-select").select2({
    placeholder: "-- BRAND --",
    allowClear: true,
    width: "100%",
    ajax: {
      url: "/factory/asset/machine/brand-select",
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

  $(document).on("change", ".brand-select", function() {
    let brand = $(this).val();
    $(".model-select").empty();
    if (brand) {
      $(".model-select").prop("disabled", false);
      $(".model-select").prop("required", true);
      $(".model-select").select2({
        placeholder: "-- MODEL --",
        width: "100%",
        allowClear: true,
        ajax: {
          url: "/factory/asset/machine/model-select",
          method: 'POST',
          dataType: 'json',
          delay: 100,
          data: function(params) {
            return {
              keyword: params.term,
              brand: brand
            }
          },
          processResults: function(data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
    } else {
      $(".model-select").prop("disabled", true);
      $(".model-select").prop("required", false);
    }
  });

  $(".date-select").daterangepicker({
    autoUpdateInput: false,
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
      "format": "DD/MM/YYYY",
    },
    "applyButtonClasses": "btn-success",
    "cancelClass": "btn-danger"
  });

  $(".date-select").on("apply.daterangepicker", function(ev, picker) {
    $(this).val(picker.startDate.format("DD/MM/YYYY"));
  });

  $(".date-select").on("keydown paste", function(e) {
    e.preventDefault();
  });
</script>