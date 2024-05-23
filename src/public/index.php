<?php
require_once(__DIR__ . "/vendor/autoload.php");

$ROUTER = new AltoRouter();

##################### DASHBOARD-MACHINE #####################
$ROUTER->map("GET", "/dashboard-machine", function () {
  require(__DIR__ . "/src/Views/dashboard/machine.php");
});
$ROUTER->map("POST", "/dashboard-machine/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/helpdesk/machine-action.php");
});

##################### DASHBOARD-COUNT #####################
$ROUTER->map("GET", "/dashboard-counter", function () {
  require(__DIR__ . "/src/Views/dashboard/counter.php");
});
$ROUTER->map("POST", "/dashboard-counter/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/helpdesk/counter-action.php");
});

##################### DASHBOARD-ENERGY #####################
$ROUTER->map("GET", "/dashboard-energy", function () {
  require(__DIR__ . "/src/Views/dashboard/energy.php");
});
$ROUTER->map("POST", "/dashboard-energy/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/helpdesk/energy-action.php");
});

##################### SERVICE-HELPDESK #####################
$ROUTER->map("GET", "/helpdesk", function () {
  require(__DIR__ . "/src/Views/helpdesk/index.php");
});
$ROUTER->map("POST", "/helpdesk/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/helpdesk/action.php");
});

##################### SERVICE-PREVENTIVE #####################
$ROUTER->map("GET", "/preventive", function () {
  require(__DIR__ . "/src/Views/preventive/index.php");
});
$ROUTER->map("POST", "/preventive/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/preventive/action.php");
});

##################### SERVICE-ASSET #####################
$ROUTER->map("GET", "/asset", function () {
  require(__DIR__ . "/src/Views/asset/index.php");
});
$ROUTER->map("GET", "/asset/create", function () {
  require(__DIR__ . "/src/Views/asset/create.php");
});
$ROUTER->map("GET", "/asset/report/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/excel.php");
});
$ROUTER->map("GET", "/asset/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/edit.php");
});
$ROUTER->map("GET", "/asset/detail/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/detail.php");
});
$ROUTER->map("POST", "/asset/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset/action.php");
});

##################### ASSET-TYPE #####################
$ROUTER->map("GET", "/asset/type", function () {
  require(__DIR__ . "/src/Views/asset-type/index.php");
});
$ROUTER->map("GET", "/asset/type/create", function () {
  require(__DIR__ . "/src/Views/asset-type/create.php");
});
$ROUTER->map("GET", "/asset/type/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-type/edit.php");
});
$ROUTER->map("POST", "/asset/type/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-type/action.php");
});

##################### ASSET-CHECKLIST #####################
$ROUTER->map("GET", "/asset/checklist", function () {
  require(__DIR__ . "/src/Views/asset-checklist/index.php");
});
$ROUTER->map("GET", "/asset/checklist/create", function () {
  require(__DIR__ . "/src/Views/asset-checklist/create.php");
});
$ROUTER->map("GET", "/asset/checklist/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-checklist/edit.php");
});
$ROUTER->map("POST", "/asset/checklist/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-checklist/action.php");
});

##################### ASSET-BRAND #####################
$ROUTER->map("GET", "/asset/brand", function () {
  require(__DIR__ . "/src/Views/asset-brand/index.php");
});
$ROUTER->map("GET", "/asset/brand/create", function () {
  require(__DIR__ . "/src/Views/asset-brand/create.php");
});
$ROUTER->map("GET", "/asset/brand/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-brand/edit.php");
});
$ROUTER->map("POST", "/asset/brand/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-brand/action.php");
});

##################### ASSET-LOCATION #####################
$ROUTER->map("GET", "/asset/location", function () {
  require(__DIR__ . "/src/Views/asset-location/index.php");
});
$ROUTER->map("GET", "/asset/location/create", function () {
  require(__DIR__ . "/src/Views/asset-location/create.php");
});
$ROUTER->map("GET", "/asset/location/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-location/edit.php");
});
$ROUTER->map("POST", "/asset/location/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-location/action.php");
});

##################### ASSET-DEPARTMENT #####################
$ROUTER->map("GET", "/asset/department", function () {
  require(__DIR__ . "/src/Views/asset-department/index.php");
});
$ROUTER->map("GET", "/asset/department/create", function () {
  require(__DIR__ . "/src/Views/asset-department/create.php");
});
$ROUTER->map("GET", "/asset/department/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-department/edit.php");
});
$ROUTER->map("POST", "/asset/department/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/asset-department/action.php");
});

##################### SYSTEM #####################
$ROUTER->map("GET", "/system", function () {
  require(__DIR__ . "/src/Views/system/index.php");
});
$ROUTER->map("POST", "/system/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/system/action.php");
});

##################### USER #####################
$ROUTER->map("GET", "/user", function () {
  require(__DIR__ . "/src/Views/user/index.php");
});
$ROUTER->map("GET", "/user/create", function () {
  require(__DIR__ . "/src/Views/user/create.php");
});
$ROUTER->map("GET", "/user/profile", function () {
  require(__DIR__ . "/src/Views/user/profile.php");
});
$ROUTER->map("GET", "/user/change", function () {
  require(__DIR__ . "/src/Views/user/change.php");
});
$ROUTER->map("GET", "/user/download", function () {
  require(__DIR__ . "/src/Views/user/download.php");
});
$ROUTER->map("GET", "/user/edit/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/user/edit.php");
});
$ROUTER->map("POST", "/user/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/user/action.php");
});

##################### SERVICE #####################
$ROUTER->map("GET", "/service", function () {
  require(__DIR__ . "/src/Views/service/index.php");
});
$ROUTER->map("POST", "/service/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/service/action.php");
});

##################### AUTHORIZE #####################
$ROUTER->map("GET", "/auth", function () {
  require(__DIR__ . "/src/Views/authorize/index.php");
});
$ROUTER->map("POST", "/auth/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/authorize/action.php");
});

##################### HOME #####################
$ROUTER->map("GET", "/", function () {
  require(__DIR__ . "/src/Views/home/login.php");
});
$ROUTER->map("GET", "/home", function () {
  require(__DIR__ . "/src/Views/home/index.php");
});
$ROUTER->map("GET", "/error", function () {
  require(__DIR__ . "/src/Views/home/error.php");
});
$ROUTER->map("GET", "/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/home/action.php");
});
$ROUTER->map("POST", "/[**:params]", function ($params) {
  require(__DIR__ . "/src/Views/home/action.php");
});

$MATCH = $ROUTER->match();

if (is_array($MATCH) && is_callable($MATCH["target"])) {
  call_user_func_array($MATCH["target"], $MATCH["params"]);
} else {
  header("HTTP/1.1 404 Not Found");
  require_once(__DIR__ . "/src/Views/home/error.php");
}