<p>
<?php
// connexion
session_start();
$id=mysqli_connect("localhost","root","","projet") or die("erreur");
// recuperation

$nom = $_POST['Nom_client'];
$pre = $_POST['Prenom_client'];
$adresse = $_POST['Adresse'];
  $telno = $_POST['Num_tel_client'];
$motpas = password_hash($_POST['Motdepasse_client'],PASSWORD_BCRYPT);
$pay = $_POST['genre'];

    $t="INSERT INTO client(Nom_client,Prenom_client,Adresse_Email,
    Num_tel_client,Motdepasse_client,Num_payement) 
    VALUES('$nom','$pre','$adresse','$telno','$motpas','$pay')";
    $ajouter=mysqli_query($id,$t);
    if($ajouter){
        header("location:connecter.php");
    }
    else{
        echo " erreur d'ajout".mysqli_error($id);
    }
    
$id->close();
?>
<form method="POST" action="accueil.html">
    <input type="submit" value="ALLER AU MENU GENERAL">
</form>
</p>
