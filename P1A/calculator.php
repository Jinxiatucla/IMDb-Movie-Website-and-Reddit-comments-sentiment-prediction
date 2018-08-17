
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Expression: <input type="text" name="expression">
  <input type="submit">
</form>

<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $exp = $_POST['expression'];
    $valid = '/((\D+)?(-?\d+)(\.\d+)?)+(\)+)?/';
    $divbyzero = '/\/0([+\-*\/$]|$)/';
    if (empty($exp)) {
        echo "Expression is empty";
    } elseif(preg_match( $valid, $exp) != 1){
        echo "Expression is invalid";
    } elseif(preg_match( $divbyzero, $exp ) != 0){
        echo "Expression is divided by zero";
    } else {
        $ma ="$exp";
        $p = eval('return '.$ma.';');
        print "Result: $p";

    }   
       
}

?>

</body>
</html>
