<?php
require_once '../config/dataBase.php';
require_once '../classes/Jeu.php';
$db = new Database();
$connex = $db->getConnection();
session_start();
$jeu = new Jeu();
$allgames = $jeu->getAllJeux($connex);