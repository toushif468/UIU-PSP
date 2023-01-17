<?php

$connection = mysqli_connect("localhost", "root", "", "uiu_psp");
if (!$connection) {
    echo "error" . mysqli_connect_error();
}
