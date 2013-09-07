<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ronen
 * Date: 07/09/13
 * Time: 15:32
 * To change this template use File | Settings | File Templates.
 */

class Dndform {
    public $attack;
    public $armor;
    public $result;
    protected $action;

    function __construct(){
        global $db;
        if ($this->checkPost('action')) {
            $this->action = $db->escape_value($_POST['action']);
            switch($this->action){
                case 'clear': $this->resetTable();
                    break;
                case 'add': $this->addRecord();
                    break;
            }
        }
        else echo 'no action chosen';
    }

    protected function checkPost($name){
        if( isset($_POST[$name]) && !empty($_POST[$name]) )
            return true;
        return false;
    }
    protected function addRecord(){
        global $db;
        $this->armor  = $this->validate( $db->escape_value($_POST['armor']) );
        $this->attack = $this->validate( $db->escape_value($_POST['attack']) ) ;
        if(is_int($this->armor) && is_int($this->attack) ){
            $query = "INSERT INTO `fields` (armor, attack) VALUES('$this->armor','$this->attack')" ;
            $this->result = $db->query($query);
        }
    }
    protected function resetTable(){
        global $db;
        $query = "TRUNCATE table fields";
        $this->result = $db->query($query);
    }
    protected function validate($value){
        if(ctype_digit($value))
            return intval($value);
        else return false;
    }
    public function displayResults(){
        global $db;
        //display information:
        if(isset($this->result) && $this->result){
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
    }
}

$data = new Dndform();