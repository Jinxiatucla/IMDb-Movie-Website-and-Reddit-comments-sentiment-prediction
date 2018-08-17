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
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3><b> Search Actor/Actress/Movie Information:</b></h3>        
           <label for="search_input">Search:</label>
          <form class="form-group" action="PageS1.php" method ="GET" id="usrform">
              <input type="text" id="search_input"class="form-control" placeholder="Search..." name="result"><br>
              <input type="submit" value="Search!" class="btn btn-default" style="margin-bottom:10px">
          </form>
</div>

<div class="numstyle">
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET"){
 $input = $_GET["result"];
 //delete spaces before and after input
 $temp = trim($input);

 // Create connection
 $conn = new mysqli("localhost", "cs143", "", "CS143");

 // Check connection
 if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
 }

 if($temp != ""){
      $words_list = explode(" ", $temp);

      //show Actor results
      $query = "SELECT id, first, last, dob FROM Actor WHERE CONCAT(first,' ', last) LIKE '%$words_list[0]%'";
      for($i=1; $i < count($words_list); $i++){
          $query = $query."AND CONCAT(first,' ', last) LIKE '%$words_list[$i]%'";
      }
      

      $rs = $conn->query($query);
      echo "<h4><b>matching Actors are:</b></h4><table align = 'center' class='a'><thead> <tr><td>Name</td><td>Date of Birth</td></thead></tr>";
      while($row = $rs->fetch_array()) {
      
          echo "<tbody><tr><td><a href=' Show_A.php?identifier=$row[0] '>$row[1] $row[2]</a></td><td><a href=' Show_A.php?identifier=$row[0] '>$row[3]</a></td></tr>";
             
                
      }
      echo "</table>";
      $rs->free();
     
      //show Movie results
      $query2 = "SELECT id, title, year FROM Movie WHERE title LIKE '%$words_list[0]%'";
      for($j=1; $j < count($words_list); $j++){
          $query2 = $query2."AND title LIKE '%$words_list[$j]%'";
      }
      

      $rs2 = $conn->query($query2);
      echo "<h4><b>matching Movies are:</b></h4><table align = 'center' class='a'><thead> <tr><td>Title</td><td>Year</td></thead></tr>";
      while($row = $rs2->fetch_array()) {
      
          echo "<tbody><tr><td><a href=' Show_M.php?identifier=$row[0] '>$row[1]</a></td><td><a href=' Show_M.php?identifier=$row[0] '>$row[2]</a></td></tr>";
             
                
      }
      echo "</table>";
      $rs2->free();
     
      
  } 

      

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
</body>
</html>
