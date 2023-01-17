<?php
session_start();
include_once 'php/config.php';

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UIU PSP</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert One' rel='stylesheet'>
</head>

<body>

    <?php
    $sql = mysqli_query($connection, "SELECT * FROM users WHERE student_id = '{$_SESSION['user_id']}'");
    if ($sql) {
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        }
    }
    ?>
    <div class="user_dashboard">
        <div class="home-page-wrapper">


            <div class="top_bar">
                <nav class="navbar navbar-dark">
                    <div class="container-fluid px-4">
                        <a class="navbar-brand"
                            style="color: #f50; font-size: 30px; font-weight: 700; letter-spacing: .5px;"
                            href="index.php"> UIU PSP</a>
                        <!-- <img src="resources/logo.png" style="width: 64px;"></img> -->
                        <nav class="navbar navbar-expand-sm">

                            <div class="">
                                <!-- Links -->
                                <ul class="navbar-nav align-items-center">
                                    <li class="nav-item me-5" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Post your problem">
                                        <a class="nav-link problem_post_icon pblm-post" href="#" data-bs-toggle="modal"
                                            data-bs-target="#problemPost"></a>
                                    </li>
                                    <li class="nav-item me-5" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Question Paper Upload">
                                        <a class="nav-link qp_upload ques-upload-btn" href="#" data-bs-toggle="modal"
                                            data-bs-target="#quesitonPaperUpload"></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="navbar-brand profile_pic" href="profile.php">
                                            <img src="resources/profile-pic/<?php echo $row['img'] ?>" alt="Your Photo"
                                                class="rounded-pill" data-bs-toggle="tooltip" title="Profile">
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </nav>


                        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                            <span class="navbar-toggler-icon" style="font-size: 1.8rem;"></span>
                        </button>
                        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                            aria-labelledby="offcanvasDarkNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Profile</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="navbar-brand d-flex align-items-center" href="profile.php">
                                            <img src="resources/profile-pic/<?php //echo $row['img'] ?>" alt="Your Photo"
                                                style="width:40px;" class="rounded-pill me-3">
                                            <h5 class="name" style="line-height: 40px; margin: 0;">
                                                <?php //echo $row['name'] ?>
                                            </h5>
                                        </a>
                                    </li>
                                </ul>
                                
                            </div>
                        </div> -->
                    </div>
                </nav>
            </div>
            <div class="user_dashboard_container mt-4">

                <div class="user_activity">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-lg-5" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                                aria-selected="true">Activity</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-lg-5" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                aria-controls="profile-tab-pane" aria-selected="false">Pending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-lg-5" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact-tab-pane" type="button" role="tab"
                                aria-controls="contact-tab-pane" aria-selected="false">Solved</button>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active post-activity-pane" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="post-container">
                                <div class="posts activity-posts">

                                    <?php
                                    $allQSql = mysqli_query($connection, "SELECT problem_id FROM problem_asked");
                                    for ($i = 0; $i < mysqli_num_rows($allQSql); $i++) {
                                        echo '
                                        <div class="card" aria-hidden="true">
                                        <div class="card-body">
                                            <h5 class="card-title placeholder-glow">
                                                <span class="placeholder col-12 h4 rounded"></span>
                                            </h5>
                                            <p class="card-text placeholder-glow">
                                                <span class="placeholder col-12 h1 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-5" style="visibility:hidden;"></span>
                                                <span class="placeholder col-2 h5 mt-2  rounded"></span>
                                                <span class="placeholder col-2 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-4 h5 mt-2 rounded"
                                                    style="margin-left:10px"></span>
                                            </p>
                                        </div>
                                        </div>
                                        ';
                                    }
                                    ?>




                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="post-container">
                                <div class="posts pending-posts">
                                    <?php
                                    $allQSql = mysqli_query($connection, "SELECT problem_id FROM problem_asked");
                                    for ($i = 0; $i < mysqli_num_rows($allQSql); $i++) {
                                        echo '
                                        <div class="card" aria-hidden="true">
                                        <div class="card-body">
                                            <h5 class="card-title placeholder-glow">
                                                <span class="placeholder col-12 h4 rounded"></span>
                                            </h5>
                                            <p class="card-text placeholder-glow">
                                                <span class="placeholder col-12 h1 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-5" style="visibility:hidden;"></span>
                                                <span class="placeholder col-2 h5 mt-2  rounded"></span>
                                                <span class="placeholder col-2 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-4 h5 mt-2 rounded"
                                                    style="margin-left:10px"></span>
                                            </p>
                                        </div>
                                        </div>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="post-container">
                                <div class="posts solved-posts">
                                    <?php
                                    $allQSql = mysqli_query($connection, "SELECT problem_id FROM problem_asked");
                                    for ($i = 0; $i < mysqli_num_rows($allQSql); $i++) {
                                        echo '
                                        <div class="card" aria-hidden="true">
                                        <div class="card-body">
                                            <h5 class="card-title placeholder-glow">
                                                <span class="placeholder col-12 h4 rounded"></span>
                                            </h5>
                                            <p class="card-text placeholder-glow">
                                                <span class="placeholder col-12 h1 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-5" style="visibility:hidden;"></span>
                                                <span class="placeholder col-2 h5 mt-2  rounded"></span>
                                                <span class="placeholder col-2 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-3 h5 mt-2 rounded"></span>
                                                <span class="placeholder col-4 h5 mt-2 rounded"
                                                    style="margin-left:10px"></span>
                                            </p>
                                        </div>
                                        </div>
                                        ';
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="rated_students_list">
                    <h5 style="color:#fff; 
                        text-align: center; 
                        font-size: 20px;
                        font-weight:bolder; 
                        letter-spacing:0.5px;
                        margin-bottom: 20px;">
                        Top Contributors
                    </h5>


                    <div class="list-group">

                        <ul>
                            <li class="list-group-item list-heading">
                                <div class="user">
                                    <p>User</p>
                                </div>
                                <div class="rating">
                                    <p>Rating</p>
                                </div>
                            </li>
                            <?php
                            $topUserSql = mysqli_query($connection, "SELECT name,img,rating FROM users ORDER BY rating desc");
                            if (mysqli_num_rows($topUserSql) > 0) {
                                for ($i = 0; $i < 10; $i++) {
                                    if ($userRow = mysqli_fetch_assoc($topUserSql)) {
                                        echo '
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="user-info d-flex align-items-center justify-content-center">
                                        <div style="
                                    width: 30px;
                                    height: 30px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    margin-right: 10px;
                                    overflow: hidden;
                                    border-radius: 50%;">
                                            <a>
                                                <img src="resources/profile-pic/' . $userRow['img'] . '" alt="Avatar"
                                                    style="width: 30px;height: 30px;
                                                    object-fit: cover;" class="">
                                            </a>
                                        </div>
                                        <h6>' . $userRow['name'] . '</h6>
                                    </div>
                                    <span>' . $userRow['rating'] . '</span>


                                    </li>
                                    
                                    ';
                                    } else {
                                        break;
                                    }

                                }
                            }

                            ?>

                        </ul>

                    </div>

                    <div class="buttons">
                        <!-- <button type="submit" name="btnClicked" class="btn  pblm-post" data-bs-toggle="modal"
                            data-bs-target="#problemPost">Post your problem</button> -->
                        <!-- <button type="button" class="btn mt-2 ques-up ques-upload-btn" data-bs-toggle="modal"
                            data-bs-target="#quesitonPaperUpload">
                            Upload Question Paper
                        </button> -->
                        <a href="php/logout.php?logout_id=<?php //echo $row['student_id'] ?>"
                            class="btn custom-btn logout-btn">Logout <i class="fa fa-sign-out"></i></a>


                        <!-- <div class="modal fade" id="quesitonPaperUpload">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Question Paper</h1>
                                        <button type="button" class="btn-close ques-upload-cancel-btn"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="quesionUploadFrom" enctype="multipart/form-data" action="#"
                                            autocomplete="off">
                                            <div class="course-id-container mb-2">
                                                <div class="form-floating course-id-automate">
                                                    <input type="text" name="course-code" class="form-control"
                                                        id="courseCode" placeholder="Type a name here..." />
                                                    <label for="courseCode">Course Code</label>
                                                </div>
                                                <ul class="course-search-list"></ul>
                                            </div>

                                            <?php
                                            // $current_year = getdate()['year'];
                                            // echo
                                            //     '<div class="mb-3">
                                            // <p style="margin-bottom:0px;">Select Trimester</p>
                                            // <div class="form-check form-check-inline">
                                            //     <input class="form-check-input" type="radio" name="trimester-code"
                                            //         id="inlineRadio1" value="' . substr($current_year, 2, 3) . '1">
                                            //     <label class="form-check-label" for="inlineRadio1">Spring ' . $current_year . '</label>
                                            // </div>
                                            // <div class="form-check form-check-inline">
                                            //     <input class="form-check-input" type="radio" name="trimester-code"
                                            //         id="inlineRadio2" value="' . substr($current_year, 2, 3) . '2">
                                            //     <label class="form-check-label" for="inlineRadio2">Summer ' . $current_year . '</label>
                                            // </div>
                                            // <div class="form-check form-check-inline">
                                            //     <input class="form-check-input" type="radio" name="trimester-code"
                                            //         id="inlineRadio3" value="' . substr($current_year, 2, 3) . '3">
                                            //     <label class="form-check-label" for="inlineRadio3">Fall ' . $current_year . '</label>
                                            // </div>
                                            // </div>';
                                            
                                            ?>

                                            <div class="mb-3">
                                                <p style="margin-bottom:3px;">Question Paper Type</p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="exam"
                                                        id="midRadio" value="Mid">
                                                    <label class="form-check-label" for="midRadio">Mid</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="exam"
                                                        id="finalRadio" value="Final">
                                                    <label class="form-check-label" for="finalRadio">Final</label>
                                                </div>
                                            </div>


                                            <div class="mt-2">
                                                <label class="form-label text-dark" style="margin:0 0 0 1px;"
                                                    for="profilePic">Select quesiton paper (only pdf)</label>
                                                <input type="file" class="form-control" name="qpFile" id="questionFile"
                                                    placeholder="">
                                            </div>
                                            <br>

                                            <div class="buttons">
                                            <button type="submit" class="btn btn-primary">Sign up</button>
                                            <a href="/Student_Hub/login.php" class="btn btn-success">Go back to Login</a>
                                        </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary ques-upload-cancel-btn"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary qp-upload-btn">Upload <i
                                                        class="fa fa-angle-double-up"></i></button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div> -->




                        <!-- <div class="modal fade" id="problemPos" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Post your problem</h1>
                                        <button type="button" class="btn-close pblm-post-cancel-btn"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="problem-post-form" enctype="multipart/form-data" action="#"
                                            autocomplete="off">

                                            <div class="course-id-container">
                                                <div class="form-floating course-id-automate">
                                                    <input type="text" name="course" class="form-control"
                                                        id="courseCode1" placeholder="Type a name here..." />
                                                    <label for="courseCode1">Enter the Course (your problem is related
                                                        to)</label>
                                                </div>
                                                <ul class="course-search-list prob-post-search-list"></ul>
                                            </div>

                                            <div class="form-floating mt-2">
                                                <input type="text" name="topic" class="form-control" id="problemTitle"
                                                    placeholder="Name" required>
                                                <label for="problemTitle">Topic Name</label>
                                            </div>

                                            <div class="form-floating mt-2">
                                                <input type="text" name="title" class="form-control" id="problemTitle"
                                                    placeholder="Name" required>
                                                <label for="problemTitle">Title</label>
                                            </div>
                                            <div class="form-floating mt-2" style="overflow: hidden;">
                                                <div class="cover"
                                                    style="border-radius: 5px;position: absolute; top: 0px; height: 20px; width: calc(100% - 2px); margin: 1px 1px 0; background-color: #fff; z-index: 10;">
                                                </div>
                                                <textarea class="form-control" name="description"
                                                    placeholder="Leave a comment here" id="floatingTextarea2"
                                                    style="min-height: 100px; white-space: pre-wrap" ;></textarea>
                                                <label for="floatingTextarea2" style="z-index: 100;">Description</label>
                                            </div>

                                            <div class="mt-2">
                                                <label class="form-label text-dark" style="margin:0 0 0 1px;"
                                                    for="profilePic">Select the pictures/screenshots (only png, jpg,
                                                    jpeg)</label>
                                                <input type="file" name="p_img[]" multiple class="form-control"
                                                    id="profilePic" placeholder="">
                                            </div>



                                            <br>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary pblm-post-cancel-btn"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button"
                                                    class="btn btn-primary problem-post-submit-btn">Post</i></button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div> -->




                    </div>
                </div>

            </div>







        </div>
        <div class="user-db-footer">
            <p> Develeped by <span>Dynamic Spectacles</span> Team</p>
        </div>
    </div>

    <!-- ---------------------------- Model ---------------------------------- -->

    <div class="modal fade" id="problemPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Post your problem</h4>
                    <button type="button" class="btn-close pblm-post-cancel-btn" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="problem-post-form" enctype="multipart/form-data" action="#" autocomplete="off">

                        <div class="course-id-container">
                            <div class="form-floating course-id-automate">
                                <input type="text" name="course" class="form-control" id="courseCode1"
                                    placeholder="Type a name here..." />
                                <label for="courseCode1">Enter the Course (your
                                    problem is related
                                    to)</label>
                            </div>
                            <ul class="course-search-list prob-post-search-list">
                            </ul>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="text" name="topic" class="form-control" id="problemTitle" placeholder="Name"
                                required>
                            <label for="problemTitle">Topic Name</label>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="text" name="title" class="form-control" id="problemTitle" placeholder="Name"
                                required>
                            <label for="problemTitle">Title</label>
                        </div>
                        <div class="form-floating mt-2" style="overflow: hidden;">
                            <div class="cover"
                                style="border-radius: 5px;position: absolute; top: 0px; height: 20px; width: calc(100% - 2px); margin: 1px 1px 0; background-color: #fff; z-index: 10;">
                            </div>
                            <textarea class="form-control" name="description" placeholder="Leave a comment here"
                                id="floatingTextarea2" style="min-height: 100px; white-space: pre-wrap" ;></textarea>
                            <label for="floatingTextarea2" style="z-index: 100;">Description</label>
                        </div>

                        <div class="mt-2">
                            <label class="form-label text-dark" style="margin:0 0 0 1px;" for="profilePic">Select
                                the pictures/screenshots (only png, jpg,
                                jpeg)</label>
                            <input type="file" name="p_img[]" multiple class="form-control" id="profilePic"
                                placeholder="">
                        </div>



                        <br>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary pblm-post-cancel-btn"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary problem-post-submit-btn">Post</i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- ---------------------------- Model ---------------------------------- -->
    <div class="modal fade" id="quesitonPaperUpload">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload Question Paper</h4>
                    <button type="button" class="btn-close ques-upload-cancel-btn" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="quesionUploadFrom" enctype="multipart/form-data" action="#" autocomplete="off">
                        <div class="course-id-container mb-2">
                            <div class="form-floating course-id-automate">
                                <input type="text" name="course-code" class="form-control" id="courseCode"
                                    placeholder="Type a name here..." />
                                <label for="courseCode">Course Code</label>
                            </div>
                            <ul class="course-search-list pp-course-search-list"></ul>
                        </div>

                        <?php
                        $current_year = getdate()['year'];
                        echo
                            '<div class="mb-3">
                                            <p style="margin-bottom:0px;">Select Trimester</p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="trimester-code"
                                                    id="inlineRadio1" value="' . substr($current_year, 2, 3) . '1">
                                                <label class="form-check-label" for="inlineRadio1">Spring ' . $current_year . '</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="trimester-code"
                                                    id="inlineRadio2" value="' . substr($current_year, 2, 3) . '2">
                                                <label class="form-check-label" for="inlineRadio2">Summer ' . $current_year . '</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="trimester-code"
                                                    id="inlineRadio3" value="' . substr($current_year, 2, 3) . '3">
                                                <label class="form-check-label" for="inlineRadio3">Fall ' . $current_year . '</label>
                                            </div>
                                            </div>';

                        ?>

                        <div class="mb-3">
                            <p style="margin-bottom:3px;">Question Paper Type</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exam" id="midRadio" value="Mid">
                                <label class="form-check-label" for="midRadio">Mid</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exam" id="finalRadio" value="Final">
                                <label class="form-check-label" for="finalRadio">Final</label>
                            </div>
                        </div>


                        <div class="mt-2">
                            <label class="form-label text-dark" style="margin:0 0 0 1px;" for="profilePic">Select
                                quesiton paper (only pdf)</label>
                            <input type="file" class="form-control" name="qpFile" id="questionFile" placeholder="">
                        </div>
                        <br>

                        <!-- <div class="buttons">
                                            <button type="submit" class="btn btn-primary">Sign up</button>
                                            <a href="/Student_Hub/login.php" class="btn btn-success">Go back to Login</a>
                                        </div> -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary ques-upload-cancel-btn"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary qp-upload-btn">Upload
                                <i class="fa fa-angle-double-up"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="javascript/index.js"></script>



    <script>
    var animateButton = function(e) {
        e.preventDefault; //reset animation             e.target.classList.remove('animate');
        e.target.classList.add('animate');
        setTimeout(function() {
            e.target.classList.remove('animate');
        }, 700);
    };
    var bubblyButtons = document.getElementsByClassName("bubbly-button");
    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateButton, false);
    }


    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>

</body>

</html>