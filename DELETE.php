<?php
include_once("class/RedirectHandler.php");
if (isset($_GET['NR']) && !empty($_GET['NR'])) {
    $deleteID = $_GET['NR'];
}else{
    $error = 'DELETE';
    $error = $_SESSION['error'];
    RedirectHandler::HTTP_301('error.php');
    return $_SESSION['error'];
};
include_once "Class/MovieDatabase.php";
$deleteFilm = new MovieDatabase();
$deleteFilm->formDelete($deleteID);
