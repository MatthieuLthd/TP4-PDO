<?php
$hostnom = 'host=btssio.dedyn.io';
$usernom = 'LEAUTHA';
$password = '16/12/2004';
$bdd = 'LEAUTHA_Biblio';

try {
    $monPdo = new PDO("mysql:$hostnom;dbname=$bdd;charset=utf8", $usernom, $password);
    $monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    $monPdo = null;
}
?>