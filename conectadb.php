<?php
#Conecta com o servidor (Xampp)
$servidor = "127.0.0.1"; #Ou localhost

#Nome do banco
$banco = "muybella";

#Nome do Usuário
$usuario =  "adm";

#Senha do Usuário
$senha = "123";

#Link de conexão com o banco
$link = mysqli_connect($servidor, $usuario, $senha, $banco);
?>