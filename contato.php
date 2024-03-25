<?php 
include("conectadb.php");

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['phone'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO depoimento (depo_nome, depo_email, depo_telefone, depo_mensagem, depo_respondido)
    VALUES ('$nome', '$email','$telefone','$mensagem', 'nao')";
    mysqli_query($link, $sql);
    echo "<script>window.alert('Obrigado por nos contatar! ');</script>";
    echo "<script>window.location.href='muybella.html';</script>";
}
?>