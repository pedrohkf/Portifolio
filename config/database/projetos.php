<?php      
    include_once "../connectDB.php";

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $tags = $_POST['tags'];
    $img = $_POST['img'];


    $sql = "CREATE TABLE IF NOT EXISTS Projetos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(30) NOT NULL,
        descricao VARCHAR(30) NOT NULL,
        tags VARCHAR(30),
        img VARCHAR(50),
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );";

    if ($conexao->query($sql) === TRUE) {
        echo "Tabela Projetos criada com sucesso!";

    } else {
        echo "Erro ao criar tabela: " . $conexao->error;
    }

    $stmt = $conexao->prepare("INSERT INTO Projetos (nome, descricao, tags, img) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $descricao, $tags, $img);

    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
?>
