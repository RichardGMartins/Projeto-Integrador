<?php 
#Inicia a conexão com o banco de dados

include("cabecalho.php");
#Coleta de variáveis via formulário de HTML
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    #Trim é usado para tirar os espaços do começo e do fim do nome para armazenar sem spacebar
    $login = trim($login);
    #POSSANDO INSTRUÇÕES SQL PARA O BANCO
    #VALIDANDO SE USUARIO EXISTE
    #preg_match é usado para o usuario colocar somente os caracteres a baixo sem o spacebar
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()-_+=]*$/', $senha)) {
        echo ("<script>window.alert('Por favor informe que contém caracteres especiais permitidos');</script>");
        echo ("<script>window.location.href='cadastrousuario.php';</script>"); 
    }
    else {
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_login = '$login' AND usu_senha = '$senha' AND usu_status = 's'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno))
        {
            $cont = $tbl[0];
        }
        #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
        if ($cont == 1)
        {
            echo "<script>window.alert('USUARIO JÁ CADASTRADO!';</script>)";
        }
        else
        {
            $tempero = md5(rand(). date('H:i:s'));
            $senha = md5($senha. $tempero);

            $sql = "INSERT INTO usuarios (usu_login, usu_senha,usu_status,usu_tempero)
            VALUES ('$login', '$senha', 's', '$tempero')";
            echo($sql);
            //ALTER TABLE usuarios
            // ADD usu_tempero VARCHAR(50);
            mysqli_query($link, $sql);
            echo "<script>window.alert('USUARIO CADASTRADO');</script>";
            echo "<script>window.location.href='cadastrousuario.php';</script>";
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