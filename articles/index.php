<?php
    session_start();
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 0);
    ini_set('error_log', 'Error.log');

    include_once "classes/model.php";
    include_once "classes/view.php";
    include_once "classes/controller.php";

    $Controller = new Controller();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php
            $Controller->action_index();
        ?>
    </body>
</html>