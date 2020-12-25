<?php
class imtp
{
    private $conn;
    public $alert = '';
    public function __construct(){
        try {
            $connection = new PDO ("mysql:host=".constant("dbServer").";dbname=".constant("dbName"),constant("dbUser"),constant("dbPassword"));
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $connection;
        }catch (Exception $e) {
            $this->alert = "Database connection error!";
        }
    }
    public function getTables() {
        if($this->conn) {
            $tables = $this->conn->prepare("SHOW TABLES");
            $tables->execute();
            $result = $tables->fetchall(PDO::FETCH_NUM);
            echo "<select name='db_table' onchange='setTable(this);'>";
            if (count($result)) {
                echo "<option value='0'>Select Table...</option>";
                foreach ($result as $k => $v)
                    echo "<option value='" . $v[0] . "'>" . $v[0] . "</option>";
            } else echo "<option value='0'>No Table Exists!</option>";
            echo "</select>";
        }
    }
    public function getColumns($table) {
        if($this->conn) {
            $columns = $this->conn->prepare("SHOW COLUMNS FROM $table;");
            $columns->execute();
            $result = $columns->fetchall(PDO::FETCH_NUM);
            if (count($result)) {
                foreach ($result as $k => $v)
                    echo "<span class='column-content'><input type='checkbox' name='db_column' value='" . $v[0] . "'>" . $v[0] . "</span>";
            } else echo "The selected table has no columns!";
        }
    }
    public function import($table,$cols,$excel){
        if($excel['type']=='application/vnd.ms-excel') {
            $csv = fopen($excel['tmp_name'],'r');
            $file = file($excel['tmp_name']);
            $countRows = count($file);
            $result = false;
            for($i = 0; $i < $countRows; $i++) {
                $row = fgetcsv($csv);
                $result =  $this->insertToDb($table,$cols,$row);
            }
            return $result;
        }
    }
    public function insertToDb($table,$cols,$array) {
        if(count($array)) {
            $this->conn->beginTransaction();
            if(count($cols)) {
                $i = 0;
                $queryColumn = " INSERT INTO $table (";
                $queryValues = " VALUES (";
                foreach($cols as $col) {
                    $queryColumn .= "`$col`,";
                    $queryValues .= "'$array[$i]',";
                    $i++;
                }
                $queryColumn = trim($queryColumn,",");
                $queryValues = trim($queryValues,",");
                $queryColumn .= ") ";
                $queryValues .= ")";
                $queryColumn .= $queryValues;
                $this->conn->exec($queryColumn);
            }
            if($this->conn->commit()) return true;
            else {
                $this->conn->rollBack();
                return false;
            }
        }
    }
}