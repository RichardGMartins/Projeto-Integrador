<?php 
include("cabecalho.php");

$sql = "SELECT * FROM depoimento WHERE depo_respondido = 'sim'";
$retorno = mysqli_query($link, $sql);
$ativo = "sim";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ativo = $_POST['respondido'];
    if ($ativo == 'sim') {
        $sql = "SELECT * FROM depoimento WHERE depo_respondido = 'sim'";
        $retorno = mysqli_query($link, $sql); 
    }
    else if ($ativo == 't') {
        $sql = "SELECT * FROM depoimento ORDER BY depo_id";
        $retorno = mysqli_query($link,$sql);
    }
    else {
        $sql = "SELECT * FROM depoimento WHERE depo_respondido = 'nao'";
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
        <title>Lista Depoimentos</title>
    </head>
    <body>
        <div id="background">
            <form action="listadepoimentos.php" method="post">
                <!-- Required é usado para o usuario tentar passar em branco o cadastro e impedir o mesmo -->
                <input type="radio" name ="respondido" class="radio" value="sim" required onclick="submit()" <?= $ativo == 'sim' ? "checked" : "" ?>> RESPONDIDOS 
                <br>
                <input type="radio" name ="respondido" class="radio" value="nao" required onclick="submit()" <?= $ativo == 'nao' ? "checked" : "" ?>> NÃO RESPONDIDOS
                <br>  
                <input type="radio" name ="respondido" class="radio" value="t" required onclick="submit()" <?= $ativo == 't' ? "checked" : "" ?>> TODOS
                <br>  
            </form>
            </div>
            <div class="container" id="center-container" >
                <table border="1">
                    <tr>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>TELEFONE</th>
                        <th>MENSAGEM</th>
                        <th>ALTERAR</th>
                        <th>RESPONDIDO</th>
                    </tr>
                    <?php
                    while ($tbl = mysqli_fetch_array($retorno)) {
                        #Mais aqui eu fecho para trabalhar com HTML SIMULTANEAMENTE

                    ?>
                        <tr>
                            <td><?= $tbl[1] ?></td> 
                            <td><?= $tbl[2] ?></td> 
                            <td><?= $tbl[3] ?></td> 
                            <td><?= $tbl[4] ?></td> 
                            <td><a href="alterardepoimento.php?id=<?= $tbl[0] ?>"><input type="button" value ="ALTERAR DADOS"></a></td>
                            <td><?= $check = ($tbl[5] == "sim") ? "SIM" : "NÃO" ?></td> 
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
    </body>
</html>