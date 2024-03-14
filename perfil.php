<?php 
include("cabecalhocliente.php");

$id = $_GET['id'];
$sql = "SELECT * FROM cliente WHERE cli_id =$id";
$retorno = mysqli_query($link,$sql);
while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1]; #Campo nome
    $email = $tbl[2]; #Campo email
    $telefone = $tbl[3]; #Campo telefone
    $cpf = $tbl[4]; #Campo cpf
    $datadenascimento = $tbl[9];
    $genero = $tbl[8];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFIL USUARIO</title>
    <link rel = "stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="div-alterarusuario">
    <div class="div-alterarusu">
            <h2 id='h2-alterarprod'>PERFIL</h2><br>
        <form action="alterarcliente.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Nome</label><br>
            <input type="text" name ="nome" value="<?=$nome?>" readonly> <br>
            <label>Email</label> <br>
            <input type="email" name ="email" value="<?=$email?>" readonly> <br>
            <label>CPF</label> <br>
            <input type="number" name ="cpf" value="<?=$cpf?>" readonly> <br>
            <label>Data de Nascimento</label> <br>
            <input type="date" name ="datadenascimento" value="<?=$datadenascimento?>" readonly> <br>
            <label>Gênero</label> <br>
            <input type="text" name ="genero" value="<?=$genero?>" readonly> <br>  
            <label>Telefone</label> <br>
            <input type="number" name ="telefone" value="<?=$telefone?>" readonly> <br>
        </form>
            <a href="alterarcliente.php?id=<?=$id?>"><button>ALTERAÇÃO DE CADASTRO</button></a>
            <a href="enderecocobranca.php?id=<?=$id?>"><button>ENDEREÇO DE COBRANÇA</button></a>
            <a href="endereco.php?id=<?=$id?>"><button>ENDEREÇO</button></a>
    </div>
    </div>
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
</body>