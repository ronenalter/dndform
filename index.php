<?php
    //ini_set('display_errors', 1);error_reporting(E_ALL);
    include 'connection.php';
    $armor = $attack = $posted = '';
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
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width">
        <title>DND Form</title>
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/fancyInput.css">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/fancyInput.js"></script>
        <script type="text/javascript" src="js/site.js"></script>
    </head>
    <body>
        <div id="wrap">
            <form action="" method="post">
                    <label for="armor">Armor: </label>
                    <div class="fancyInput">
                        <input id="armor" name="armor" type="text" value="<?php echo $armor?>" />
                    </div>
                    <label for="attack">Attack: </label>
                    <div class="fancyInput">
                        <input id="attack" name="attack" type="text" value="<?php echo $attack?>" />
                    </div>
                    <br>
                    <input type="submit" name="submit" value="Add Record" />
                    <input type="submit" name="clear" value="Reset" />
                </form
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
                </div></div>
    </body>
</html>
<?php 
    // close connection
    mysqli_close($link);
?>