<?php 
session_start();



// starting a session so we can go back to main page

// Connect to mysql database 
$mysqli = new mysqli('127.0.0.1','root',"",'newHospitalDB') or die(mysqli_error($mysqli));

$firstname = "";
$lastname = "";
$departID = "";
$special =  "";
$update = false;
$id = 0;

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

    $_SESSION['message'] = "You have saved a record into the database";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

// // get is whats passed in the url
// if(isset($_GET['delete'])){
//     $id = $_GET['delete'];
//     $mysqli->query("DELETE FROM Doctor WHERE id='$id'") or 
//     die($mysqli->error());
// }

// This will delete the record from the table based on the id
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM Doctor WHERE idDepartment AND doctorID = '$id'") or die($mysqli->error);


 // When you delete a record, show this message
 $_SESSION['message'] = "You have saved a deleted a record from the database";
 $_SESSION['msg_type'] = "danger";

    header("location:index.php");
     

   
}

if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM Doctor WHERE doctorID = '$id' ") or die($mysqli->error);

    if(count($result) == 1){
        $row = $result->fetch_array();
        $firstname = $row['fname'];
        $lastname = $row['lname'];
        $idDepart = $row['idDepartment'];
        $special = $row['specialty'];
        //  echo (var_dump($result));

    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $idDepart = $_POST['idDepartment'];
    $special = $_POST['specialty'];

    // $mysqli->query("UPDATE Doctor SET doctorFName='$firstname',
    // doctorLname = '$lastname' , idDepartment = '$idDepart', specialty = '$special'
    // WHERE idDepartment='$id' ") or die($mysqli->error);

    $mysqli->query("INSERT INTO Doctor(doctorFname, doctorLname, idDepartment, specialty) VALUES
     ('$firstname', '$lastname', '$idDepart', '$special' ");


    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}