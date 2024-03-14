<?php 
#Inicia a conexão com o banco de dados
session_start();
include("conectadb.php");
#Coleta de variáveis via formulário de HTML
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $genero = $_POST['genero'];
    $datanascimento = $_POST['datanascimento'];

    #Trim é usado para tirar os espaços do começo e do fim do nome para armazenar sem spacebar
    $nome = trim($nome);
    $senha = trim($senha);
    $email = trim($email);
    $telefone = trim($telefone);
    $cpf = trim($cpf);
    $genero = trim($genero);
    $datanascimento = trim($datanascimento);
    #POSSANDO INSTRUÇÕES SQL PARA O BANCO
    #VALIDANDO SE USUARIO EXISTE
    #preg_match é usado para o usuario colocar somente os caracteres a baixo sem o spacebar
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()-_+=]*$/', $senha)) {
        echo ("<script>window.alert('Por favor informe que contém caracteres especiais permitidos');</script>");
        echo ("<script>window.location.href='cadastrocliente.php';</script>"); 
    }
    else {
        $sql = "SELECT COUNT(cli_id) FROM cliente WHERE cli_nome = '$nome' AND cli_senha = '$senha' AND cli_email = '$email'AND cli_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno))
        {
            $cont = $tbl[0];
        }
        #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
        if ($cont == 1)
        {
            echo "<script>window.alert('USUARIO JÁ CADASTRADO!, FAÇA O LOGIN';</script>)";
        }
        else
        {
            $tempero = md5(rand(). date('H:i:s'));
            $senha = md5($senha. $tempero);

            $sql = "INSERT INTO cliente (cli_nome,cli_email,cli_telefone,cli_cpf,cli_ativo, cli_senha,cli_tempero,cli_genero,cli_datanascimento)
            VALUES ('$nome', '$email','$telefone','$cpf', 's', '$senha', '$tempero','$genero','$datanascimento')";
            mysqli_query($link, $sql);
            echo "<script>window.alert('Bem Vindo! Ao Melhor Site de Compras de Roupas!');</script>";
            echo "<script>window.location.href='areacliente.php';</script>";
           
           
            $sql = "SELECT * FROM cliente WHERE cli_email = '$email' AND cli_senha = '$senha' AND cli_ativo='s'";
            $retorno = mysqli_query($link,$sql);
            while ($tbl = mysqli_fetch_array($retorno)){
                $_SESSION['idcliente'] = $tbl[0]; //tbl é a coluna dentro do banco de dados
                $_SESSION['nomecliente'] = $tbl[1];
            } 
        }
    }
}
?>


