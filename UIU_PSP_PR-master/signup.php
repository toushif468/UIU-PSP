<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | UIU PSP</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/signup.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert One' rel='stylesheet'>
</head>

<body>



    <div class="signup_page">
        <div class="signup_page_container">
            <div class="heading text-center">
                <h1>UIU PSP</h1>
                <!-- <p>Get help by helping others :)</p> -->
                <br>
                <h3>Create Account</h3>
                <br>
            </div>

            <form class="signup_form" action="#">
                <div class="error-text">This is an error text</div>

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="floatingInput1" placeholder="Name" required>
                    <label for="floatingInput1">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="tel" name="student_id" class="form-control" id="floatingInput2"
                        placeholder="Student Id" required>
                    <label for="floatingInput2">Student Id</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput3"
                        placeholder="Email (University Provided)" required>
                    <label for="floatingInput3">Email (University Provided)</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password" required>
                    <label for="floatingPassword">Password</label>

                </div>
                <br>
                <div class="buttons">
                    <a href="/UIU_PSP_PR/login.php" class="btn btn-success">Go back to Login</a>
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </div>
            </form>


        </div>
    </div>



    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="javascript/signup.js"></script>
</body>

</html>