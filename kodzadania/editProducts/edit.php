<?php

require_once "config.php";
mysqli_query($db, "SET NAMES utf8");
$sql_categories = 'SELECT `id`, `name`
                    FROM `categories`
                    ORDER BY `name`';
$wynik_categories = mysqli_query($db, $sql_categories);
$sql_subcategories = 'SELECT `id`, `name`
                    FROM `subcategories`
                    ORDER BY `name`';
$wynik_subcategories = mysqli_query($db, $sql_subcategories);
$title = $description = $img = $category = $subcategory = "";
$title_err = $description_err = $img_err = $category_err = $subcategory_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
   
    $id = $_POST["id"];
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Wprowadź nazwę produktu.";
    } else{
        $title = $input_title;
    }

   
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Wprowadź opis produktu.";
    } else{
        $description = $input_description;
    }

   
    $input_img = trim($_POST["img"]);
    if(empty($input_img)){
        $img_err = "Wprowadź link do zdjęcia.";
    } else{
        $img = $input_img;
    }

   
    $input_category = trim($_POST["category_id"]);
    if(empty($input_category)){
        $id_err = "Niepawidłowa kategoria (parametr wymagany).";     
    } else{
        $category = $input_category;
    }

   
    $input_subcategory = trim($_POST["subcategory_id"]);
    if(empty($input_subcategory)){
        $subcategory_err = "Niepawidłowa podkategoria (parametr wymagany).";     
    } else{
        $subcategory = $input_subcategory;
    }
    
  
    if(empty($title_err) && empty($description_err) && empty($img_err) && empty($category_err) && empty($subcategory_err)){
        
        $sql = "UPDATE products SET title=?, description=?, img=?, category=?, subcategory=? WHERE id=?";
         
        if($stmt = mysqli_prepare($db, $sql)){
          mysqli_stmt_bind_param($stmt, "sssiii", $param_title, $param_description, $param_img, $param_category, $param_subcategory, $param_id);
            
            $param_id = $id;
            $param_title = $title;
            $param_description = $description;
            $param_img = $img;
            $param_category = $category;
            
            if ($subcategory == -1) {
                $param_subcategory = NULL;
            }
            else {
                $param_subcategory = $subcategory;
            }
            
           
            if(mysqli_stmt_execute($stmt)){
               header("location: ./index.php?subpage=admin&edit=products");
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
        $sql = "SELECT * FROM products WHERE id = ?";
        if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $title = $row["title"];
                    $description = $row["description"];
                    $img = $row["img"];
                    $readed_category_id = $row["category"];
                    $readed_subcategory_id = $row["subcategory"];

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
                        <h2>Edytuj kategorię</h2>
                    </div>
                    <p>Uzupełnij formularz w celu edycji produktu.</p>
                    <form action="./index.php?subpage=admin&edit=products&action=edit" method="post">
                    <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa produktu</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>Opis produktu</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
                            <label>Link do zdjęcia produktu</label>
                            <input type="text" name="img" class="form-control" value="<?php echo $img; ?>">
                            <span class="help-block"><?php echo $img_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($category_id_err)) ? 'has-error' : ''; ?>">
                            <label>Kategoria</label></br>
                            <select name="category_id">
                                <?php 
                                    while ($kategoria = @mysqli_fetch_array($wynik_categories)) {
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
                        <div class="form-group <?php echo (!empty($subcategory_id_err)) ? 'has-error' : ''; ?>">
                            <label>Podkategoria</label></br>
                            <select name="subcategory_id">
                                <?php
                                    if ($readed_subcategory_id == NULL) {
                                        echo("<option value=\"-1\" selected>----</option>");
                                    }
                                    else {
                                        echo("<option value=\"-1\">----</option>");
                                    }
                                    while ($podkategoria = @mysqli_fetch_array($wynik_subcategories)) {
                                        $subcategory = $podkategoria['name'];
                                        $subcategory_id = $podkategoria['id'];
                                        if ($readed_subcategory_id == $subcategory_id) {
                                            echo("<option value=\"$subcategory_id\" selected>$subcategory</option>");
                                        }
                                        else {
                                            echo("<option value=\"$subcategory_id\">$subcategory</option>");
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Wyślij">
                        <a href="./index.php?subpage=admin&edit=products" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>