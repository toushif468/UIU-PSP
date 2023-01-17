<?php

session_start();
include_once("config.php");

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['insertCode'])) {
        // ========================================= Update/Add Course =========================================>


        if ($_POST['insertCode'] === "takenCourse") {
            $studentId = mysqli_escape_string($connection, $_SESSION['user_id']);
            $course = explode(" - ", $_POST['course-code']);
            $courseCode = mysqli_escape_string($connection, end($course));

            $sql1 = mysqli_query($connection, "SELECT course_code FROM taken_courses 
                                                WHERE student_id = '{$studentId}' AND course_code = '{$courseCode}'");
            if (mysqli_num_rows($sql1) > 0) {
                echo "you have already added this course";
            } else {
                $sql = mysqli_query($connection, "INSERT INTO taken_courses (student_id ,course_code) VALUES ('{$studentId}','{$courseCode}')");
                echo "success";
            }
        }

        // ================================== Insert Question Papers ======================================>

        if ($_POST['insertCode'] === "insertQP") {
            $studentId = mysqli_escape_string($connection, $_SESSION['user_id']);
            $course = explode(" - ", $_POST['course-code']);
            $courseCodeShort = explode("/", end($course));
            $qp_id = $_POST['trimester-code'] . "~" . $_POST['exam'] . "~" . str_replace(" ", "_", $courseCodeShort[0]);
            $courseCode = mysqli_escape_string($connection, end($course));
            $trimester = mysqli_escape_string($connection, $_POST['trimester-code']);
            $exam = mysqli_escape_string($connection, $_POST['exam']);


            if (!empty($trimester) && !empty($exam) && !empty($courseCode) && !empty($studentId)) {
                $sql = mysqli_query($connection, "SELECT * FROM question_paper WHERE qp_id = '{$qp_id}' AND error = 1");
                if (mysqli_num_rows($sql) > 0) {
                    echo "Question paper with this information is already exist";
                } else {
                    if (isset($_FILES['qpFile'])) {
                        $qp_name = $_FILES['qpFile']['name'];
                        $qp_type = $_FILES['qpFile']['type'];
                        $tmp_name = $_FILES['qpFile']['tmp_name'];
                        $qp_explode = explode('.', $qp_name);
                        $qp_ext = end($qp_explode);
                        if ($qp_ext == "pdf") {
                            $time = time();
                            $new_qp_name = $qp_id . "~" . $time . ".pdf";
                            if (move_uploaded_file($tmp_name, "../resources/question-paper/" . $new_qp_name)) {
                                $year = substr(getdate()['year'], 2, 4);
                                $trimesterCheckSql = mysqli_query($connection, "SELECT * FROM trimester WHERE trimester_id LIKE '{$year}%'");
                                if (mysqli_num_rows($trimesterCheckSql) > 0) {
                                    $qpUpSql = mysqli_query($connection, "INSERT INTO question_paper 
                                            (qp_id, course_code, trimester_id, ques_type,ques_file,error, uploader_id) VALUES
                                            ('{$qp_id}','{$courseCode}','{$trimester}','{$exam}','{$new_qp_name}', 1, '{$studentId}')");
                                    if ($qpUpSql) {
                                        $ratingSql = mysqli_query($connection, "SELECT rating FROM users WHERE student_id  = '{$_SESSION['user_id']}'");

                                        if (mysqli_num_rows($ratingSql) > 0) {
                                            $UserRatingRow = mysqli_fetch_assoc($ratingSql);
                                            $rating = intval($UserRatingRow['rating']) + 10;
                                            mysqli_query($connection, "UPDATE users SET rating = $rating WHERE student_id = '{$_SESSION['user_id']}'");

                                            echo "success";
                                        }
                                    } else {
                                        echo "Something went wrong!";
                                    }
                                } else {
                                    // this will trimester code in every year
                                    $code = $year . "1";
                                    mysqli_query($connection, "INSERT INTO trimester (trimester_id , trimester_name) VALUES ('{$code}', 'Spring')");
                                    $code = $year . "2";
                                    mysqli_query($connection, "INSERT INTO trimester (trimester_id , trimester_name) VALUES ('{$code}', 'Summer')");
                                    $code = $year . "3";
                                    mysqli_query($connection, "INSERT INTO trimester (trimester_id , trimester_name) VALUES ('{$code}', 'Fall')");

                                    $qpUpSql = mysqli_query($connection, "INSERT INTO question_paper 
                                            (qp_id, course_code, trimester_id, ques_type,ques_file,error, uploader_id) VALUES
                                            ('{$qp_id}','{$courseCode}','{$trimester}','{$exam}','{$new_qp_name}', 1, '{$studentId}')");
                                    if ($qpUpSql) {

                                        $ratingSql = mysqli_query($connection, "SELECT rating FROM users WHERE student_id  = '{$_SESSION['user_id']}'");

                                        if (mysqli_num_rows($ratingSql) > 0) {
                                            $UserRatingRow = mysqli_fetch_assoc($ratingSql);
                                            $rating = intval($UserRatingRow['rating']) + 10;
                                            mysqli_query($connection, "UPDATE users SET rating = $rating WHERE student_id = '{$_SESSION['user_id']}'");

                                            echo "success";
                                        }
                                    } else {
                                        echo "Something went wrong!";
                                    }
                                }



                            }
                        }
                    }
                }
            }
        }



        // ================================= Insert Problem Post's info in db =========================================>



        if ($_POST['insertCode'] === "insertProblem") {
            $pPostedBy = mysqli_escape_string($connection, $_SESSION['user_id']);

            $course = explode(" - ", $_POST['course']);
            $pCourseCode = end($course);
            $pTopicName = mysqli_escape_string($connection, $_POST['topic']);

            $Ptime = time();
            $pblmNoSql = mysqli_query($connection, "SELECT * FROM problem_asked ");
            $problem_id = "P" . mysqli_num_rows($pblmNoSql) . "_" . $Ptime . "_" . $_SESSION['user_id'];

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
                        $probPostSql = mysqli_query($connection, "INSERT INTO problem_asked 
                                        (problem_id,course_code,topic_name,title,description, views, student_id)
                                        VALUES ('{$problem_id}','{$pCourseCode}','{$pTopicName}','{$pTitle}','{$pDescription}', 0,'{$pPostedBy}')");
                        if ($probPostSql) {
                            foreach ($p_img_names as $x) {
                                $pblmImgSql = mysqli_query($connection, "INSERT INTO pblm_img
                                                (img_name,problem_id) VALUES ('{$x}','{$problem_id}')");
                            }
                            $ratingSql = mysqli_query($connection, "SELECT rating FROM users WHERE student_id  = '{$_SESSION['user_id']}'");

                            if (mysqli_num_rows($ratingSql) > 0) {
                                $UserRatingRow = mysqli_fetch_assoc($ratingSql);
                                $rating = intval($UserRatingRow['rating']) + 1;
                                mysqli_query($connection, "UPDATE users SET rating = $rating WHERE student_id = '{$_SESSION['user_id']}'");

                                echo "success";
                            }
                        }
                    } else {
                        echo "unsuccessful Move";
                    }
                }
            }
        }



        // ================================= Insert Answer info in db =========================================>





        if ($_POST['insertCode'] === "insertAnswer") {
            $aPostedBy = mysqli_escape_string($connection, $_SESSION['user_id']);
            $ans_pblm_id = mysqli_escape_string($connection, $_POST['problem_id']);
            $aDescription = mysqli_escape_string($connection, $_POST['description']);

            // $getUserID = mysqli_fetch_assoc(mysqli_query($connection, "SELECT student_id FROM problem_asked WHERE problem_id = '{$_POST['problem_id']}'"));
            // if($getUserID['student_id'] == $_SESSION['user_id']){

            // }

            $solutionNoSql = mysqli_query($connection, "SELECT * FROM answer");
            $answer_id = $_POST['problem_id'] . "_" . "S" . mysqli_num_rows($solutionNoSql);

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
                        $ansPostSql = mysqli_query($connection, "INSERT INTO answer 
                                        (answer_id,description, problem_id, posted_by)
                                        VALUES ('{$answer_id}','{$aDescription}','{$ans_pblm_id}','{$aPostedBy}')");
                        if ($ansPostSql) {
                            foreach ($p_img_names as $x) {
                                $ansImgSql = mysqli_query($connection, "INSERT INTO ans_img
                                            (img_name,ans_id) VALUES ('{$x}','{$answer_id}')");
                            }
                            $ratingSql = mysqli_query($connection, "SELECT rating FROM users WHERE student_id  = '{$_SESSION['user_id']}'");

                            if (mysqli_num_rows($ratingSql) > 0) {
                                $UserRatingRow = mysqli_fetch_assoc($ratingSql);
                                $rating = intval($UserRatingRow['rating']) + 3;
                                mysqli_query($connection, "UPDATE users SET rating = $rating WHERE student_id = '{$_SESSION['user_id']}'");

                                echo $_POST['problem_id'];
                            }
                            // header("location: ../problem_panel.php");
                        }
                    } else {
                        echo "unsuccessful Move";
                    }
                }
            }
        }

        // ========================================= insert problem's comment =========================================>


        if ($_POST['insertCode'] === "insertPComment" && isset($_SESSION['current_pblm_id'])) {
            $studentId = mysqli_escape_string($connection, $_SESSION['user_id']);
            $cmntTxt = mysqli_escape_string($connection, $_POST['cmntTxt']);
            $currentPblmId = mysqli_escape_string($connection, $_SESSION['current_pblm_id']);

            if ($cmntTxt != "") {
                $sql = mysqli_query($connection, "INSERT INTO p_comment (comment_text, problem_id, student_id)
                                            VALUES ('{$cmntTxt}','{$currentPblmId}','{$studentId}')");
                if ($sql) {
                    echo "success";
                } else {
                    echo "something wrong";
                }
            }

        }


        // ========================================= insert answer's comment =========================================>


        if ($_POST['insertCode'] === "insertAComment") {
            $studentId = mysqli_escape_string($connection, $_SESSION['user_id']);
            $cmntTxt = mysqli_escape_string($connection, $_POST['aCommentTxt']);
            $currentAnswerId = mysqli_escape_string($connection, $_POST['answer_id']);

            if ($cmntTxt != "") {
                $sql = mysqli_query($connection, "INSERT INTO a_comment (comment_text, answer_id, student_id)
                                            VALUES ('{$cmntTxt}','{$currentAnswerId}','{$studentId}')");
                if ($sql) {
                    echo "success";
                } else {
                    echo "something wrong";
                }
            }
        }

    }

}


?>