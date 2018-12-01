<?php
// Connect to mysql database 
$mysqli = new mysqli('127.0.0.1','root',"",'newHospitalDB') or die(mysqli_error($mysqli));

// Check if the save button has been pressed
if(isset($_POST['save'])){
    // store naem and location
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $departID = $_POST['departmentID'];
    $special =  $_POST['speciality'];

    // Insert records into database
    $mysqli -> query("INSERT INTO Doctor(doctorFName , doctorLname , idDepartment, specialty)
     VALUES('$firstname', '$lastname', '$departID' , '$special')") or
    die($mysqli->error);
}

// get is whats passed in the url
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM Doctor WHERE id=$id") or 
    die($mysqli->error());
}