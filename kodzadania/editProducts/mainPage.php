<?php
    switch ($_GET['action']) {
        case 'edit':
            include("./editProducts/edit.php");
            break;
        case 'del':
            include("./editProducts/del.php");
            break;
        case 'add':
            include("./editProducts/add.php");
            break;
        default:
            include("./editProducts/show.php");
            break;
    }
?>