<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UIU PSP</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert One' rel='stylesheet'>
</head>

<body>

    <div class="login_page">
        <div class="login_page_container">
            <div class="heading text-center">
                <h1> UIU PSP</h1>
                <br>
                <h3>Log In</h3>
                <br>
            </div>

            <form class="login_form" autocomplete="off" action="#">
                <div class="error-text">This is an error text</div>
                <div class="form-floating mb-3">
                    <input type="tel" name="student_id" class="form-control" id="floatingInput" placeholder="Student Id"
                        required>
                    <label for="floatingInput">Student Id</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password" required>
                    <label for="floatingPassword">Password</label>

                </div>
                <br>
                <div class="buttons">
                    <button type="submit" class="btn btn-primary login-btn">Log in</button>
                    <a href="signup.php" class="btn btn-success">Create a new Account</a>
                </div>
            </form>


        </div>
    </div>



    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="javascript/login.js"></script>
</body>

</html>