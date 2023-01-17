<?php

session_start();
include_once("config.php");

if (isset($_SESSION['user_id'])) {

    if (isset($_POST['countCode'])) {

        if ($_POST['countCode'] === "pLike") {
            $studentId = mysqli_escape_string($connection, $_POST['user_id']);
            $problem_id = mysqli_escape_string($connection, $_POST['problem_id']);
            $sql1 = mysqli_query($connection, "SELECT * FROM p_likes WHERE
                                problem_id = '{$problem_id}' AND user_id = '{$studentId}'");

            $allPLikeSql = mysqli_query($connection, "SELECT * FROM p_likes WHERE
            problem_id = '{$_SESSION['current_pblm_id']}'");
            if (mysqli_num_rows($sql1) > 0) {
                mysqli_query($connection, "DELETE FROM p_likes WHERE 
                                    problem_id = '{$problem_id}' AND user_id = '{$studentId}'");
                $allPLikeSql = mysqli_query($connection, "SELECT * FROM p_likes WHERE
                problem_id = '{$_SESSION['current_pblm_id']}'");
                echo "unliked - " . mysqli_num_rows($allPLikeSql);
            } else {
                mysqli_query($connection, "INSERT INTO p_likes (problem_id, user_id) VALUES
                                ('{$problem_id}','{$studentId}')");
                $allPLikeSql = mysqli_query($connection, "SELECT * FROM p_likes WHERE
                problem_id = '{$_SESSION['current_pblm_id']}'");
                echo "liked - " . mysqli_num_rows($allPLikeSql);
            }
        }
        if ($_POST['countCode'] === "aLike") {
            $studentId = mysqli_escape_string($connection, $_POST['user_id']);
            $answer_id = mysqli_escape_string($connection, $_POST['answer_id']);
            $sql1 = mysqli_query($connection, "SELECT * FROM a_likes WHERE
                                answer_id = '{$answer_id}' AND user_id = '{$studentId}'");

            $allPLikeSql = mysqli_query($connection, "SELECT * FROM a_likes WHERE
            answer_id = '{$answer_id}'");
            if (mysqli_num_rows($sql1) > 0) {
                mysqli_query($connection, "DELETE FROM a_likes WHERE 
                                    answer_id = '{$answer_id}' AND user_id = '{$studentId}'");
                $allPLikeSql = mysqli_query($connection, "SELECT * FROM a_likes WHERE
                answer_id = '{$answer_id}'");
                echo "unliked - " . mysqli_num_rows($allPLikeSql);
            } else {
                mysqli_query($connection, "INSERT INTO a_likes (answer_id, user_id) VALUES
                                ('{$answer_id}','{$studentId}')");
                $allPLikeSql = mysqli_query($connection, "SELECT * FROM a_likes WHERE
                answer_id = '{$answer_id}'");
                echo "liked - " . mysqli_num_rows($allPLikeSql);
            }
        }

        if ($_POST['countCode'] === "aStar") {
            $answer_id = mysqli_escape_string($connection, $_POST['answer_id']);
            $qpSql = mysqli_query($connection, "SELECT is_accepted,posted_by FROM answer WHERE answer_id = '{$answer_id}'");

            if (mysqli_num_rows($qpSql) > 0) {
                $qpRow = mysqli_fetch_assoc($qpSql);
                if ($qpRow['is_accepted'] == 1) {
                    mysqli_query($connection, "UPDATE answer SET is_accepted = 0 WHERE answer_id = '{$answer_id}'");


                    $ratingSql = mysqli_query($connection, "SELECT rating FROM users WHERE student_id  = '{$qpRow['posted_by']}'");
                    if (mysqli_num_rows($ratingSql) > 0) {
                        $UserRatingRow = mysqli_fetch_assoc($ratingSql);
                        $rating = intval($UserRatingRow['rating']) - 5;
                        mysqli_query($connection, "UPDATE users SET rating = $rating WHERE student_id = '{$qpRow['posted_by']}'");

                        echo "notAccepted";
                    }

                } else {
                    mysqli_query($connection, "UPDATE answer SET is_accepted = 1 WHERE answer_id = '{$answer_id}'");

                    $ratingSql = mysqli_query($connection, "SELECT rating FROM users WHERE student_id  = '{$qpRow['posted_by']}'");
                    if (mysqli_num_rows($ratingSql) > 0) {
                        $UserRatingRow = mysqli_fetch_assoc($ratingSql);
                        $rating = intval($UserRatingRow['rating']) + 5;
                        mysqli_query($connection, "UPDATE users SET rating = $rating WHERE student_id = '{$qpRow['posted_by']}'");

                        echo "accepted";
                    }
                }
            }
        }


    }


}


?>