<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 <TEXTAREA NAME="query" ROWS=5 COLS=30>

</TEXTAREA><br>
<INPUT TYPE="submit" VALUE="submit">
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $query = $_POST['query'];
    //echo $query;
    //--php-sql
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //$query_ = "SELECT * FROM Movie WHERE id=3895;";
    $rs = $db->query($query);
    $fieldinfo=$rs->fetch_fields();
    echo "<table border=1 cellspacing=1 cellpadding=2>";
    echo "<tr>";
    foreach ($fieldinfo as $val){
                     echo "<td>$val->name\n</td>";
    } 
    echo "</tr>";
    //echo "<br />";
    
    while($row = $rs->fetch_array()) {
                echo "<tr>";
                for($l=0; $l<count($row); $l++){
                      if($row[$l] != ''){
                      echo "<td>$row[$l]\n</td>";
                      }
                }
                //echo "<br />";
                echo "</tr>";
    }
    
    echo "</table>";
    print 'Total results: ' . $rs->num_rows;
    $rs->free();
    //--php-sql
}
?>

</body>
</html>
