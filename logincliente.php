<?php 
session_start();//Iniciar Sessão

include("conectadb.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    #Busca o tempero

    $sql = "SELECT cli_tempero FROM cliente WHERE cli_email = '$email'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $tempero = $tbl[0];
    }
    $senha = md5($senha. $tempero);
    $sql = "SELECT COUNT(cli_id) FROM cliente WHERE cli_email = '$email' AND cli_senha = '$senha'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    if($cont == 1){
    $sql = "SELECT * FROM cliente WHERE cli_email = '$email' AND cli_senha = '$senha' AND cli_ativo='s'";
    $retorno = mysqli_query($link,$sql);
    while ($tbl = mysqli_fetch_array($retorno)){
        $_SESSION['idcliente'] = $tbl[0]; //tbl é a coluna dentro do banco de dados
        $_SESSION['nomecliente'] = $tbl[1];
        echo "<script>window.location.href='areacliente.php';</script>";
    } 
 }   
   else {
        echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
        echo "<script>window.location.href='muybella cadastro.html';</script>";
} 
}
?>
