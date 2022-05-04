<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Produkty</h2>
                        <a href="./index.php?subpage=admin&edit=products&action=add" class="btn btn-success pull-right">Dodaj produkt</a>
                    </div>
                    <?php
                   
                    require_once "config.php";
                    mysqli_query($db, "SET NAMES utf8");
                   
                    $sql = "SELECT products.id, products.title, products.description, products.img, (SELECT name FROM categories WHERE categories.id = products.category) AS category, (SELECT name FROM subcategories WHERE subcategories.id = products.subcategory) AS subcategory FROM products";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nazwa</th>";
                                        echo "<th>Opis</th>";
                                        echo "<th>Zdjęcie</th>";
                                        echo "<th>Kategoria</th>";
                                        echo "<th>Podkategoria</th>";
                                        echo "<th>Akcje</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['img'] . "</td>";
                                        echo "<td>" . $row['category'] . "</td>";
                                        echo "<td>" . $row['subcategory'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='./index.php?subpage=admin&edit=products&action=edit&id=". $row['id'] ."' title='Edytuj produkt' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='./index.php?subpage=admin&edit=products&action=del&id=". $row['id'] ."' title='Usuń produkt' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Brak produktów.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                    }
 
                    
                    mysqli_close($db);
                    ?>
                </div>
            </div>        
        </div>
    </div>