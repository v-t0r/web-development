<?php

function mysqlConnect()
{
    
    $servername = "sql310.infinityfree.com";
    $username = "if0_34738851";
    $password = "enDiYunHBZO";
    $database = "if0_34738851_database";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
        
        return $conn;
    } catch(PDOException $e) {    
        echo "Connection failed: " . $e->getMessage();
    }

}

?>
