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
</div>

<div class="numstyle">
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET"){
 $aid = $_GET["identifier"];

 // Create connection
 $conn = new mysqli("localhost", "cs143", "", "CS143");

 // Check connection
 if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
 }

 //show actor information
 $query = "SELECT first, last, sex, dob, dod FROM Actor WHERE id = $aid";
 $rs = $conn->query($query);
 echo "<h4><b>Actor information </b></h4><table align = 'center' class='a'><thead> <tr><td>Name</td><td>Sex</td><td>Date of Birth</td><td>Date of Death</td></thead></tr>";
 while($row = $rs->fetch_array()) {
       if(row[4] != NULL){
                echo "<tbody><tr><td>$row[0] $row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
       }elseif(row[4] == NULL){
                echo "<tbody><tr><td>$row[0] $row[1]</td><td>$row[2]</td><td>$row[3]</td><td>'Still alive'</td></tr>";
       }
 }
 echo "</table>";
 $rs->free();
     
 //show Actor's Movies and role
 $query2 = "SELECT mid, role FROM MovieActor WHERE aid = $aid"; 
 $rs2 = $conn->query($query2);
 echo "<h4><b>Actor's Movies and role</b></h4><table align = 'center' class='a'><thead> <tr><td>Movie</td><td>role</td></thead></tr>";
 while($row = $rs2->fetch_array()) {
       //find movie title according to mid
       $query3 = "SELECT title FROM Movie WHERE id = $row[0]";
       $rs3 = $conn->query($query3);
       $result = $rs3->fetch_array();
       //echo $result[0];
       echo "<tbody><tr><td><a href=' Show_M.php?identifier=$row[0] '>$result[0]</td><td>$row[1]</td></tr>";
       $rs3->free();       
      }
 echo "</table>";
 $rs2->free();


      

}
?>
</div>

<style>
div.numstyle {
text-align: center;
margin:10px;
color:black;
font-size: 100%;
}
</style>
<style>
table {
    border-collapse: collapse;
    border: 1px solid black;
} 

th,td {
    border: 1px solid black;
}

table.a {
    table-layout: auto;
    width: 500px;    
}

table.b {
    table-layout: fixed;
    width: 180px;    
}

table.c {
    table-layout: auto;
    width: 100%;    
}

table.d {
    table-layout: fixed;
    width: 100%;    
}
</style>



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h6><b> Search Actor/Actress/Movie Information:</b></h6>        
           <label for="search_input">Search:</label>
          <form class="form-group" action="pageS1.php" method ="GET" id="usrform">
              <input type="text" id="search_input"class="form-control" placeholder="Search..." name="result"><br>
              <input type="submit" value="Search!" class="btn btn-default" style="margin-bottom:10px">
          </form>
</div>

</body>
</html>