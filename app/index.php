<?php
define('ROOT', dirname(__FILE__));
require_once (ROOT.'/components/router.php');
require_once (ROOT.'/components/ConnectDatabase.php');
$connection = new ConnectDatabase();
$PDOConnection = $connection->connectDB();
//if pdo connection failed tries to set up the db
if (!$PDOConnection) {
    echo "Beginning setup....";
    include_once (ROOT.'/config/setup.php');
    $setupObject = new Setup();
    $setupObject->SetupDB();
}
// starts the main controller
else {
    $router = new Router;
    $router->chooseRoute();
}
?>

