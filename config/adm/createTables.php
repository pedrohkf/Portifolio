<?php
include_once "../connectDB.php";

$sqlProjetos = "CREATE TABLE IF NOT EXISTS Projetos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    tags VARCHAR(255),
    img VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conexao->query($sqlProjetos);

$sqlCertificados = "CREATE TABLE IF NOT EXISTS Certificados (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    tags VARCHAR(255),
    img VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$conexao->query($sqlCertificados);

$msgProjeto = $msgCertificado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formType = $_POST['form_type'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $tags = $_POST['tags'] ?? '';
    
    if (!empty($nome) && !empty($descricao) && isset($_FILES['img'])) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        $img = $_FILES['img'];
        $imgPath = $uploadDir . basename($img['name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (in_array($img['type'], $allowedTypes) && move_uploaded_file($img['tmp_name'], $imgPath)) {
            $stmt = null;
            if ($formType === 'projeto') {
                $stmt = $conexao->prepare("INSERT INTO Projetos (nome, descricao, tags, img) VALUES (?, ?, ?, ?)");
            } elseif ($formType === 'certificado') {
                $stmt = $conexao->prepare("INSERT INTO Certificados (nome, descricao, tags, img) VALUES (?, ?, ?, ?)");
            }

            if ($stmt) {
                $stmt->bind_param("ssss", $nome, $descricao, $tags, $img['name']);
                if ($stmt->execute()) {
                    if ($formType === 'projeto') $msgProjeto = "<p style='color:green;'>Projeto cadastrado com sucesso!</p>";
                    if ($formType === 'certificado') $msgCertificado = "<p style='color:green;'>Certificado cadastrado com sucesso!</p>";
                } else {
                    if ($formType === 'projeto') $msgProjeto = "<p style='color:red;'>Erro ao inserir projeto: {$stmt->error}</p>";
                    if ($formType === 'certificado') $msgCertificado = "<p style='color:red;'>Erro ao inserir certificado: {$stmt->error}</p>";
                }
                $stmt->close();
            } else {
                if ($formType === 'projeto') $msgProjeto = "<p style='color:red;'>Erro na preparação do projeto!</p>";
                if ($formType === 'certificado') $msgCertificado = "<p style='color:red;'>Erro na preparação do certificado!</p>";
            }
        } else {
            if ($formType === 'projeto') $msgProjeto = "<p style='color:red;'>Formato de imagem inválido! Use JPG, PNG ou WEBP.</p>";
            if ($formType === 'certificado') $msgCertificado = "<p style='color:red;'>Formato de imagem inválido! Use JPG, PNG ou WEBP.</p>";
        }
    } else {
        if ($formType === 'projeto') $msgProjeto = "<p style='color:red;'>Preencha todos os campos e envie a imagem!</p>";
        if ($formType === 'certificado') $msgCertificado = "<p style='color:red;'>Preencha todos os campos e envie a imagem!</p>";
    }
}
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Projetos e Certificados</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; display: flex; gap: 50px; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; background: #4CAF50; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
        h1 { margin-bottom: 10px; }
        .container { display: flex; gap: 50px; }
        .msg { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div>
            <h1>Cadastrar Projeto</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="form_type" value="projeto">
                <label for="nome_projeto">Nome do Projeto:</label>
                <input type="text" id="nome_projeto" name="nome" required>
                <label for="descricao_projeto">Descrição:</label>
                <textarea id="descricao_projeto" name="descricao" required></textarea>
                <label for="tags_projeto">Tags:</label>
                <input type="text" id="tags_projeto" name="tags">
                <label for="img_projeto">Imagem (JPG, PNG, WEBP):</label>
                <input type="file" id="img_projeto" name="img" accept=".jpg,.jpeg,.png,.webp" required>
                <button type="submit">Salvar Projeto</button>
            </form>
            <div class="msg"><?php echo $msgProjeto; ?></div>
        </div>

        <div>
            <h1>Cadastrar Certificado</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="form_type" value="certificado">
                <label for="nome_certificado">Nome do Certificado:</label>
                <input type="text" id="nome_certificado" name="nome" required>
                <label for="descricao_certificado">Descrição:</label>
                <textarea id="descricao_certificado" name="descricao" required></textarea>
                <label for="tags_certificado">Tags:</label>
                <input type="text" id="tags_certificado" name="tags">
                <label for="img_certificado">Imagem (JPG, PNG, WEBP):</label>
                <input type="file" id="img_certificado" name="img" accept=".jpg,.jpeg,.png,.webp" required>
                <button type="submit">Salvar Certificado</button>
            </form>
            <div class="msg"><?php echo $msgCertificado; ?></div>
        </div>
    </div>
</body>
</html>
