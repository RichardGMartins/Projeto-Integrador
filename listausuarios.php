<?php 
#Conexão com o banco
include("cabecalho.php");
#PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
$sql = "SELECT * FROM usuarios WHERE usu_status = 's'";
$retorno = mysqli_query($link, $sql);
#FORÇA SEMPRE TRAZER 'S' NA VÁRIAVEL PARA UTILIZARMOS NOS RADIO BUTTON
$ativo = "s";
#COLETA O BOTÃO MÉTODO POST VINDO DO HTML
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ativo = $_POST ['ativo'];
    #VERIFICA SE O USUARIO ESTÁ ATIVO PARA LISTAR, SE 'S' LISTA SENÃO, NÃO LISTA e Puxa todos o usuarios
    if ($ativo == 's') {
        $sql = "SELECT * FROM usuarios WHERE usu_status = 's'";
        $retorno = mysqli_query($link, $sql); 
    }
    else if ($ativo == 't') {
        $sql = "SELECT * FROM usuarios ORDER BY usu_id";
        $retorno = mysqli_query($link,$sql);
    }
    else {
        $sql = "SELECT * FROM usuarios WHERE usu_status = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" href="./css/styles.css">
        <title>Lista Usuarios</title>
    </head>
    <body>
        <div id="background">
            <form action="listausuarios.php" method="post">
                <!-- Required é usado para o usuario tentar passar em branco o cadastro e impedir o mesmo -->
                <input type="radio" name ="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>> ATIVOS 
                <br>
                <input type="radio" name ="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>> INATIVOS 
                <br>  
                <input type="radio" name ="ativo" class="radio" value="t" required onclick="submit()" <?= $ativo == 't' ? "checked" : "" ?>> TODOS
                <br>  
            </form>
            </div>
            <div class="container" id="center-container" >
                <table border="1">
                    <tr>
                        <th>LOGIN</th>
                        <th>ALTERAR DADOS</th>
                        <th>ATIVO</th>
                    </tr>
                    <!--INICIO DE PHP + HTML-->
                    <?php
                    #FAZENDO O PREENCHIMENTO DE TABELA USANDO WHILE (ENQUANTO TEM DADOS RODA PREENCHENDO)
                    while ($tbl = mysqli_fetch_array($retorno)) {
                        #Mais aqui eu fecho para trabalhar com HTML SIMULTANEAMENTE

                    ?>
                        <tr>
                            <td><?= $tbl[1] ?></td> <!--TRAZ SOMENTE A COLUNA 1 [nome] DO BANCO-->
                            <!--AO CLICAR NO BOTÃO ELE JA TRARA O ID DO USUARIO PARA PAGINA DO ALTERAR -->
                            <td><a href="alterausuario.php?id=<?= $tbl[0] ?>"><input type="button" value ="ALTERAR DADOS"></a></td>
                            <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO" ?></td> 
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
    </body>
</html>