<?php 
include('cabecalhocliente.php');

$id = $_GET['var1'];
$quantidade = $_GET['var2'];

$sql = "UPDATE item_carrinho SET car_item_quantidade = $quantidade WHERE fk_prod_id = $id";

$resultado = mysqli_query($link,$sql);

header("Location:carrinho.php?id=$idclientes");
?>