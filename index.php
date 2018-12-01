<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
  <?php 
  require_once 'formprocessor.php';
  ?>
  <div class = "container">

  <?php
    $mysqli = new mysqli('127.0.0.1', 'root', "", 'newHospitalDB')
    or die(mysqli_error($mysqli));

    $result = $mysqli->query("SELECT * FROM Doctor") or die($mysqli->error);
    // pre_r($result);
    // Fetches records for us. Create while loop to keep fetching until no more
    // pre_r($result->fetch_assoc());
    // pre_r($result->fetch_assoc());
    ?>

    

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                 <th> Doctor ID </th>
                 <th> First Name </th>
                 <th> Last Name</th>
                 <th> Department ID</th>
                 <th> Speciality </th>
                 <th colspan="2"> Action </th>
                </tr>
            </thead>

            <?php
    // everything is fetched from db and stored in row
      while($row = $result->fetch_assoc()):
        var_dump($row);?>

            <tr>
            <td> <?php echo $row['doctorID']; ?></td>
            <td> <?php echo $row['doctorFName']; ?></td>
            <td> <?php echo $row['doctorLname']; ?></td>
            <td> <?php echo $row['idDepartment']; ?></td>
            <td> <?php echo $row['specialty']; ?></td>
            

            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>"
                    class="btn btn-info">Edit</a>
                <a href="formprocessor.php?delete=<?php echo $row['id'];?>"
                    class="btn btn-danger">Delete</a>
            </td>
            </tr>
            
            <?php endwhile;
                var_dump($row);

            ?>
      
                    
        
        </table>
        
    </div>
    
    <?php

    // Prints result in nice format
    function pre_r($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    ?>
    
    <div class="row justify-content-center">
    <form action="formprocessor.php" method="post">

    <div class="form-group">
    <label> First Name</label>
    <input type="text" name="fname" class="form-control" value="">
    </div>

    <div label="form-group">
    <label> Last Name</label>
    <input type="text" name="lname" class="form-control" value="">
    </div>

    <div label="form-group">
    <label> Department ID</label>
    <input type="text" name="departmentID" class="form-control" value="">
    </div>

    <div label = "form-group">
    <label> Speciality </label>
    <input type="text" name="speciality" class="form-control" value="">
    </div>

    <div class="form-group">
    <button class="btn btn-primary" type="submit" name="save">Save</button>
    </div>

    </form>
    </div>
    </div>
     
  </body>
</html>