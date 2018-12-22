<?php

class ConnectDatabase
{
    static public function ConnectDB()
    {
        if (file_exists(ROOT.'/config/database.php')) {
            include(ROOT.'/config/database.php');
        }
        try {
            $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return ($pdo);
        }
        catch (PDOException $err) {
            echo "No Database found<br>"; //$err->getMessage();
            return(0);
        }
    }
}