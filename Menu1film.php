<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Menu Film</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='decor.css'> <style>
    
    img.profile-icon {
            position: fixed;
            top: 10px;
            left: 10px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .input {
            background-color: #E50914;
            color: #FFFFFF;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .mo {
            position: fixed;
        }

        .logout-form {
            text-align: right;
            margin-right: auto;
        }

        .center-container {
            text-align: center;
        }

        .marquee-container {
            display: inline-block;
        }

        .marquee-text {
            white-space: nowrap;
        }
        </style>
</head>
<body>
    <?php
    session_start();
$serveur="localhost";
$utilisateur="root";
$Mot="";
$base="projet";
$lo=mysqli_connect($serveur,$utilisateur,$Mot,$base);
$nume=$_GET['nom'];
$requet = "SELECT Nom_client FROM client where Num_tel_client=$nume";
    $resu=mysqli_query($lo,$requet);
    while ($ligne = mysqli_fetch_row($resu)) {
        echo "<br><br><br><br><br><br><p class='mo'>Nom:$ligne[0]</p>";}
    echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'class='logout-form'>
    <h2><input type='submit' name='deconnexion' value='Déconnexion' class='bouton'></h2>
  </form>";
  if (isset($_POST['deconnexion'])) {
    // Détruire la session si le bouton de déconnexion est soumis
    session_destroy();

    // Rediriger vers la page de connexion
    header('Location: connecter.php');
    exit();
}
if (isset($_SESSION['nom'])) {
    echo "<img class='profile-icon' src='image/contact.jpg' alt='Photo Profile'> <br><br>";
}
$o=$_POST["numer"];
$requet="SELECT * FROM film WHERE Num_Film=$o";
$resultat = mysqli_query($lo,$requet);

while($ligne=mysqli_fetch_row($resultat)){
echo"
<div class='film-container'>
<center>
<table border=0 cellspacing=0 cellpading=4><tr>
<img src='image/$ligne[1]'alt='Affiche du Film' id='image' width=30% height=50%></tr>  
<tr><td><h2>Titre</h2></td> <td><h2>$ligne[2]</h2></td></tr>
<tr><td>Realisateur</td> <td>$ligne[3]</td></tr>
<tr><td>Scenario</td> <td>$ligne[4]</td></tr>
<tr><td>Musique</td> <td>$ligne[5]</td></tr>
<tr><td>Societe</td> <td>$ligne[6]</td></tr>
<tr><td>Production</td> <td>$ligne[7]</td></tr>
<tr><td>Sortie</td> <td>$ligne[8]</td></tr>";
$requeteg = "SELECT *FROM genre where num_genre=$ligne[9]"; 
$resultatg = mysqli_query($lo,$requeteg);
while($li = mysqli_fetch_row($resultatg)){
    echo "<tr><td>Genre: </td> <td>$li[1]</td></tr>";
}
echo"<tr><td><p>Ticket:</p></td> <td>$ligne[10]</td></tr>
<tr><td><p>Date Projection:</p></td> <td>$ligne[11]</td></tr>  
<td colspan=2 align='center'><center>
<form action='payement.php?num=$nume' method='post'>
<input type='hidden' name='num' value='$ligne[0]'>
<tr><td><p>Nombre de places:</p></td> <td><input type='number' name='nbr' required='required' value='0'></td></tr>
<input type='hidden' name='nume' value='$nume'>
<input type='hidden' name='ticket' value='$ligne[10]'>
<input type='hidden' name='date_projection' value='$ligne[11]'>
<tr><td><button type='submit' class='bouton'>Acheter un Ticket</button></td></tr>
</form>
</center> </table> </center></div> 
   
   ";
}
mysqli_close($lo);
?> 
</body>
</html>