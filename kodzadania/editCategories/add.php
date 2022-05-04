<?php

require_once "config.php";
mysqli_query($db, "SET NAMES utf8");
 

$name = "";
$name_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Wprowadź nazwę kategorii.";
    } else{
        $name = $input_name;
    }
    
    if(empty($name_err)){
        $sql = "INSERT INTO categories (name) VALUES (?)";
         if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
           $param_name = $name;
            
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
}
?>

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Utwórz rekord</h2>
                    </div>
                    <p>Uzupełnij formularz w celu dodania kategorii.</p>
                    <form action="./index.php?subpage=admin&edit=categories&action=add" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa kategorii</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <input formmethod="post" type="submit" class="btn btn-primary" value="Dodaj">
                        <a href="./index.php?subpage=admin&edit=categories" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>