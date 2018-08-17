<!DOCTYPE html>
<html lang="en">
<head>
  <title>Database Query system</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3>CS143 Database Query system</h3>
  <ul class="nav nav-tabs">
    <li class="active"><a href="mypages.php">Home</a></li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Input pages <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="pageI1.php">Add Actor/Director</a></li>
        <li><a href="pageI2.php">Add Movie</a></li>
        <li><a href="pageI3.php">Add Comments</a></li>  
        <li><a href="pageI4.php">Add actor to movie</a></li>
        <li><a href="pageI5.php">Add director to movie</a></li>                      
      </ul>
    </li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Browsing pages <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="pageB1.php">Show Actor Information</a></li>
        <li><a href="pageB2.php">Show Movie Information</a></li>                    
      </ul>
    </li>
    <li><a href="pageS1.php">Search page</a></li>
  </ul>
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3>Add new Actor/Director</h3>
            <form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
               <label class="radio-inline">
                    <input type="radio" checked="checked" name="identity" value="Actor"/>
                    Actor
                </label>
                <label class="radio-inline">
                    <input type="radio" name="identity" value="Director"/>Director
                </label>
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" placeholder="Text input"  name="fname"/>
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" placeholder="Text input" name="lname"/>
                </div>
			<div class="form-group">
                  <label for="gender">Gender</label><br>
                <label class="radio-inline">
                    <input type="radio" name="sex" checked="checked" value="male">Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="female">Female
                </label>
			</div>
                <div class="form-group">
                  <label for="DOB">Date of Birth</label>
                  <input type="text" class="form-control" placeholder="Text input" name="dateb">ie: 1997-05-05<br>
                </div>
                <div class="form-group">
                  <label for="DOD">Date of Die</label>
                  <input type="text" class="form-control" placeholder="Text input" name="dated">(leave blank if alive now)<br>
                </div>
                <button type="submit" class="btn btn-default">Add!</button>
            </form>

        </div>
</div>

<div class="numstyle">
<?php
//if ($_SERVER["REQUEST_METHOD"] == "GET"){
     //get input values
     $identity = $_GET["identity"];
     $fname = $_GET["fname"];
     $lname = $_GET["lname"];
     $sex = $_GET["sex"];
     $dateb = $_GET["dateb"];
     $dated = $_GET["dated"];

     // Create connection
     $conn = new mysqli("localhost", "cs143", "", "CS143");

    // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }

    // prepare and bind
    if($identity == "Actor"){     
               if($dated != NULL){
                   $stmt = $conn->prepare("INSERT INTO Actor (id, last, first, sex, dob, dod) VALUES (?, ?, ?, ?, ?, ?)");
                   $stmt->bind_param("isssss", $id, $lname, $fname, $sex, $dateb, $dated);                  
               }else{
                   $stmt = $conn->prepare("INSERT INTO Actor (id, last, first, sex, dob) VALUES (?, ?, ?, ?, ?)");
                   $stmt->bind_param("issss", $id, $lname, $fname, $sex, $dateb);
               }
                                     
    }elseif($identity == "Director"){
               if($dated != NULL){
                   $stmt = $conn->prepare("INSERT INTO Director (id, last, first, dob, dod) VALUES (?, ?, ?, ?, ?)");
                   $stmt->bind_param("issss", $id, $lname, $fname, $dateb, $dated);
               }else{
                   $stmt = $conn->prepare("INSERT INTO Director (id, last, first, dob) VALUES (?, ?, ?, ?)");
                   $stmt->bind_param("isss", $id, $lname, $fname, $dateb);
               }
    }
    
    //find the maxID 
     $query = "SELECT id FROM MaxPersonID;";   
     $rs = $conn->query($query);
     $row = $rs->fetch_array();     
     $maxid = $row[0];    
     $id = $maxid + 1;
     
     
    //excute
    $result = $stmt->execute();
   

    //report error
    if($result == TRUE){echo "New records created successfully!<br>";

         //edit maxID
         $stmt2 = $conn->prepare("UPDATE MaxPersonID SET id=?;");
         if ($stmt2 === false) {
              trigger_error($this->mysqli->error, E_USER_ERROR);           
         }
         $stmt2->bind_param("i", $id);
         $result2 = $stmt2->execute();

         if($result2 == TRUE){echo "MaxID has been edit!<br>";
         }elseif($result2 == FALSE){
               echo "Failed to edit MaxID!<br>";
         }
    }elseif($result == FALSE){echo "Failed to create new records!<br>";
    }
    
    $rs->free();
    $stmt->close();
    $stmt2->close();
    $conn->close();

?>
</div>

<style>
div.numstyle {
text-align: center;
margin:10px;
color:black;
font-size: 120%;
}
</style>
</body>
</html>
