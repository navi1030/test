<?php
session_start();
require_once('../../database/db_conn.php');
require_once('../../database/system_admin/main.func.php');
require_once('../../database/system_admin/system_admin.func.php');

define('RMV_ADD_URL', '/efine-merged/public/system_admin/rmv-add.php');
define('RMV_VIEW_URL', '/efine-merged/public/system_admin/rmv-view.php');

$name = $_POST["name"];
$email = $_POST["email"];
$password = "abc123";
$table = "rmv_admin";
$user_role = "RMV Admin";
$user_id = $_SESSION["user_id"];

if (isset($_POST["submit"])) {

    if (psaAddEmptyInput($name, $email) !== false) {
        header("location: " . RMV_ADD_URL . "?error=emptyInput");
        exit();
    }

    if (invalidName($name) !== false) {
        header("location: " . RMV_ADD_URL . "?error=invalidName");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: " . RMV_ADD_URL . "?error=invalidEmail");
        exit();
    }

    if (emailExists($con, $email) !== false) {
        header("location: " . RMV_ADD_URL . "?error=emailTaken");
        exit();
    } else {
        rmvAdd($con, $name, $email, $user_id);
        userRegister($con, $email, $password, $user_role, $table);
        header("location: " . RMV_VIEW_URL . "?error=none");
        exit();
    }
} else {
    header("location: " . RMV_VIEW_URL . "?error=stmtFailed");
    exit();
}
