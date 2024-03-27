<?php 
#Inicia a conexão com o banco de dados

include("cabecalho.php");
#Coleta de variáveis via formulário de HTML
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $custo = $_POST['custo'];
    $valor = $_POST['valor'];
   
    $nome = trim($nome);
    $descricao= trim($descricao);
    $categoria= trim($categoria);
    $marca= trim($marca);
    #POSSANDO INSTRUÇÕES SQL PARA O BANCO
    #VALIDANDO SE USUARIO EXISTE
    #Carregar imagem dos Produtos 
    if(isset ($_FILES['imagem']) && $_FILES['imagem']['error']===UPLOAD_ERR_OK){
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);
        if ($tipo !== false) {
            //o arquivo é uma imagem
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $imagem_base64 = base64_encode($imagem);
        } else {
            //o arquivo não é uma imagem
            $imagem = file_get_contents('C:\xampp\htdocs\projetosti26\Projeto Integrador\img\alert.jpg');
            $imagem_base64 = base64_encode($imagem);
        }
    } else {
        // o arquivo não foi enviado
        $imagem = file_get_contents('C:\xampp\htdocs\projetosti26\Projeto Integrador\img\alert.jpg');
        $imagem_base64 = base64_encode($imagem);
    }
    $sql = "SELECT COUNT(prod_id) FROM produtos WHERE prod_nome = ? AND prod_ativo = 's'";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nome);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cont);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if ($cont == 1)
    {
        echo "<script>window.alert('PRODUTOD JÁ CADASTRADO!';</script>)";
    }
    else
    {
        if ($nome == "" || $descricao == "") 
        {
            echo "<script>window.alert('Por favor preencha os campos corretamente!');</script>";
            echo "<script>window.location.href='cadastroprodutos.php';</script>";
        }
        else
        {
            $sql = "INSERT INTO produtos(prod_nome, prod_descricao, prod_quantidade,prod_categoria,prod_marca,prod_custo,prod_valor,prod_ativo,prod_img)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 's', ?)";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "ssiisdds", $nome, $descricao, $quantidade, $categoria, $marca, $custo, $valor, $imagem_base64);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            echo "<script>window.alert('PRODUTO CADASTRADO COM SUCESSO');</script>";
            echo "<script>window.location.href='cadastroprodutos.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Cadastrar Produtos</title>
</head>
<body>
    <div id="div-produto">
        <div id="div-produtos">
                <h2>Cadastro de Produtos</h2>
            <form action="cadastroprodutos.php" method="post"  enctype="multipart/form-data">
                <label for="">NOME PRODUTOS</label>
                <br>
                <input type="text" name='nome' id="nome">
                <br>
                <label for="">DESCRIÇÃO</label>
                <br>
                <textarea type="text" name='descricao' id="descricao"></textarea>
                <br>
                <label for="">QUANTIDADE</label>
                <br>
                <input type="text" name='quantidade' id="quantidade">
                <br>
                <label for="">CATEGORIA</label>
                <br>
                <input type="text" name='categoria' id="categoria">
                <br>
                <label for="">MARCA</label>
                <br>
                <input type="text" name='marca' id="marca">
                <br>
                <label for="">CUSTO</label>
                <br>
                <input type="number" step="0.01" name='custo' id="custo">
                <br>
                <label for="">PREÇO</label>
                <br>
                <input type="number" step="0.01" name='valor' id="valor">
                <br>
                <label for="">IMAGEM</label>
                <br>
                <input type="file" name="imagem" id="imagem" placeholder="Insira a imagem" required>
                <br>
                <button type="submit" id="btn">CADASTRAR</button>
            </form>
        </div>
    </div>
</body>
</html>
