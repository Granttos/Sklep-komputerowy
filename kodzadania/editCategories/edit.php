<?php

require_once "config.php";
mysqli_query($db, "SET NAMES utf8");
 

$name = "";
$name_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Podaj nazwę kategorii.";
    } else{
        $name = $input_name;
    }
    
    if(empty($name_err)){
       $sql = "UPDATE categories SET name=? WHERE id=?";
         if($stmt = mysqli_prepare($db, $sql)){
            
            mysqli_stmt_bind_param($stmt, "si", $param_name, $param_id);
            $param_name = $name;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
               header("location: ./index.php?subpage=admin&edit=categories");
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
        $sql = "SELECT * FROM categories WHERE id = ?";
        if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                   
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                $name = $row["name"];
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
                    <p>Uzupełnij formularz w celu edycji kategorii.</p>
                    <form action="./index.php?subpage=admin&edit=categories&action=edit" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa kategorii</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Wyślij">
                        <a href="./index.php?subpage=admin&edit=categories" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>