<?php
    ini_set('display_errors', 1);error_reporting(E_ALL);      // debug
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once $root.'/includes/database.php';

    $armor = $attack = '';
    if (isset($_POST['add']) && !empty($_POST['add'])) {
        $armor  = $db->escape_value($_POST['armor']);
        $attack = $db->escape_value($_POST['attack']);
        // query
        $query = "INSERT INTO `fields` (armor, attack) VALUES('$armor','$attack')" ;
        $result = $db->query($query);
    } elseif (isset($_POST['clear']) && !empty($_POST['clear'])) {
        $query = "TRUNCATE table fields";
        $result = $db->query($query);
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
        <link rel="stylesheet" href="css/tablesorter.css">
        <link rel="stylesheet" href="css/jquery.tablesorter.pager.css">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript">window.jQuery.migrateMute || document.write('<script src="js/jquery-migrate-1.2.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/fancyInput.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
        <!--<script type="text/javascript" src="js/jquery.formrestrict.js"></script>
        <script type="text/javascript" src="js/jquery.alphanumeric.js"></script>-->
        <script type="text/javascript" src="js/site.js"></script>
    </head>
    <body>
        <div id="wrap">
            <form action="" method="post" id="myForm">
                <input type="hidden" name="myAction" id="actionType" />
                <label for="armor">Armor: </label>
                <div class="fancyInput">
                    <input id="armor" name="armor" type="text" value="<?php echo $armor?>" />
                </div>
                <label for="attack">Attack: </label>
                <div class="fancyInput">
                    <input id="attack" name="attack" type="text" value="<?php echo $attack?>" />
                </div>
                <br>
                <input type="submit" name="add" value="Add Record" />
                <input type="submit" name="clear" value="Reset" />
            </form>
            <div>
                <?php
                //display information:
                if(isset($result) && $result){
                    echo "Database modified. <br />";
                }
                $query = "SELECT * FROM `fields`" ;
                $result = $db->query($query);
                echo "<strong>Displaying records:</strong><br />
                    <table id='results' class='tablesorter' border='1' cellpadding='1' cellspacing='1'>
                        <thead>
                            <tr><th>ID</th><th>Armor</th><th>Attack</th></tr>
                        </thead>
                        <tbody>";
                while($row = $db->fetch_array($result)) {
                    echo "<tr><td>{$row['id']}</td><td>{$row['armor']}</td><td>{$row['attack']}</td></tr>";
                }
                echo "</tbody><table>";
                ?>
                <div id="pager">
	                <form>
		                <img src="img/first.png" class="first" alt="First" title="First">
		                <img src="img/prev.png" class="prev" alt="Previous" title="Previous">
		                <input type="text" class="pagedisplay">
		                <img src="img/next.png" class="next" alt="Next" title="Next">
		                <img src="img/last.png" class="last" alt="Last" title="Last">
		                <select class="pagesize">
			                <option selected="selected" value="10">10</option>
			                <option value="20">20</option>
			                <option value="30">30</option>
			                <option value="40">40</option>
		                </select>
	                </form>
                </div>   
            </div>
        </div>
    </body>
</html>
<?php 
    // close connection
    $db->close_connection()
?>