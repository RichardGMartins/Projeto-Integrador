CREATE DATABASE muybella;


USE muybella;

CREATE TABLE cliente (
    cli_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cli_nome VARCHAR(50) NOT NULL,
    cli_email VARCHAR(100) NOT NULL,
    cli_telefone BIGINT NOT NULL,
    cli_cpf VARCHAR(20) NOT NULL,
    cli_status CHAR(1) NOT NULL
);
CREATE TABLE produtos (
    prod_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	prod_nome VARCHAR(50) NOT NULL,
    prod_descricao VARCHAR(150) NOT NULL,
    prod_quantidade INT(11) NOT NULL,
    prod_categoria VARCHAR(50) NOT NULL,
    prod_marca VARCHAR(50) NOT NULL,
    prod_custo INT(11),
    prod_valor DECIMAL(10,2) NOT NULL,
    prod_ativo CHAR(1),
    prod_img LONGBLOB
);
CREATE TABLE endereco_entrega (
	end_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    end_rua VARCHAR(255) NOT NULL,
    end_cidade VARCHAR(255)NOT NULL,
    end_estado VARCHAR(50) NOT NULL,
    end_pais VARCHAR(50) NOT NULL,
    end_codigo_postal VARCHAR(20) NOT NULL
);
CREATE TABLE endereco_cobranca (
	end_cob_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    end_cob_rua VARCHAR(255) NOT NULL,
    end_cob_cidade VARCHAR(255) NOT NULL,
    end_cob_estado VARCHAR(50) NOT NULL,
    end_cob_pais VARCHAR(50) NOT NULL,
    end_cob_codigo_postal VARCHAR(20) NOT NULL
);
CREATE TABLE pedidos (
    ped_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ped_cliente_id INT,
    ped_data_pedido DATE,
    ped_status VARCHAR(20),
    FOREIGN KEY (ped_cliente_id) REFERENCES clientes(id)
);
CREATE TABLE itens_pedido (
    itens_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    produto_id INT,
    itens_quantidade INT,
    itens_preco_unitario DECIMAL(10, 2),
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
CREATE TABLE usuarios (
    usu_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usu_login VARCHAR(20) NOT NULL,
    usu_senha VARCHAR(50) NOT NULL,
    usu_status CHAR(1) NOT NULL
);