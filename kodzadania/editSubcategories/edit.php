<?php

require_once "config.php";
mysqli_query($db, "SET NAMES utf8");
$sql_categories = 'SELECT `id`, `name`
            FROM `categories`
            ORDER BY `name`';
$wynik = mysqli_query($db, $sql_categories);
$name = $category_id = "";
$name_err = $category_id_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
   
    $id = $_POST["id"];
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Podaj nazwę podkategorii.";
    } else{
        $name = $input_name;
    }

   
    $input_category_id = trim($_POST["category_id"]);
    if(empty($input_category_id)){
        $category_id_err = "Niepawidłowa kategoria (parametr wymagany).";     
    } elseif(!ctype_digit($input_category_id)){
        $category_id_err = "Niepawidłowa kategoria (parametr wymagany).";
    } else{
        $category_id = $input_category_id;
    }
    
    
    if(empty($name_err)){
        
        $sql = "UPDATE subcategories SET name=?, category=? WHERE id=?";
         if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "sii", $param_name, $param_category_id, $param_id);
            
            $param_name = $name;
            $param_id = $id;
            $param_category_id = $category_id;
            
           
            if(mysqli_stmt_execute($stmt)){
                header("location: ./index.php?subpage=admin&edit=subcategories");
                exit();
            } else{
                echo "Wystąpił błąd. Spróbuj ponownie później.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($db);
} else{
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
       
        $id =  trim($_GET["id"]);
        
       $sql = "SELECT * FROM subcategories WHERE id = ?";
        if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                   $name = $row["name"];
                    $readed_category_id = $row["category"];
                } else{
                    echo("Wystąpił błąd.");
                    exit();
                }
                
            } else{
                echo "Wystąpił błąd. Spróbuj ponownie później.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($db);
    }  else{
       echo("Wystąpił błąd.");
        exit();
    }
}
?>

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Edytuj podkategorię</h2>
                    </div>
                    <p>Uzupełnij formularz w celu edycji podkategorii.</p>
                    <form action="./index.php?subpage=admin&edit=subcategories&action=edit" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa podkategorii</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($category_id_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa kategorii</label></br>
                            <select name="category_id">
                                <?php 
                                    while ($kategoria = @mysqli_fetch_array($wynik)) {
                                        $category = $kategoria['name'];
                                        $category_id = $kategoria['id'];
                                        if ($readed_category_id == $category_id) {
                                            echo("<option value=\"$category_id\" selected>$category</option>");
                                        }
                                        else {
                                            echo("<option value=\"$category_id\">$category</option>");
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Wyślij">
                        <a href="./index.php?subpage=admin&edit=subcategories" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>