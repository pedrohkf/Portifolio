<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $phone = '5512981184584';

    $text = "📩 Novo Contato pelo Site!\n\n";
    $text .= "👤 Nome: $name\n";
    $text .= "📧 Email: $email\n";
    $text .= "📌 Assunto: $subject\n";
    $text .= "💬 Mensagem: $message";

    $encodedText = urlencode($text);

    $url = "https://wa.me/$phone?text=$encodedText";

    header("Location: $url");
    exit;
} else {
    echo "Método inválido.";
}
