<!-- GŁÓWNY SZKIELET STRONY INTERNETOWEJ -->

<?php
    error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <?php include('header.php'); ?>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php
    include("menu.php");
?>

<div class="jumbotron text-center">
    <h1>PCTronic</h1><img src="4.jpg" alt="komp" style="width:10%">
    <p>Najlepsza technologia na wyciągnięcie ręki</p>
</div>

<?php
    switch ($_GET["subpage"]) {
        case 'admin':
            include('config.php');
            session_start();
            $user_check = $_SESSION['login_user'];
            $ses_sql = mysqli_query($db,"select login from admins where login = '$user_check' ");
            $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
            $login_session = $row['login'];
            if(!isset($_SESSION['login_user'])){
                include('login.php');
            }
            else {
                include('adminPanel.php');
            }
            break;
        case 'products':
            include('products.php');
            break;
        case 'contact':
            include('contact.php');
        break;
        default:
            include('home.php');
            break;
    }
?>



<script>
$(document).ready(function(){
   $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    if (this.hash !== "") {
      
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
       
        window.location.hash = hash;
      });
    }
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
