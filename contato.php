<?php 
include("conectadb.php");

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['phone'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO depoimento (depo_nome, depo_email, depo_telefone, depo_mensagem, depo_respondido)
    VALUES (?, ?, ?, ?, 'nao')";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $telefone, $mensagem);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    echo "<script>window.alert('Obrigado por nos contatar! ');</script>";
    echo "<script>window.location.href='muybella.html';</script>";
}
?>
