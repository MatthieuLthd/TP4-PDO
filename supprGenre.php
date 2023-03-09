<?php include "header.php";
include "connexionPdo.php";
$num = $_GET['num'];

$req=$monPdo->prepare("DELETE FROM genre where num = :num");
$req->bindParam(':num', $num);
$nb = $req->execute();

echo '<div class="container mt-5">';
echo '<div class="row">
    <div class="col mt-5">';
if($nb == 1) {
    $_SESSION['message']=["warning"=>"Le genre a bien été supprimé"];
}else{
    $_SESSION['message']=["success"=>"Problème : Le genre n'a pas été supprimé !"];
}
header('location: listeGenres.php');
exit();

?>