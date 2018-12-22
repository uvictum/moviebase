<?php
class Setup
{
   private $pdo;

    /**
     * Setup constructor.
     * try to establish connection to the db
     */
    public function __construct()
    {
        require(ROOT.'/config/database.php');
        try {
            $this->pdo = new PDO($DB_INSTALL, $DB_USER, $DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $err) {
            echo "Connection failed :" . $err->getMessage();
        }
    }

    /**
     *If the DB was not found on sql server this method would create it
     * and also set table for application
     */
    public function SetupDB()
    {
        include(ROOT . '/config/database.php');
        $this->pdo->query('CREATE DATABASE ' . $DB_NAME);
        $pdqry = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $qry = file_get_contents(ROOT.'/sqls/setupdb.sql');
        $pdqry->query($qry);
        $res = ConnectDatabase::ConnectDB();
        if ($res) {
            echo 'database created successfully!<br>';
        }
        else {
            echo 'something go wrong</br>';
        }
       header("Refresh:2");
    }
}