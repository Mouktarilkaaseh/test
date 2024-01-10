<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>momo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='decor.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php
$serveur="localhost";
$utilisateur="root";
$Mot="";
$base="projet";
$lo=mysqli_connect($serveur,$utilisateur,$Mot,$base);
$numclient=$_GET['num'];
$numfilm = $_POST['num'];
$tickets = $_POST['ticket'];
$date = $_POST['date_projection'];
$nbrplace = $_POST['nbr'];
$requeteg = "SELECT Num_client,Num_payement,Nom_client FROM client where Num_tel_client=$numclient"; 
$resultatg = mysqli_query($lo,$requeteg);
while($li = mysqli_fetch_row($resultatg)){
    $numero=$li[0];
    $num=$li[1];
    $nome=$li[2];

}
    $t="INSERT INTO `verification`(`Date_Projection`, `Nombre_place`, `Ticket`, `Num_film`, `Num_client`) 
    VALUES('$date','$nbrplace','$tickets','$numfilm','$numero')";
    $ajouter=mysqli_query($lo,$t);
    $requeteg = "SELECT Nom_payement,code FROM payement where Num_payement=$num"; 
    $resultatg = mysqli_query($lo,$requeteg);
    while($li = mysqli_fetch_row($resultatg)){
        $nom=$li[0];
        $code=$li[1];
    if($ajouter){

        echo " <div class='film-container'> <center><table border=0 cellspacing=0 cellpading=4>
        <tr><td><center><p><h2>parfait!!! $nome </h2></p></center></td></tr>
        <tr><td><center>Veuillez payer sur $nom avec notre compte marchandise $code<center></td></tr>
        </table></center>";
    }
    else{
        echo " erreur d'ajout".mysqli_error($lo);
    }
    }
mysqli_close($lo);
?> 
</body>
</html>