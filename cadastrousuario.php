<?php 
#Inicia a conexão com o banco de dados

include("cabecalho.php");
#Coleta de variáveis via formulário de HTML
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    #Trim é usado para tirar os espaços do começo e do fim do nome para armazenar sem espaço
    $login = trim($login);
    #POSSANDO INSTRUÇÕES SQL PARA O BANCO
    #VALIDANDO SE USUARIO EXISTE
    #preg_match é usado para o usuário colocar somente os caracteres abaixo sem espaço
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()-_+=]*$/', $senha)) {
        echo ("<script>window.alert('Por favor informe que contém caracteres especiais permitidos');</script>");
        echo ("<script>window.location.href='cadastrousuario.php';</script>"); 
    }
    else {
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_login = ? AND usu_senha = ? AND usu_status = 's'";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $login, $senha);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cont);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        
        #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
        if ($cont == 1)
        {
            echo "<script>window.alert('USUARIO JÁ CADASTRADO!');</script>";
        }
        else
        {
            $tempero = md5(rand(). date('H:i:s'));
            $senha = md5($senha. $tempero);

            $sql = "INSERT INTO usuarios (usu_login, usu_senha,usu_status,usu_tempero)
            VALUES (?, ?, 's', ?)";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $login, $senha, $tempero);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script>window.alert('USUARIO CADASTRADO');</script>";
            echo "<script>window.location.href='muybella cadastro.html';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" href="./css/styles.css">
        <title>Cadastro Usuário</title>
    </head>
    <body>
        <div class="div-form">
            <form action="cadastrousuario.php" method="post">
                <!-- Required é usado para o usuario tentar passar em branco o cadastro e impedir o mesmo -->
                <h2>Cadastro de Usuario</h2> <!--Para qualquer atualização usar CTRL + F5-->
                <input type="text" name ="login" id="nome" placeholder="Nome de Usuario" required><br>
                <input type="password" name ="senha" id="senha" placeholder="Senha" minlength="8" maxlength="32" required><br>
                <span id="MostrarSenha" onclick="MostrarSenha()">👀</span> <br><br>
                <button type="submit" name ="cadastrar" id="btn" >Cadastrar</button><br>
            </form>
        </div>
    </body>
</html>

<script>
    function MostrarSenha() {
        var passwordInput = document.getElementById("senha");
        var PasswordIcon = document.getElementById("MostrarSenha")
        if(passwordInput.type === "password"){
         passwordInput.type = "text";
         PasswordIcon.textContent = "❌"
        }
        else {
            passwordInput.type = "password";
            PasswordIcon.textContent = "👀";
        }
    }
</script>