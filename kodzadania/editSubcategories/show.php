<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Podkategorie</h2>
                        <a href="./index.php?subpage=admin&edit=subcategories&action=add" class="btn btn-success pull-right">Dodaj podkategorię</a>
                    </div>
                    <?php
                    
                    require_once "config.php";
                    mysqli_query($db, "SET NAMES utf8");
                   
                    $sql = "SELECT subcategories.id, subcategories.name, categories.name AS category FROM subcategories LEFT JOIN categories ON subcategories.category = categories.id";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nazwa</th>";
                                        echo "<th>Kategoria</th>";
                                        echo "<th>Akcje</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['category'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='./index.php?subpage=admin&edit=subcategories&action=edit&id=". $row['id'] ."' title='Edytuj podkategorię' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='./index.php?subpage=admin&edit=subcategories&action=del&id=". $row['id'] ."' title='Usuń podkategorię' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Brak podkategorii produktów.</em></p>";
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