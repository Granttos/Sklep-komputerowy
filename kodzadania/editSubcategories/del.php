<?php

if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "config.php";
    
   
    $sql = "DELETE FROM subcategories WHERE id = ?";
    
    if($stmt = mysqli_prepare($db, $sql)){
       mysqli_stmt_bind_param($stmt, "i", $param_id);
     $param_id = trim($_POST["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
           header("location: ./index.php?subpage=admin&edit=subcategories");
            exit();
        } else{
            echo "Wystąpił problem. Spróbuj ponownie później.";
        }
    }
     
   
    mysqli_stmt_close($stmt);
    
   
    mysqli_close($db);
} else{
   if(empty(trim($_GET["id"]))){
        echo("Błąd podczas usuwania");
        exit();
    }
}
?>

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Usuń podkategorię</h1>
                    </div>
                    <form action="./index.php?subpage=admin&edit=subcategories&action=del" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Czy na pewno chcesz usunąć podkategorię?</p><br>
                            <p>
                                <input type="submit" value="Tak" class="btn btn-danger">
                                <a href="./index.php?subpage=admin&edit=subcategories" class="btn btn-default">Nie</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>