<?phpsession_start;


// starting a session so we can go back to main page




// Connect to mysql database 
$mysqli = new mysqli('127.0.0.1','root',"",'v2HospitalDB') or die(mysqli_error($mysqli));
// If we are not able to connect for some reason then this will run below
if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Error code from last connect call: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error description from last connect error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
// Reset values to empty 
$firstname = "";
$lastname = "";
$departID = "";
$special =  "";
$update = false;
$id = 0;

// Check if the save button has been pressed
if(isset($_POST['save'])){
    // store columns from database
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $departID = $_POST['departmentID'];
    $special =  $_POST['speciality'];

    

    // Insert records into database
    $mysqli -> query("INSERT INTO Doctor(doctorFName , doctorLname , idDepartment, specialty)
     VALUES('$firstname', '$lastname', '$departID' , '$special')") or
    die($mysqli->error);

    // will show at top of screen once the record has been saved
    $_SESSION['message'] = "You have saved a record into the database";
    $_SESSION['msg_type'] = "success";

    // redirect back to the index.php after inserting records
    header("location: index.php");
}

// This will delete the record from the table based on the id
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM Doctor WHERE idDepartment AND doctorID = '$id'") or die($mysqli->error);


 // When you delete a record, will show at top of screen
 $_SESSION['message'] = "You have saved a deleted a record from the database";
 $_SESSION['msg_type'] = "danger";
    // redirect back to the index page
    header("location:index.php");
    // session_destroy();

     

   
}

// If the edit button is clicked
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    // change back to where doctorId and idDepartment
    $result = $mysqli->query("SELECT * FROM Doctor WHERE doctorID = '$id'") or die($mysqli->error);
    // will fetch all colums in table from the result array
    // If the record has been found in the database
    if(count($result->num_rows == 1)){
        $row = $result->fetch_array();
        $firstname = $row['doctorFName'];
        $lastname = $row['doctorLname'];
        $idDepart = $row['idDepartment'];
        $special = $row['specialty'];
        //  echo (var_dump($result));
        
   
    }

     // will show at top of page when user updates the table
     $_SESSION['message'] = "Record has been selected";
     $_SESSION['msg_type'] = "info";
    //  header('location: index.php');
    //  session_destroy();

}

// If user clicks update then will insert values into columns
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $idDepart = $_POST['departmentID'];
    $special = $_POST['speciality'];

    $idDepart = preg_replace("/[^0-9,.]/", "", $idDepart);


    $mysqli->query("UPDATE Doctor SET doctorFName = '$firstname', 
    doctorLname = '$lastname', idDepartment = '$idDepart', 
    specialty = '$special' WHERE doctorID = $id ") or die($mysqli->error);
  
//   $mysqli->query(" INSERT INTO Doctor (doctorID,doctorFName,doctorLname, 
//   idDepartment,specialty) VALUES( null , '$firstname','$lastname',
//   '$idDepart','$special') ") or die($mysqli->error);


    // will show at top of page when user updates the table
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";
    header('location: index.php');
    // session_destroy();

}