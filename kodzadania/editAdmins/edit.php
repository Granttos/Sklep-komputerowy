<?php

require_once "config.php";
mysqli_query($db, "SET NAMES utf8");
 

$login = $pass = "";
$login_err = $pass_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
   
    $input_login = trim($_POST["login"]);
    if(empty($input_login)){
        $login_err = "Wprowadź login administratora.";
    }
    elseif (!filter_var($input_login, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z_]+$/")))) {
        $login_err = "Nieprawidłowy login (tylko litery i cyfry).";
    }
    else{
        $login = $input_login;
    }

    
    $input_pass = trim($_POST["pass"]);
    if(empty($input_pass)){
        $pass_err = "Wprowadź hasło administratora.";
    }
    else{
        $pass = $input_pass;
    }
    
    
    if(empty($login_err) && empty($pass_err)){
        
        $sql = "UPDATE admins SET login=?, pass=? WHERE id=?";
         
        if($stmt = mysqli_prepare($db, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssi", $param_login, $param_pass, $param_id);
            
            $param_login = $login;
            $param_pass = md5($pass);
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: ./index.php?subpage=admin&edit=admins");
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
        
       
        $sql = "SELECT * FROM admins WHERE id = ?";
        if($stmt = mysqli_prepare($db, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
          
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $login = $row["login"];
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
                        <h2>Edytuj administratora</h2>
                    </div>
                    <p>Uzupełnij formularz w celu edycji administratora.</p>
                    <form action="./index.php?subpage=admin&edit=admins&action=edit" method="post">
                        <div class="form-group <?php echo (!empty($login_err)) ? 'has-error' : ''; ?>">
                            <label>Login</label>
                            <input type="text" name="login" class="form-control" value="<?php echo $login; ?>">
                            <span class="help-block"><?php echo $login_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>">
                            <label>Hasło</label>
                            <input type="password" name="pass" class="form-control" value="">
                            <span class="help-block"><?php echo $pass_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Wyślij">
                        <a href="./index.php?subpage=admin&edit=admins" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>