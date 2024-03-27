<?php 
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
     $id = $_POST['id'];
     $nome = $_POST['nome'];
     $descricao = $_POST['descricao'];
     $quantidade = $_POST['quantidade'];
     $categoria = $_POST['categoria'];
     $marca = $_POST['marca'];
     $custo = $_POST['custo'];
     $valor = $_POST['valor'];
     $ativo = $_POST['ativo'];
     $imagem_base64 = $_POST['imagem'];
     $imagem_atual = $_POST['imagem_atual'];

     if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
        $tipo = exif_imagetype($_FILES['imagem']['tmp_name']);
        if ($tipo !== false) {
            // O arquivo é uma imagem
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $imagem_base64 = base64_encode($imagem);
        } else {
            // O arquivo não é uma imagem
            $imagem = file_get_contents('C:\xampp\htdocs\projetosti26\Projeto Integrador\img\alert.jpg');
            $imagem_base64 = base64_encode($imagem);
        }
    }

    if ($imagem_atual == $imagem_base64) {
        $sql = "UPDATE produtos SET prod_nome = ?, prod_descricao = ?, prod_quantidade = ?, prod_categoria = ?, prod_marca = ?, prod_custo = ?, prod_valor = ?, prod_ativo = ? WHERE prod_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssdsi", $nome, $descricao, $quantidade, $categoria, $marca, $custo, $valor, $ativo, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $sql = "UPDATE produtos SET prod_nome = ?, prod_descricao = ?, prod_quantidade = ?, prod_categoria = ?, prod_marca = ?, prod_custo = ?, prod_valor = ?, prod_ativo = ?, prod_img = ? WHERE prod_id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssdssi", $nome, $descricao, $quantidade, $categoria, $marca, $custo, $valor, $ativo, $imagem_base64, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    echo ("<script>window.alert('Produto alterado com sucesso!');</script>");
    echo ("<script>window.location.href='listaprodutos.php';</script>");
    exit();
}
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE prod_id =$id";
    $retorno = mysqli_query($link,$sql);

    while ($tbl = mysqli_fetch_array($retorno)){
        $nome = $tbl[1]; #Campo nome
        $descricao = $tbl[2]; #Campo Descrição
        $quantidade = $tbl[3]; #Campo Quantidade
        $categoria = $tbl[4]; #Campo categoria
        $marca = $tbl[5]; #Campo marca
        $custo = $tbl[6]; #Campo custo
        $valor = $tbl[7];# Campo Valor
        $ativo = $tbl[8];# Campo Ativo
        $imagem_atual = $tbl[9];#Campo Img
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Produtos</title>
    <link rel="stylesheet" href="./css/styles.css" >
</head>
<body>
<div class="div-alterarusuario">
<div class="div-alterarusu">
        <form action="alterarprodutos.php" method="post" enctype="multipart/form-data">
            <h2 id='h2-alterarprod'>Alteração Produtos</h2><br>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label><br>
            <input type="text" name ="nome" id="nome" value="<?= $nome?>" required></input><br>
            <label>Descrição</label><br>
            <input type="text"  name ="descricao" id="descricao" value="<?=$descricao?>" required> <br>
            <label>Categoria</label> <br>
            <input type="text"  name ="categoria" id="categoria" value="<?=$categoria?>" required> <br>
            <label>Marca</label> <br>
            <input type="text"  name ="marca" id="marca" value="<?=$marca?>" required> <br>
            <label>Quantidade</label> <br>
            <input type="number"  name ="quantidade" id="quantidade" min="0" value="<?= $quantidade ?>" required> <br>
            <label>Custo</label> <br>
            <input type="number"  name ="custo" id="custo" min="0"step="0.01" value="<?= $custo ?>" required> <br>
            <label>Valor</label> <br>
            <input type="number"  name ="valor" id="valor" min="0"step="0.01" value="<?= $valor ?>" required> <br>
            <label>Imagem</label> <br>
            <input type="file" name ="imagem" id="imagem" value="<?= $imagem_base64 ?>"> <br>
            <label id="lb-form">Status: <?= $check = ($ativo =='s') ? "Ativo" : "Inativo" ?> </label> <br>
            <br>
            <input type="radio" name = "ativo" value="s" <?=$ativo == "s" ? "checked" : "" ?>>ATIVO<br>
            <input type="radio" name = "ativo"  value="n" <?=$ativo == "n" ? "checked" : "" ?>>INATIVO<br>
            <button type="submit" name ="cadastrar" id="btn">Alterar </button>
        </form>
    </div>
</div>
    <div class="imagem-div">
        <h2 id="imagem-div-h2">Imagem Atual</h2>
        <td><img name = "imagem_atual" class ="imagem_atual" src="data:image/jpeg;base64,<?= $imagem_atual?>"></td>
    </div>
    
</body>
</html>