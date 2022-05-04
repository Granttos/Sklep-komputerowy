<?php
    switch ($_GET['action']) {
        case 'edit':
            include("./editAdmins/edit.php");
            break;
        case 'del':
            include("./editAdmins/del.php");
            break;
        case 'add':
            include("./editAdmins/add.php");
            break;
        default:
            include("./editAdmins/show.php");
            break;
    }
?>