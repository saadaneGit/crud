<?php

session_start();
if (isset($_SESSION['users']) == false) {
    header('location: loginPage.php');
}
