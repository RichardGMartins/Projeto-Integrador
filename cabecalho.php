<?php 
include ("conectadb.php");
session_start();
//isset é para saber se esta logado
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']:"";
$nomeusuario = $_SESSION['nomeusuario'];

isset($_SESSION['idusuario'])?$idusuario = $_SESSION['idusuario']:"";
$idusuario = $_SESSION['idusuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muy Bella Store</title>
    <!--Link para chamar o arq styles.css na pasta css-->
    <link rel="stylesheet" href="./css/styles.css">
    <!--Link das fontes-->
   
    <script src="https://kit.fontawesome.com/617f4dcf0c.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" id="findjobs">
     <!--Vamos especificar o tamanho da tela no css-->
     <header><!--1. Banner-->
        <nav><!--Menu superior-->
            <div class="nav-container">
                <a href="muybella.html"><img id="logo" src="./img/LOGO MUY BELLA OP2 S FUNDO.png" alt="JobFinder"></a>
                <ul>
                    <li><a href="cadastroprodutos.php">Cadastro de Produtos</a></li>
                    <li><a href="listaprodutos.php">Lista de Produtos</a></li>
                    <li><a href="listaclientes.php">Lista Clientes</a></li>
                </ul>
            </div>
        </nav>  
</body>
</html>
