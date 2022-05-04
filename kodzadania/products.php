<!-- Tworzenie strony z produktami na podstawie bazy danych i wybranej kategorii/podkategorii -->

<?php
    include("config.php");
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if (!ctype_digit($category)) {
            echo("<center><label><font color=\"red\">NIEPRAWIDŁOWA KATEGORIA!</font></label></center>");
            mysqli_close($db);
            exit();
        }
        mysqli_query($db, "SET NAMES utf8");
        if (isset($_GET['subcategory'])) {
            $subcategory = $_GET['subcategory'];
            if (!ctype_digit($subcategory)) {
                echo("<center><label><font color=\"red\">NIEPRAWIDŁOWA KATEGORIA!</font></label></center>");
                mysqli_close($db);
                exit();
            }
           
            $sql = "SELECT * FROM products WHERE category = '" . $category . "' && subcategory = '" . $subcategory . "'";
        }
        else {
            $sql = "SELECT * FROM products WHERE category = '" . $category . "' && subcategory IS NULL";
        }
        if ($result = mysqli_query($db, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                while (($product = @mysqli_fetch_array($result))) {
                    echo '<center><p><b>' . $product['title'] . '</b></br> ' . '<a class="center_div" href="'.$product['img'].'" data-lightbox="example-1"><img width="50%" height="50%" class="example-image" src="'.$product['img'].'" alt="image-1" /></a></br><p align="justify" class="description" style="white-space:pre-wrap; word-wrap:break-word">' . $product['description'] . '</p></p></center></br></br>' . PHP_EOL;
                }
            }
            else {
                echo "<center><p class='lead'><em>Brak produktów.</em></p></center>";
            }
        }
        else {
            echo("<center><label><font color=\"red\">Błąd połączenia z bazą danych.</font></label></center>");
        }
        mysqli_close($db);
    }
    else {
        echo("<center><label><font color=\"red\">Brak kategorii produktów</font></label></center>");
    }
?>

<script src="src/js/lightbox.js"></script>