<?php
include('config.php');
@mysqli_query($db, 'SET NAMES utf8');

$sql_categories = 'SELECT `id`, `name`
            FROM `categories`
            ORDER BY `name`';
$wynik = mysqli_query($db, $sql_categories);
if (mysqli_num_rows($wynik) > 0) {
    while ($kategoria = @mysqli_fetch_array($wynik)) {
        echo "<ul>" . PHP_EOL;
        $sql_subcategories = "SELECT id, name
                FROM subcategories
                WHERE category=" . $kategoria['id'] . "
                ORDER BY name";
        $wynik2 = mysqli_query($db, $sql_subcategories);
        if (mysqli_num_rows($wynik2) > 0) {
            echo "<li><font color=\"white\">".$kategoria['name']."</font></li>" . PHP_EOL;
            echo "<ul>" . PHP_EOL;
            while ($podkategoria = @mysqli_fetch_array($wynik2)) {
                echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?subpage=products&category=' . $kategoria['id'] . "&subcategory=" . $podkategoria['id'] . '">' . $podkategoria['name'] . '</a></li>' . PHP_EOL;
            }
            echo "</ul>" . PHP_EOL;
        }
        else {
            echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?subpage=products&category=' . $kategoria['id'] . '">' . $kategoria['name'] . '</a></li>' . PHP_EOL;
        }
        echo "</ul>" . PHP_EOL;
    }
} 
else {
    echo 'wyników 0';
}

mysqli_close($db);
?>