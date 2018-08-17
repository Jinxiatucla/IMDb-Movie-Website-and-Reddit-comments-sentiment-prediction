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
            <h3>Add Comments</h3>
            <form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
                 <div class="form-group">
                  <label for="reviewer_name">Reviewer Name</label>
                  <input type="text" class="form-control" placeholder="Text input"  name="rname">
                </div>

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
  		</div>

                <div class="form-group">
                    <label for="rating">Review Rating (over 5)</label><br>
                    <label class="radio-inline">
                    <input type="radio" name="rating" value="1"/>
                    1
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="2"/>
                  2
                </label>
				<label class="radio-inline">
                    <input type="radio" name="rating" value="3"/>
                    3
                </label>
                <label class="radio-inline">
                    <input type="radio" name="rating" value="4"/>
                  4
                </label>
				<label class="radio-inline">
                    <input type="radio" name="rating" value="5"/>
                    5
                </label>
                </div>              
                <div class="form-group">
                  <label for="comment">Comment (less than 500 characters)</label>
                  <input type="text" class="form-control" placeholder="Text input" name="comment">
                </div>                
                <button type="submit" class="btn btn-default">Add!</button>
            </form>

        </div>
</div>

<div class="numstyle">
<?php
//if ($_SERVER["REQUEST_METHOD"] == "GET"){
     //get input values
    $rname = $_GET["rname"]; 
	$movieid = $_GET["movieid"];
     $rating = $_GET["rating"];
     $comment = $_GET["comment"];
	$time = time();

	
     // Create connection
     $conn = new mysqli("localhost", "cs143", "", "CS143");

    // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }

if($movieid !="" && $rname !="")
{
    // prepare and bind
	$stmt = $conn->prepare("INSERT INTO Review (name, time, mid, rating, comment) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("ssiis", $rname, date('Y-m-d H:i:s',time()), $movieid, $rating, $comment);

     
     
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


