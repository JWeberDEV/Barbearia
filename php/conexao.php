<?php 

$mysqli = new mysqli("localhost","root","","data_barbearia_projeto");

if ($mysqli === false){
  die("ERROR: Não foi Possivel conectar com o Banco de dados." . mysqli_connect_error());
}


?>