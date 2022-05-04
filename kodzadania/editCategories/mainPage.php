<?php
    switch ($_GET['action']) {
        case 'edit':
            include("./editCategories/edit.php");
            break;
        case 'del':
            include("./editCategories/del.php");
            break;
        case 'add':
            include("./editCategories/add.php");
            break;
        default:
            include("./editCategories/show.php");
            break;
    }
?>