<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Kategorie</h2>
                        <a href="./index.php?subpage=admin&edit=categories&action=add" class="btn btn-success pull-right">Dodaj kategorię</a>
                    </div>
                    <?php
                    require_once "config.php";
                    mysqli_query($db, "SET NAMES utf8");
                    $sql = "SELECT * FROM categories";
                    if($result = mysqli_query($db, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nazwa</th>";
                                        echo "<th>Akcje</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                       echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='./index.php?subpage=admin&edit=categories&action=edit&id=". $row['id'] ."' title='Edytuj kategorię' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='./index.php?subpage=admin&edit=categories&action=del&id=". $row['id'] ."' title='Usuń kategorię' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Brak kategorii produktów.</em></p>";
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