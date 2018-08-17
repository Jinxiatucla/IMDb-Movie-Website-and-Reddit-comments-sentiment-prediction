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
            <h3>Add Actor to Movie</h3>
            <form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
              <div class="form-group">
                 <label for="Movie">Movie</label>
                 <select class="form-control" name='movieid'>
			<option value=NULL> </option>
		<?php
     // Create connection
     $conn = new mysqli("localhost", "cs143", "", "CS143");

    // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }						
		//get all movies and create an option for each one
     $rs = $conn->query("SELECT id, title, year FROM Movie ORDER BY title;");
		
		while($row = $rs->fetch_array())
{
if ($row[2] !=0)
{
		echo '<option value="',$row[0],'">',$row[1],' (', $row[2], ')</option>';
}
else
{
echo '<option value="',$row[0],'">',$row[1], '</option>';
}
}
		$rs->free();
		?>
		</select><br>
              <div class="form-group">
                 <label for="Actor">Actor</label>
                 <select class="form-control" name='actorid'>
			<option value=NULL> </option>
		<?php
     // Create connection
     $conn = new mysqli("localhost", "cs143", "", "CS143");

    // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }						
		//get all actors and create an option for each one
     $rs = $conn->query("SELECT id, first, last, dob FROM Actor ORDER BY first, last, id;");
		
		while($row = $rs->fetch_array())
		echo '<option value="',$row[0],'">',$row[1],' ',$row[2],' (', $row[3], ')</option>';
		$rs->free();
		?>
		</select><br>
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <input type="text" class="form-control" placeholder="Text input" name="role">
                </div>                
                <button type="submit" class="btn btn-default">Add!</button>
            </form>

        </div>
</div>

<div class="numstyle">
<?php
//if ($_SERVER["REQUEST_METHOD"] == "GET"){
     //get input values
     $movieid = $_GET["movieid"];
     $actorid = $_GET["actorid"];
     $role = $_GET["role"];

	
     // Create connection
     $conn = new mysqli("localhost", "cs143", "", "CS143");

    // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }

if($movieid !="" && $actorid !="")
{
    // prepare and bind
	$stmt = $conn->prepare("INSERT INTO MovieActor (mid, aid, role) VALUES (?, ?, ?)");
	$stmt->bind_param("iis", $movieid, $actorid, $role);

     
     
    //excute
    $result = $stmt->execute();
   

    //report error
    if($result == TRUE){echo "New records created successfully!<br>";

    }elseif($result == FALSE){echo "Failed to create new records!<br>";
    }
    
    $rs->free();
    $stmt->close();
    $conn->close();
}
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


