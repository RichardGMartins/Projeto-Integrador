<?php 
include('cabecalhocliente.php');

$id = $_GET['var1'];
$quantidade = $_GET['var2'];

if($quantidade > 0){

$sql = "UPDATE item_carrinho SET car_item_quantidade = $quantidade WHERE fk_prod_id = $id";

$resultado = mysqli_query($link,$sql);
}
else {
    $sql = "UPDATE item_carrinho SET car_item_quantidade = 1 WHERE fk_prod_id = $id";

    $resultado = mysqli_query($link,$sql);
}
header("Location:carrinho.php?id=$idclientes");
?>