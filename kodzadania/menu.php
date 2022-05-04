<!-- Menu strony -->

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Sklep komputerowy</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="./index.php">Strona główna</a></li>
        <li>
          <a data-toggle="dropdown" style="background-color:grey;">Produkty</span></a>
          <ul class="dropdown-menu" style="background-color:grey;">
			      <?php include 'categories.php';  ?>
          </ul>
        </li>
        <li><a href="./index.php?subpage=contact">Kontakt</a></li>
        <li><a href="./index.php?subpage=admin">Panel administracyjny</a></li>
      </ul>
    </div>
  </div>
</nav>