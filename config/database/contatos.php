<?php      
    include_once "../connectDB.php";

    $nome = $_POST['name'];
    $email = $_POST['email'];
    $assunto = $_POST['subject'];
    $mensagem = $_POST['message'];


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

    $stmt = $conexao->prepare("INSERT INTO Contatos (nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $assunto, $mensagem);

    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
?>
