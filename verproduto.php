<?php 
include ('cabecalhocliente.php');

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $id = $_POST['id'];
    $nomeproduto = $_POST['nomeproduto'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $quantidade = (int)$quantidade;
    $preco = $_POST['preco'];
    $preco = (float)$preco;
    $totalitem = (($preco));
    $numerocarrinho = ($idclientes . RAND());


if ($idclientes <= 0){
    echo"<script>window.alert('VOCÊ PRECISA FAZER O LOGIN PARA ADICIONAR AO CARRINHO');</script>";
    echo"<script>window.location.href='loja.php';</script>";
} else {
    //VERIFICA SE EXISTE UM CARRINHO JÁ ABERTO
    $sql = "SELECT COUNT(car_id) FROM carrinho INNER JOIN cliente ON fk_cli_id = cli_id WHERE cli_id = $idclientes AND car_finalizada = 'n'";
    $retorno = mysqli_query($link,$sql);
    //SE CARRINHO NÃO EXISTE CRIA UM NOVO CARRINHO

    while ($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];

        if($cont == 0) {
            $valor_venda = $quantidade * $preco;

            //SE O CARRINHO NÃO EXISTE GERA UM NOVO CARRINHO E INSERE NA TABELA  ITENS DO CARRINHO
            $sql = "INSERT INTO carrinho(car_id,fk_cli_id, car_valorvenda,car_finalizada) VALUES ($numerocarrinho,$idclientes,$valor_venda,'n')";
            mysqli_query($link,$sql);

            $sql2 = "INSERT INTO item_carrinho(fk_car_id,fk_prod_id,car_item_quantidade) VALUES ($numerocarrinho,$id,$quantidade)";
            mysqli_query($link,$sql2);
            $_SESSION['carrinhoid'] = $numerocarrinho;
            echo"<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinho');</script>";
            echo"<script>window.location.href='loja.php';</script>";
        }else {
            //SE CARRINHO EXISTE , CONSULTA O NUMERO DO CARRINHO PARA ADICIONAR MAIS ITEMS
            $sql ="SELECT car_id FROM carrinho WHERE fk_cli_id = '$idclientes' AND car_finalizada = 'n' ";
            $retorno = mysqli_query($link,$sql);

            while($tbl = mysqli_fetch_array($retorno)){
                $numerocarrinho = $tbl[0];
                $_SESSION['carrinhoid'] = $numerocarrinho;
                
                #Verifica se já existe esse item ao carrinho
                #Se já existe, atualiza a quantidade
                $sql2 = "SELECT car_item_quantidade FROM item_carrinho WHERE fk_car_id = '$numerocarrinho' AND fk_prod_id = $id";
                $retorno2 = mysqli_query($link,$sql2);
                $qntd_atual = mysqli_fetch_array($retorno2);

                if ($retorno2){
                    if (mysqli_num_rows($retorno2) >= 1){
                        $sql = "UPDATE item_carrinho SET car_item_quantidade = ($quantidade+$qntd_atual[0]) WHERE fk_car_id = '$numerocarrinho'";
                        mysqli_query($link, $sql);
                        echo ("<script>window.alert('Produto adicionado ao carrinho $numerocarrinho');</script>");
                        echo ("<script>window.location.href='loja.php';</script>");
                    }
                    #Se já existe, adiciona o novo item
                    else{
                        $sql = "INSERT INTO item_carrinho(fk_car_id, fk_prod_id, car_item_quantidade) VALUES ('$numerocarrinho','$id',$quantidade)";
                        mysqli_query($link,$sql);
                        echo ("<script>window.alert('Produto adicionado ao carrinho $numerocarrinho');</script>");
                        echo ("<script>window.location.href='loja.php';</script>");
                    }
                }
            }
        } 
    }
    } 
    echo ("<script>window.location.href='loja.php';</script>");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE prod_id = $id";
$retorno = mysqli_query($link,$sql);
while($tbl = mysqli_fetch_array($retorno)){
    $id = $tbl[0];
    $nomeproduto = $tbl[1];
    $descricao = $tbl[2]; 
    $preco = $tbl[7]; 
    $imagem_atual = $tbl[9];
    $quantidade = $tbl[3];
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Ver Produtos</title>
</head>
<body>
    <div class="div-foorm3">
    <div class="div-form3">
        <form action="verproduto.php" class="visualizaproduto" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" readonly>
            <div class="nomeproduto"><?=$nomeproduto?></div><br>
            <div class="span-desc"><span><?=$descricao?></span></div><br>
            <input type="number" name="preco" class="span-preco" value="<?=$preco?>" readonly><br>
            <input type="number" name="quantidade" id="quantidade" min="1" value="1">
            <button type="submit" id="btn2">ADICIONAR AO CARRINHO </button>
        </form>
    </div>
    </div>
    <div class="favoritos">
            <td><img name="imagem_atual" class="imagem_atual2" src="data:imagem/jpeg;base64, <?= $imagem_atual ?>"></td>
    </div>
     <!--6 Seção Footer-->
     <footer>
                <div class="wrapper">
                    <div class="footer-box">
                        <div class="company-footer">
                            <img src="./img/LOGO MUY BELLA OP2 S FUNDO.png">
                            <h2>STORE</h2>
                            <p>Seu Site de Compras de Roupa Favorito.</p>
                        </div>
                    </div>
                    <div class="footer-box">
                        <div class="articles-footer">
                            <h2></h2>
                            <ul class="footer-list footer-article-list">
                                <li><a href="#"></a>
                                <span class="article-date"></span></li>
                                <li>
                                    <a href="#"></a>
                                <span class="article-date"></span>
                                </li>
                                <li>
                                    <a href="#"></a>
                                <span class="article-date"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-box">
                        <h2 id ="footerh2">Nos encontre nas rede sociais</h2>
                        <ul class="footer-list">
                            <li><a href="#"><i class="fab fa-facebook-square"></i>
                                <span>Facebook</span>
                            </a>
                        </li>
                            <li><a href="#"><i class="fab fa-instagram"></i>
                                <span>Instagram</span>
                            </a>
                        </li>
                            <li><a href="#"><i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                            </a>
                        </li>
                    </ul>
                    </div>  
                </div>
                    <div class="footer-bottom">
                        <div class="wrapper">
                            <p>Criador Richard Martins - TI26 | © Direito Reservados </p>
                        </div>
                    </div>         
            </footer>
    <script src="https://code.jquery.com/jquery-3.7.0.js" 
    integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>