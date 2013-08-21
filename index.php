<?php
    // connection
    $link = mysqli_connect("localhost","ronen","123456","ronen") or die("Error " . mysqli_error($link));  

    $armor = $attack = $posted = '';
    if(isset($_POST['submit']) && !empty($_POST['submit'])){
        $armor = $_POST['armor'];
        $attack = $_POST['attack'];
        // query
        $query = "INSERT INTO `fields` (armor, attack) VALUES('$armor','$attack')" or die("Error in the consult.." . mysqli_error($link));;
        $result = $link->query($query);
    }

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <form action="" method="post"> 
            <label for="armor">Armor: </label>
             <input id="armor" name="armor" type="text" value="<?php echo $armor?>" />
            <label for="attack">Attack: </label>
             <input id="attack" name="attack" type="text" value="<?php echo $attack?>" />
            <input type="submit" name="submit" value="submit" />
        </form>  
        <p>   
        <?php 
        //display information:
        if(isset($result) && $result){
            echo "Database modified. Displaying records:<br />";
            while($row = mysqli_fetch_array($result)) {
              echo "Armor:" . $row["armor"] . " Attack:".$row['attack']."<br />";
            }  
        }
        ?>
        </p>
    </body>
</html>
<?php 
    // close connection
    mysqli_close($link);
?>
