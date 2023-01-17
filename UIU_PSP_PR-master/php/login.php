<?php

session_start();
include_once "config.php";

$id = mysqli_real_escape_string($connection, $_POST['student_id']);
$password = mysqli_real_escape_string($connection, $_POST['password']);

if (!empty($id) && !empty($password)) {

    $sql = mysqli_query($connection, "SELECT student_id FROM users WHERE student_id = '{$id}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $sql2 = mysqli_query($connection, "SELECT password FROM users WHERE password = '{$password}'");
        if (mysqli_num_rows($sql2) > 0) {
            $_SESSION['user_id'] = $row['student_id'];
            echo "success";
        } else {
            echo "Wrong password! try again...";
        }
    } else {
        echo "User does not exist with this ID - " . $id;
    }
}