<?php 
#Conexão com o banco
include("cabecalhocliente.php");
#PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
$sql = "SELECT * FROM produtos WHERE prod_ativo = 's'";
$retorno = mysqli_query($link, $sql);
#FORÇA SEMPRE TRAZER 'S' NA VÁRIAVEL PARA UTILIZARMOS NOS RADIO BUTTON
#COLETA O BOTÃO MÉTODO POST VINDO DO HTML
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" href="./css/styles.css">
        <title>LOJA</title>
    </head>
    <body>
        <div class="div-form">
            <div class="shopping">
                    <?php
                    #FAZENDO O PREENCHIMENTO DE TABELA USANDO WHILE (ENQUANTO TEM DADOS RODA PREENCHENDO)
                    while ($tbl = mysqli_fetch_array($retorno)) {
                        #Mais aqui eu fecho para trabalhar com HTML SIMULTANEAMENTE
                    ?>
                        <div class="product-card">
                            <h3><img src="data:image/jpeg;base64,<?= $tbl[9] ?>" width="100" height="100" ></h3><!--TRAZ SOMENTE A COLUNA 9 [IMagem] DO BANCO-->
                            <h3><?= $tbl[1] ?></h3> <!--TRAZ SOMENTE A COLUNA 1 [nome] DO BANCO-->
                            <h3>R$<?=  number_format($tbl[7],2,',','.') ?></h3><!--TRAZ SOMENTE A COLUNA 7 [VALOR] DO BANCO-->
                            <?php 
                            if ($tbl[3] > 0 ){
                            ?>
                            <button onclick="location.href='verproduto.php?id=<?=$tbl[0]?>'" class="product-button">Comprar</button>
                            <?php 
                            } else {
                            ?>  
                            <button <?=$tbl[0]?> class="product-button2">Fora de Estoque</button>
                            <?php
                            }
                            ?>
                        </div> 
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
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
</html>