<!-- Panel administracyjny po zalogowaniu -->
<?php
    switch ($_GET["edit"]) {
        case 'categories':
            include("./editCategories/mainPage.php");
            break;
        case 'subcategories':
            include("./editSubcategories/mainPage.php");
            break;
        case 'products':
            include("./editProducts/mainPage.php");
            break;
        case 'admins':
            include("./editAdmins/mainPage.php");
            break;
        default:
            include("mainAdminPanel.php");
            break;
    }
?>