<?php
    //ini_set('display_errors', 1);error_reporting(E_ALL);
    $host = 'localhost';     
    $user = 'root';         
    $password = '123456';
    $db = 'ronen';
    $armor = $attack = $posted = '';
    // connection
    $link = mysqli_connect($host, $user, $password, $db) or die("Error ".mysqli_error($link));  
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        $armor  = $_POST['armor'];
        $attack = $_POST['attack'];
        // query
        $query = "INSERT INTO `fields` (armor, attack) VALUES('$armor','$attack')" ;
        $result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
    } elseif (isset($_POST['clear']) && !empty($_POST['clear'])) {
        $query = "TRUNCATE table fields";
        $result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
    }

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>DND Form</title>
    </head>
    <body>
        <form action="" method="post"> 
            <label for="armor">Armor: </label>
             <input id="armor" name="armor" type="text" value="<?php echo $armor?>" />
            <label for="attack">Attack: </label>
             <input id="attack" name="attack" type="text" value="<?php echo $attack?>" />
            <input type="submit" name="submit" value="Add Record" />
            <input type="submit" name="clear" value="Reset" />
        </form>  
        <div>   
        <?php 
        //display information:
        if(isset($result) && $result){
            echo "Database modified. <br />";
        }
          $query = "SELECT * FROM `fields`" ;
            $result = $link->query($query) or die("Error in the consult.." . mysqli_error($link));
            echo "<strong>Displaying records:</strong><br />
                <table border='1' cellpadding='1' cellspacing='1'>
                    <thead>
                        <tr><th>ID</th><th>Armor</th><th>Attack</th></tr>
                    </thead><tbody>";
            while($row = mysqli_fetch_array($result)) {
              echo "<tr><td>{$row['id']}</td><td>{$row['armor']}</td><td>{$row['attack']}</td></tr>";
            }  
            echo "</tbody><table>";
        ?>
        </div>
    </body>
</html>
<?php 
    // close connection
    mysqli_close($link);
?>