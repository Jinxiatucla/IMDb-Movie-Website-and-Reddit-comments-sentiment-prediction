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
            <h3>Add new Movie</h3>
            <form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
               <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" placeholder="Text input" name="title">
                </div>
                <div class="form-group">
                  <label for="company">Company</label>
                  <input type="text" class="form-control" placeholder="Text input" name="company">
                </div>
                <div class="form-group">
                  <label for="year">Year</label>
                  <input type="text" class="form-control" placeholder="Text input" name="year">
                </div>
                <div class="form-group">
                    <label for="rating">MPAA Rating</label>
                    <select   class="form-control" name="rate">
                        <option value="G">G</option>
                        <option value="NC-17">NC-17</option>
                        <option value="PG">PG</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R</option>
                        <option value="surrendere">surrendere</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >Genre:</label>
					<table width="475px">
						<tr>
							<td><input type="checkbox" name="genre[]" value="Action">Action</td>
							<td><input type="checkbox" name="genre[]" value="Adult">Adult</td>
							<td><input type="checkbox" name="genre[]" value="Adventure">Adventure</td>
							<td><input type="checkbox" name="genre[]" value="Animation">Animation</td>
							<td><input type="checkbox" name="genre[]" value="Comedy">Comedy</td>
                        </tr>
						<tr>
							<td><input type="checkbox" name="genre[]" value="Crime">Crime</td>
							<td><input type="checkbox" name="genre[]" value="Documentary">Documentary</td>
							<td><input type="checkbox" name="genre[]" value="Drama">Drama</td>
							<td><input type="checkbox" name="genre[]" value="Family">Family</td>
							<td><input type="checkbox" name="genre[]" value="Fantasy">Fantasy</td>
						</tr>
						<tr>
                          <td><input type="checkbox" name="genre[]" value="Horror">Horror</td>
							<td><input type="checkbox" name="genre[]" value="Musical">Musical</td>
							<td><input type="checkbox" name="genre[]" value="Mystery">Mystery</td>
							<td><input type="checkbox" name="genre[]" value="Romance">Romance</td>
							<td><input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</td>
						</tr>
						<tr>							
                          <td><input type="checkbox" name="genre[]" value="Short">Short</td>
							<td><input type="checkbox" name="genre[]" value="Thriller">Thriller</td>
							<td><input type="checkbox" name="genre[]" value="War">War</td>
							<td><input type="checkbox" name="genre[]" value="Western">Western</td>
						</tr>
					</table> 
                </div>
                <button type="submit" class="btn btn-default">Add!</button>
            </form>

        </div>
</div>

<div class="numstyle">
<?php
//if ($_SERVER["REQUEST_METHOD"] == "GET"){
     //get input values
     $title = $_GET["title"];
     $company = $_GET["company"];
     $year = $_GET["year"];
     $rate = $_GET["rate"];
     $genre = $_GET["genre"];
    
	
     // Create connection
     $conn = new mysqli("localhost", "cs143", "", "CS143");

    // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
    }

if($title !="" && $year !="")
{
    // prepare and bind
	$stmt = $conn->prepare("INSERT INTO Movie (id, title, year, rating, company) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("issss", $id, $title, $year, $rate, $company);
      $stmt3 = $conn->prepare("INSERT INTO MovieGenre (mid, genre) VALUES (?, ?)");
	$stmt3->bind_param("is", $id, $single_genre);

    //find the maxID 
     $query = "SELECT id FROM MaxMovieID;";   
     $rs = $conn->query($query);
     $row = $rs->fetch_array();     
     $maxid = $row[0];    
     $id = $maxid + 1;
     
     
    //excute
    $result = $stmt->execute();
    if(!empty($genre))
    {
	$N = count($genre);
	for($i=0; $i<$N;$i++)
	{
	  $single_genre = $genre[$i];
	  $result3 = $stmt3->execute();
	}
    }

   

    //report error
    if($result == TRUE){echo "New records created successfully!<br>";

         //edit maxID
         $stmt2 = $conn->prepare("UPDATE MaxMovieID SET id=?;");
         if ($stmt2 == false) {
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

