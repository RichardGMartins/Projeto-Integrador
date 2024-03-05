<?php 
session_start();//Iniciar Sessão

include("conectadb.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nome = $_POST['login'];
    $senha = $_POST['senha'];

    #Busca o tempero

    $sql = "SELECT usu_tempero FROM usuarios WHERE usu_login = '$nome'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $tempero = $tbl[0];
    }
    echo $sql;
    $senha = md5($senha. $tempero);
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_login = '$nome' AND usu_senha = '$senha'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }

    if($cont == 1){
    $sql = "SELECT * FROM usuarios WHERE usu_login = '$nome' AND usu_senha = '$senha' AND usu_status='s'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $_SESSION['idusuario'] = $tbl[0]; //tbl é a coluna dentro do banco de dados
        $_SESSION['nomeusuario'] = $tbl[1];
    }   
        echo "<script>window.location.href='areaadmin.php';</script>";
}   else {
        echo "<script>window.alert('USUARIO OU SENHA INCORRETOS')';</script>";
} 
}
?>
