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
 $mid = $_GET["identifier"];

 // Create connection
 $conn = new mysqli("localhost", "cs143", "", "CS143");

 // Check connection
 if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
 }
 
 //show movie title, producer, MPAA rate
 $query = "SELECT title, company, rating FROM Movie WHERE id = $mid";
 $rs = $conn->query($query);
 $result = $rs->fetch_array();
 
 //show movie director
 $query_ = "SELECT did FROM MovieDirector WHERE mid = $mid";
 $rs_ = $conn->query($query_);
 $result_ = $rs_->fetch_array();
 
 if($result_ != NULL){
            $query___ = "SELECT first, last FROM Director WHERE id = $result_[0]";
            $rs___ = $conn->query($query___);
            $result___ = $rs___->fetch_array();
            $rs___->free();
 }elseif($result_ == NULL){$result___[0] = 'Unknown'; $result___[1]='';}

 //show movie genre
 $query__ = "SELECT genre FROM MovieGenre WHERE mid = $mid";
 $rs__ = $conn->query($query__);
// $result__ = $rs__->fetch_array();
 /*
 if($result__ != NULL){
           
 }elseif($result__ == NULL){$result__ = 'Unknown';}
 */
 echo "<h4><b>Movie information</b></h4><table align = 'center' class='a'><thead> <tr><td>Title</td><td>Producer</td><td>MPAA rating</td><td>Director</td><td>Genre</td></thead></tr>";
 echo "<tbody><tr><td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result___[0] $result___[1] </td>";
 echo "<td>";
 while($result__ = $rs__->fetch_array()){echo "$result__[0]<br>"; }
 //for($i = 0; $i < count($result__); $i++){ echo "$result__[$i]<br>"; }
 echo "</td></tr>";
 echo "</table>";
 $rs->free();
 $rs_->free();
 $rs__->free();
 
   
 //show actors name and role in this Movies 
 $query2 = "SELECT aid, role FROM MovieActor WHERE mid = $mid"; 
 $rs2 = $conn->query($query2);
 
 echo "<h4><b>Actors and Roles</b></h4><table align = 'center' class='a'><thead> <tr><td>Actor</td><td>role</td></thead></tr>";
 while($row = $rs2->fetch_array()) {
       //find movie title according to mid
       $query3 = "SELECT first, last FROM Actor WHERE id = $row[0]"; 
       $rs3 = $conn->query($query3);
       $result = $rs3->fetch_array();
       //echo $result[0];
       echo "<tbody><tr><td>$result[0] $result[1]</td><td>$row[1]</td></tr>";
       $rs3->free();       
      }
 echo "</table>";
 $rs2->free();


 //show review of this movie
 $query4 = "SELECT rating, comment FROM Review WHERE mid = $mid";   
 $rs4 = $conn->query($query4);
 //$res = $rs4->fetch_array();
 
 /*if($res == NULL){ 
    $rs4->fetch_array()
    
 }elseif($res != NULL){*/
    $sum = 0;
    $k = 0;
    echo "<h4><b> Movie comments</b></h4><table align = 'center' class='a'><thead> <tr><td>Comment</td></thead></tr>";
    while($res = $rs4->fetch_array()) {
        $sum += $res[0];
        $k += 1;
        echo "<tbody><tr><td>$res[1]</td></tr>";
     
    }  
    if($k == 0){echo "<h4><b><a href='pageI3.php'>No comment yet, please add comment here!</a></b></h4>";}
    echo "</table>";
    $ave = $sum/$k;
    echo "<h4><b> Average score:$ave </b></h4>";  
 //}
 $rs4->free();
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
          <h3><b> Search Actor/Actress/Movie Information:</b></h3>        
           <label for="search_input">Search:</label>
          <form class="form-group" action="pageS1.php" method ="GET" id="usrform">
              <input type="text" id="search_input"class="form-control" placeholder="Search..." name="result"><br>
              <input type="submit" value="Search!" class="btn btn-default" style="margin-bottom:10px">
          </form>
</div>

</body>
</html>