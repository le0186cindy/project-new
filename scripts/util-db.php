<?php
    require_once("db-info.php");

    function getData($sql) {
        global $conn;
        $result = $conn -> query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    function executeQuery($sql) {
        global $conn;
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
?>