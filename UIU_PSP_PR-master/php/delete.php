<?php

session_start();
include_once("config.php");

if (isset($_SESSION['user_id'])) {

    if (isset($_GET['deleteCode'])) {
        // echo "success";

        if ($_GET['deleteCode'] === "takenCourse") {
            $studentId = mysqli_escape_string($connection, $_SESSION['user_id']);
            $courseCode = mysqli_escape_string($connection, $_GET['course_code']);
            $sql1 = mysqli_query($connection, "DELETE FROM taken_courses 
                                                WHERE student_id = '{$studentId}' AND course_code = '{$courseCode}'");
            if ($sql1) {
                header("location: ../profile.php");
            }
        }

        if ($_GET['deleteCode'] === "deletePP") {
            $problem_id = mysqli_escape_string($connection, $_GET['post_id']);
            $sql1 = mysqli_query($connection, "DELETE FROM problem_asked 
                                                WHERE problem_id = '{$problem_id}' AND student_id = '{$_SESSION['user_id']}'")
                or die(mysqli_error($connection));
            if (mysqli_affected_rows($connection) > 0) {
                header("location: ../index.php");
            } else {
                header("location: ../problem_panel.php?post_id=" . $problem_id);
            }
        }
        if ($_GET['deleteCode'] === "deleteAns") {
            $ans_id = mysqli_escape_string($connection, $_GET['ans_id']);
            $sql1 = mysqli_query($connection, "DELETE FROM answer 
                                                WHERE answer_id = '{$ans_id}' AND posted_by = '{$_SESSION['user_id']}'")
                or die(mysqli_error($connection));
            if (mysqli_affected_rows($connection) > 0) {
                header("location: ../problem_panel.php?post_id=" . $_SESSION['current_pblm_id']);
            } else {
                // header("location: ../index.php");
            }
        }



    }


}


?>