<?php

session_start();
include_once("config.php");

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['updateCode'])) {


        if ($_POST['updateCode'] === "updateProfile") {

            // echo $_POST['name'];

            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $id = mysqli_real_escape_string($connection, $_POST['student_id']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);

            if (!empty($name) && !empty($id) && !empty($email) && !empty($password)) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $sql = mysqli_query($connection, "SELECT email,student_id FROM users WHERE email = '{$email}' AND student_id != '{$_SESSION['user_id']}'");



                    if (mysqli_num_rows($sql) > 0) {
                        echo $email . " - This email already exist";
                    } else {
                        $checkUserId = true;
                        if ($_POST['student_id'] != $_SESSION['user_id']) {

                            $checkIdSql = mysqli_query($connection, "SELECT student_id FROM users WHERE student_id = '{$id}'");
                            if (mysqli_num_rows($checkIdSql) > 0) {
                                $checkUserId = false;
                                echo $id . " - Using this id another user exist";
                            }

                        }
                        if (isset($_FILES['profilePic']) && $checkUserId) {
                            $img_name = $_FILES['profilePic']['name'];
                            $img_type = $_FILES['profilePic']['type'];
                            $tmp_name = $_FILES['profilePic']['tmp_name'];

                            $img_explode = explode('.', $img_name);
                            $img_ext = end($img_explode);

                            $extentions = ['png', 'jpeg', 'jpg'];
                            if (in_array($img_ext, $extentions, true) === true) {
                                $time = time();
                                $new_img_name = $time . $img_name;
                                if (move_uploaded_file($tmp_name, "../resources/profile-pic/" . $new_img_name)) {
                                    $sql2 = mysqli_query(
                                        $connection,
                                        "UPDATE users
                                    SET student_id = '{$id}',
                                    name = '{$name}',
                                    email = '{$email}',
                                    password = '{$password}',
                                    img = '{$new_img_name}'
                                    WHERE student_id = '{$_SESSION['user_id']}'"
                                    );
                                    if ($sql2) {
                                        if ($_SESSION['user_id'] != $_POST['student_id']) {
                                            echo "successLog";
                                        } else {
                                            echo "success";
                                        }
                                    } else {
                                        echo "Something went wrong!";
                                    }
                                }
                            } else {
                                $sql2 = mysqli_query(
                                    $connection,
                                    "UPDATE users
                                SET student_id = '{$id}',
                                name = '{$name}',
                                email = '{$email}',
                                password = '{$password}'
                                WHERE student_id = '{$_SESSION['user_id']}'"
                                );
                                if ($sql2) {
                                    if ($_SESSION['user_id'] != $_POST['student_id']) {
                                        echo "successLog";
                                    } else {
                                        echo "success";
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
        // ================================================================>


        if ($_POST['updateCode'] === "updatePPost") {

            $pPostedBy = mysqli_escape_string($connection, $_SESSION['user_id']);

            $course = explode(" - ", $_POST['course']);
            $pCourseCode = end($course);
            $pTopicName = mysqli_escape_string($connection, $_POST['topic']);

            $Ptime = time();
            $problem_id = mysqli_escape_string($connection, $_POST['problem_id']);

            $pTitle = mysqli_escape_string($connection, $_POST['title']);
            $pDescription = mysqli_escape_string($connection, $_POST['description']);
            // echo $pPostedBy . " " . $Ptime . " " . $pTopicName . " " . $pTitle . " " . $pDescription;
            if (!empty($pTitle) && !empty($pDescription) && !empty($pTopicName) && !empty($pCourseCode)) {
                if (isset($_FILES['p_img']['name'][0])) {
                    $totalImg = count($_FILES['p_img']['name']);
                    $successMove = true;
                    $p_img_names = array();
                    for ($i = 0; $i < $totalImg; $i++) {
                        $p_img_name = $_FILES['p_img']['name'][$i];
                        $p_img_type = $_FILES['p_img']['type'][$i];
                        $p_img_tmp_name = $_FILES['p_img']['tmp_name'][$i];
                        $p_img_explode = explode('.', $p_img_name);
                        $p_img_ext = end($p_img_explode);
                        $extentions = ['png', 'jpeg', 'jpg'];
                        if (in_array($p_img_ext, $extentions, true)) {
                            $new_img_name = $Ptime . $p_img_name;
                            if (move_uploaded_file($p_img_tmp_name, "../resources/pblm-imgs/" . $new_img_name)) {
                                array_push($p_img_names, $new_img_name);
                            } else {
                                $successMove = false;
                            }
                        }
                    }

                    if ($successMove) {
                        $probPostSql = mysqli_query($connection, "UPDATE problem_asked SET
                                        course_code = '{$pCourseCode}',
                                        topic_name = '{$pTopicName}',
                                        title = '{$pTitle}',
                                        description = '{$pDescription}'
                                        WHERE problem_id = '{$problem_id}'
                                        ");
                        if ($probPostSql) {
                            mysqli_query($connection, "DELETE FROM pblm_img WHERE problem_id = '{$problem_id}'");

                            foreach ($p_img_names as $x) {

                                $ansImgSql = mysqli_query($connection, "INSERT INTO pblm_img
                                    (img_name,problem_id) VALUES ('{$x}','{$problem_id}')");

                            }
                            echo "success - " . $problem_id;
                        }
                    } else {
                        echo "unsuccessful Move";
                    }
                }
            }

        }

        //==================================================================================================

        if ($_POST['updateCode'] === "ansUpdate") {

            $ans_pblm_id = mysqli_escape_string($connection, $_POST['problem_id']);
            $aDescription = mysqli_escape_string($connection, $_POST['description']);

            $answer_id = mysqli_escape_string($connection, $_POST['answer_id']);

            if (!empty($aDescription)) {
                if (isset($_FILES['solution_img']['name'][0])) {
                    $totalImg = count($_FILES['solution_img']['name']);
                    $successMove = true;
                    $p_img_names = array();
                    for ($i = 0; $i < $totalImg; $i++) {
                        $p_img_name = $_FILES['solution_img']['name'][$i];
                        $p_img_type = $_FILES['solution_img']['type'][$i];
                        $p_img_tmp_name = $_FILES['solution_img']['tmp_name'][$i];
                        $p_img_explode = explode('.', $p_img_name);
                        $p_img_ext = end($p_img_explode);
                        $extentions = ['png', 'jpeg', 'jpg'];
                        if (in_array($p_img_ext, $extentions, true)) {
                            $new_img_name = time() . $p_img_name;
                            if (move_uploaded_file($p_img_tmp_name, "../resources/pblm-imgs/" . $new_img_name)) {
                                array_push($p_img_names, $new_img_name);
                            } else {
                                $successMove = false;
                            }
                        }
                    }

                    if ($successMove) {
                        $ansPostSql = mysqli_query($connection, "UPDATE answer SET
                                        description = '{$aDescription}'
                                        WHERE answer_id = '{$answer_id}'");
                        if ($ansPostSql) {
                            mysqli_query($connection, "DELETE FROM ans_img WHERE ans_id = '{$answer_id}'");

                            foreach ($p_img_names as $x) {
                                $ansImgSql = mysqli_query($connection, "INSERT INTO ans_img
                                    (img_name,ans_id) VALUES ('{$x}','{$answer_id}')");

                            }
                            echo "success - " . $ans_pblm_id;
                        }
                    } else {
                        echo "unsuccessful Move";
                    }
                }
            }

        }

        // ================================================================================





    } else if (isset($_GET['updateCode'])) {
        if ($_GET['updateCode'] === "qpIssue") {

            $qp_id = mysqli_escape_string($connection, $_GET['qp_id']);

            $qpSql = mysqli_query($connection, "SELECT error FROM question_paper WHERE qp_id = '{$qp_id}'");

            if (mysqli_num_rows($qpSql) > 0) {
                $qpRow = mysqli_fetch_assoc($qpSql);
                if ($qpRow['error'] == 1) {
                    mysqli_query($connection, "UPDATE question_paper SET error = 0 WHERE qp_id = '{$qp_id}'");
                    header("location:../profile.php");
                } else {
                    mysqli_query($connection, "UPDATE question_paper SET error = 1 WHERE qp_id = '{$qp_id}'");
                    header("location:../profile.php");
                }
            }


        }
    }

}


?>