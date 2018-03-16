<?php

//database details
$servername = "SERVER NAME";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DATABASE NAME";

//primary key identifier
$key = 'id';

//create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//get variables
$type = $_GET['type']; //TYPE: select, insert, update, deleteid, selectid, truncate
$table = $_GET['table']; //TABLE: name
$values = $_GET['values']; //VALUES: value1,value2, ... valuen
$columns = $_GET['columns']; //COLUMN: column1,column2, ... columnn
$id = $_GET['id']; //ID: n
$limit = $_GET['limit']; //LIMIT: 0
$offset = $_GET['offset']; //OFFSET: 0

//helper functions
function createString($str){
    $arr = explode(",", $str);
    $rstr = "";
    for($i = 0; $i < count($arr); $i++){
        $rstr .= "'" . $arr[$i] . "',";
    }
    return substr($rstr, 0, -1);
}

//create query
//TODO: Add limits and offset
if ($type == 'select'){
    $sql = "SELECT " . $columns . " FROM " . $table . "";
}elseif ($type == 'selectid'){
    $sql = "SELECT * FROM " . $table . " WHERE " . $key . "=" . $id;
}elseif ($type == 'insert'){
    $values = createString($values);
    $sql = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")"; 
}elseif ($type == 'update'){
    $assign = "";
    $cols = explode(",", $columns);
    $vals = explode(",", $values);
    for($i = 0; $i < count($cols); $i++){

        if ($i == (count($cols) - 1)){
            $assign .= $cols[$i] . "=\"" . $vals[$i] . "\"";
        }else{
            $assign .= $cols[$i] . "=\"" . $vals[$i] . "\",";
        }
        
    }
    $sql = "UPDATE " . $table . " SET ". $assign . " WHERE " . $key . "=" . $id;
}elseif ($type == 'deleteid'){
    $sql = "DELETE FROM " . $table . " WHERE " . $key . "=" . $id;
}elseif ($type == 'truncate'){
    $sql = "TRUNCATE TABLE " . $table;
}

//PROCESS

mysqli_set_charset($conn, 'utf8');

//---return data
if ($type == 'select' || $type == 'selectid'){

    //run query
    $result = mysqli_query($conn, $sql);
  
    //create array and add data
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }

  //output json
  echo(json_encode($rows));
}

//---send data
if ($type == 'insert' || $type == 'deleteid' || $type == 'truncate' || $type == 'update'){
    mysqli_query($conn, $sql);
  echo($sql);
}

//close connection
mysqli_close($conn);

?>
