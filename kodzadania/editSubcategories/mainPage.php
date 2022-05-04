<?php
    switch ($_GET['action']) {
        case 'edit':
            include("./editSubcategories/edit.php");
            break;
        case 'del':
            include("./editSubcategories/del.php");
            break;
        case 'add':
            include("./editSubcategories/add.php");
            break;
        default:
            include("./editSubcategories/show.php");
            break;
    }
?>