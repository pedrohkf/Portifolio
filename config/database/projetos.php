<?php      
    include_once "./config/connectDB.php";

    $sql = "CREATE TABLE IF NOT EXISTS Contatos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        assunto VARCHAR(30),
        mensagem TEXT,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );";

    if ($conexao->query($sql) === TRUE) {
        echo "Tabela Contatos criada com sucesso!";
    } else {
        echo "Erro ao criar tabela: " . $conexao->error;
    }


    $conexao->close();
?>