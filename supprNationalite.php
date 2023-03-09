<?php include "header.php";
include "connexionPdo.php";
$num = $_GET['num'];

$req=$monPdo->prepare("DELETE FROM nationalite where num = :num");
$req->bindParam(':num', $num);
$nb = $req->execute();

echo '<div class="container mt-5">';
echo '<div class="row">
    <div class="col mt-5">';
if($nb == 1) {
    $_SESSION['message']=["warning"=>"La nationalité a bien été supprimée"];
}else{
    $_SESSION['message']=["success"=>"Problème : La nationalité n'a pas été supprimée !"];
}
header('location: listeNationalites.php');
exit();

?>