<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Hybrid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="particles-js"></div>

    <header id="header">
        <div class="container header-container">
            <a href="#" class="logo">portfolio<span>.</span></a>
            <nav class="nav-links">
                <a href="#work">Projetos</a>
                <a href="#about">Sobre</a>
                <a href="#contact">Contato</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Designer & Developer criando o futuro</h1>
                <p>Transformo ideias em soluções que acompanham a evolução do mundo.</p>
                <div class="hero-buttons">
                    <a href="#work" class="btn btn-primary">Conheça meu trabalho</a>
                    <a href="#contact" class="btn btn-secondary">Entre em contato</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="work">
    <div class="container">
        <h2 class="section-title">Projetos</h2>
        <div class="work-grid">

            <?php
            include_once "./config/connectDB.php";

            $sql = "SELECT * FROM Projetos ORDER BY date DESC";
            $result = $conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imgPath = './config/uploads/' . $row['img'];
                    ?>
                    <a href="#" target="_blank" class="work-link">
                        <div class="work-item">
                            <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>" class="work-image">
                            <div class="work-info">
                                <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                                <p><?php echo htmlspecialchars($row['descricao']); ?></p>
                                <div class="work-tags">
                                    <?php
                                    $tags = explode(",", $row['tags']);
                                    foreach ($tags as $tag) {
                                        echo '<span class="tag">' . htmlspecialchars(trim($tag)) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<p>Nenhum projeto cadastrado ainda.</p>";
            }
            ?>
        </div>
    </div>
</section>


<?php
include_once "./config/connectDB.php";

$certificados = [];
$sql = "SELECT * FROM Certificados ORDER BY date DESC";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $certificados[] = $row;
    }
}
?>

<section id="certificates" class="section certificates-section">
    <div class="container">
        <h2 class="section-title">Certificados</h2>
        <div class="carousel-container">
            <div class="carousel-wrapper">
                <button class="carousel-btn prev-btn" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <div class="carousel-track-container">
                    <div class="carousel-track" id="carouselTrack">
                        <?php foreach ($certificados as $cert): ?>
                        <div class="certificate-card">
                            <div class="certificate-image">
                                <img src="./config/uploads/<?php echo htmlspecialchars($cert['img']); ?>" alt="<?php echo htmlspecialchars($cert['nome']); ?>">
                                <div class="certificate-date"><?php echo date('Y', strtotime($cert['date'])); ?></div>
                            </div>
                            <div class="certificate-info">
                                <h3><?php echo htmlspecialchars($cert['nome']); ?></h3>
                                <p class="description"><?php echo htmlspecialchars($cert['descricao']); ?></p>
                                <div class="certificate-tags">
                                    <?php 
                                    $tags = explode(',', $cert['tags']);
                                    foreach ($tags as $tag) {
                                        echo '<span class="tag">' . htmlspecialchars(trim($tag)) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="carousel-btn next-btn" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>


    
    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="about">
                <div class="about-content">
                    <h2>About Me</h2>
                    <p>Olá! Sou Pedro, desenvolvedor full stack e designer com mais de 5 anos de experiência. Minha
                        paixão é criar soluções que não só funcionam bem, mas que também proporcionam
                        experiências marcantes para os usuários.</p>

                    <p>Crio sites, e-commerces e aplicativos modernos, com foco em performance, design minimalista e
                        experiência do usuário.</p>

                    <p>Busco sempre entregar soluções que gerem valor real para o cliente. Vamos conversar?</p>

                    <div class="skills-section">
                        <h3>Technical Skills</h3>
                        <div class="skills-container">
                            <div class="skill-category">
                                <h4>Frontend</h4>
                                <div class="skills-list">
                                    <span class="tag">Javascript</span>
                                    <span class="tag">HTML/CSS</span>
                                    <span class="tag">React</span>
                                    <span class="tag">TypeScript</span>
                                    <span class="tag">Next.js</span>
                                    <span class="tag">Tailwind CSS</span>
                                    <span class="tag">Kodular</span>
                                </div>
                            </div>
                            <div class="skill-category">
                                <h4>Backend</h4>
                                <div class="skills-list">
                                    <span class="tag">Node.js</span>
                                    <span class="tag">Python</span>
                                    <span class="tag">PHP</span>
                                    <span class="tag">MongoDB</span>
                                    <span class="tag">Firebase</span>
                                    <span class="tag">Java</span>
                                    <span class="tag">C e C++</span>
                                </div>
                            </div>
                            <div class="skill-category">
                                <h4>Design</h4>
                                <div class="skills-list">
                                    <span class="tag">Figma</span>
                                    <span class="tag">Adobe XD</span>
                                    <span class="tag">Canva</span>
                                    <span class="tag">Photoshop</span>
                                    <span class="tag">Design Thinking</span>
                                </div>
                            </div>
                            <div class="skill-category">
                                <h4>Tools & Others</h4>
                                <div class="skills-list">
                                    <span class="tag">Git</span>
                                    <span class="tag">Unity</span>
                                    <span class="tag">Godot</span>
                                    <span class="tag">Vercel</span>
                                    <span class="tag">Espanhol fluente</span>
                                    <span class="tag">Inglês básico</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-image-container">
                    <img src="https://avatars.githubusercontent.com/u/104235452?s=400&u=4401987c644c030f0d400c7ec03f6aeaa56cafb2&v=4"
                        alt="Profile" class="about-image">
                </div>
            </div>
        </div>
    </section>


    <section id="contact" class="section">
        <div class="container">
            <div class="section-header">
                <h2>Tem um projeto em mente? Vamoss conversar!</h2>
                <br>
            </div>

            <form class="contact-form" id="contactForm" action="./config/database/contatos.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="nome@email.com"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Assunto</label>
                    <input type="text" id="subject" name="subject" class="form-control"
                        placeholder="Design | Website | Desenho " required>
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea id="message" name="message" class="form-control" rows="6"
                        placeholder="Conte um pouco sobre projeto..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-submit" action="./config/database/contatos.php" method="POST" >Send Message</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>Portfolio</h3>
                    <p>Designer & Developer crafting digital experiences</p>
                </div>
                <div class="footer-col">
                    <h3>Connect</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h3>Links</h3>
                    <a href="#work">Work</a>
                    <a href="#about">About</a>
                    <a href="#contact">Contact</a>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 Portfolio. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="script.js"></script>
</body>

</html>