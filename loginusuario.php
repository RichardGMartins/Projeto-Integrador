<?php 
session_start();// Iniciar Sessão

include("conectadb.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nome = $_POST['login'];
    $senha = $_POST['senha'];

    // Buscar o tempero
    $sql = "SELECT usu_tempero FROM usuarios WHERE usu_login = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nome);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $tempero);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Calcular o hash da senha com o tempero
    $senha = md5($senha . $tempero);

    // Verificar se as credenciais são válidas
    $sql = "SELECT usu_id, usu_login FROM usuarios WHERE usu_login = ? AND usu_senha = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $nome, $senha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nomeUsuario);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if($id !== null){
        // Definir variáveis de sessão
        $_SESSION['idusuario'] = $id;
        $_SESSION['nomeusuario'] = $nomeUsuario;

        echo "<script>window.location.href='areaadmin.php';</script>";
    } else {
        echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
        echo "<script>window.location.href='muybella cadastrousuario.html';</script>";
    } 
}
?>
