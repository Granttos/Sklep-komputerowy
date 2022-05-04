<!-- Panel administracyjny po zalogowaniu -->

<div align="center">
    <form method="post" action="./index.php?subpage=admin&edit=categories">
    <input type="submit" value="Edytuj kategorie"/><br/></form>
    <br>
    <form method="post" action="./index.php?subpage=admin&edit=subcategories">
    <input type="submit" value="Edytuj podkategorie"/><br/></form>
    <br>
    <form method="post" action="./index.php?subpage=admin&edit=products">
    <input type="submit" value="Edytuj produkty"/><br/></form>
    <br>
    <form method="post" action="./index.php?subpage=admin&edit=admins">
    <input type="submit" value="Edytuj administratorów"/><br/></form>
    <br><br>
    <p class="rozne">Aby wylogować naciśnij poniższy przycisk:<br/>
    <form method="post" action="logout.php">
    <input type="submit" value="Wyloguj"/><br/></form><p>
</div>