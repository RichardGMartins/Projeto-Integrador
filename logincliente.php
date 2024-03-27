<?php 
session_start();//Iniciar Sessão

include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    # Busca o tempero

    $sql = "SELECT cli_tempero FROM cliente WHERE cli_email = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $tempero);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $senha = md5($senha . $tempero);

    $sql = "SELECT COUNT(cli_id) FROM cliente WHERE cli_email = ? AND cli_senha = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cont);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if($cont == 1) {
        $sql = "SELECT * FROM cliente WHERE cli_email = ? AND cli_senha = ? AND cli_ativo='s'";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $tbl = mysqli_fetch_array($result);
        mysqli_stmt_close($stmt);

        if($tbl) {
            $_SESSION['idcliente'] = $tbl[0]; //tbl é a coluna dentro do banco de dados
            $_SESSION['nomecliente'] = $tbl[1];
            echo "<script>window.location.href='areacliente.php';</script>";
            exit();
        } else {
            echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
            echo "<script>window.location.href='muybella cadastro.html';</script>";
        }
    } else {
        echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
        echo "<script>window.location.href='muybella cadastro.html';</script>";
    }
}
?>

