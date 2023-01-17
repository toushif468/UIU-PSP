<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | UIU PSP</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/question_paper.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Concert One' rel='stylesheet'>
</head>

<body>

    <div class="signup_page">
        <div class="signup_page_container">
            <div class="heading text-center">
                <h3>Enter the information to upload question paper</h3>
                <br>
            </div>

            <form class="signup_form" action="#">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Name" required>
                    <label for="floatingInput">Course Code</label>
                </div>
                <select class="form-select mb-3" aria-label="Default select example" required>
                    <option value="" selected>Select the question type</option>
                    <option value="CT">CT</option>
                    <option value="Assignment">Assignment</option>
                    <option value="Mid">Mid</option>
                    <option value="Final">Final</option>
                </select>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Email (University Provided)"
                        required>
                    <label for="floatingInput">Trimester Code (222 for Summer 2022)</label>
                </div>
                <div>
                    <label class="form-label text-light" for="questionFile">Question Paper (only .pdf)</label>
                    <input type="file" class="form-control" id="questionFile" placeholder="Question Paper (only .pdf)"
                        required>
                </div>
                <br>
                <br>
                <div class="buttons">
                    <button type="submit" class="btn btn-primary float-right">Upload</button>
                </div>
            </form>


        </div>
    </div>



    <script src="bootstrap/bootstrap.min.js"></script>
</body>

</html>