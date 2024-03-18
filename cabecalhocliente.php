<?php 
include ("conectadb.php");
session_start();
//isset é para saber se esta logado
isset($_SESSION['nomecliente'])?$nomecliente = $_SESSION['nomecliente']:"";
$nomecliente = $_SESSION['nomecliente'];
$id = $_SESSION['idcliente'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Pagina Clientes</title>
</head>
<body>
<div class="container" id="findjobs">
     <!--Vamos especificar o tamanho da tela no css-->
     <header><!--1. Banner-->
        <nav><!--Menu superior-->
            <div class="nav-container">
                <a href="muybella.html"><img id="logo" src="./img/LOGO MUY BELLA OP2 S FUNDO.png" alt="JobFinder"></a>
                <ul>
                    <div class="menu-perfil">
                    <li onclick="ativaPerfil()" id="user" class="user"><ul id="nav-perfil" class="nav-perfil"> 
                    <li><a href="loja.php">LOJA</a></li>
                    <li><a href="perfil.php?id=<?=$id?>">PERFIL</a></li>
                    <li><a href="logoutcliente.php">SAIR</a></li>
                    </ul> 
                    </li>
        <?php
        if($nomecliente == null){
        
             echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='muybella cadastro.html';</script>";
        } 
        ?>
        </div>
                </ul>
            </div>
        </nav>  
</header>
</div>
<div>
    <div class="menu">
        <li class="ecomendas"><a href="encomendas.php">ENCOMENDAS</a></li>
    </div>
        <div class="menu-perfil">
        <li onclick="ativaPerfil()" id="user" class="user">PERFIL<ul id="nav-perfil" class="nav-perfil"> 
        <li><a href="perfil.php?id=<?=$id?>">ALTERAR DADOS</a></li>
        <li><a href="logoutcliente.php">SAIR</a></li>
        </ul> 
        </li>
        <?php
        if($nomecliente == null){
        
             echo "<script>window.alert('USUARIO NÃO AUTENTICADO');window.location.href='logincliente.html';</script>";
        } 
        ?>
        </div>     
</div>

</body>
<script src="./script.js"></script>
</html>