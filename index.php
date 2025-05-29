<?php
// Sertakan koneksi database
require 'config.php';
require 'function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Portofolio <?php echo $portfolioData['name']; ?></title>
</head>

<body>
    <header>
        <nav>
            <div class="logo"><?php echo $portfolioData['name']; ?></div>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#about">About Me</a>
                <a href="#projects">Project</a>
                <a href="#contact">Contact</a>
            </div>
            <button class="mobile-menu-btn">☰</button> <!-- Menu tombol mobile -->
        </nav>
    </header>

    <div class="mobile-menu">
        <button class="close-menu">×</button>
        <a href="#home">Home</a>
        <a href="#about">About Me</a>
        <a href="#projects">Project</a>
        <a href="#contact">Contact</a>
    </div>

    <section id="home" class="hero">
        <h1><?php echo $portfolioData['name']; ?></h1>
        <p><?php echo $portfolioData['title']; ?></p>
        <p><?php echo $portfolioData['about']; ?></p>
        <a href="#contact" class="btn">Hubungi Saya</a>
    </section>

    <section id="about" class="about">
        <h2 class="section-title">About Me</h2>
        <div class="about-content">
            <div class="about-text">
                <p>I'm someone who's deeply interested in the world of Web3. I'm also very passionate about learning AI. I've successfully created prompts for generating aesthetic images.</p>
                <p>With skill prompt AI, and Focus on Blockchain, I can generate AI image with aesthethic, then can make AI token too in Blockchain</p>

                <h3 style="margin-top: 1.5rem;"> My skills</h3>
                <div class="skill-tags">
                    <?php if (!empty($skills)): ?>
                        <?php foreach ($skills as $skill): ?>
                            <span class="skill-tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Belum ada skill yang ditambahkan.</p>
                    <?php endif; ?>
                </div>
                <div class="about-image">
                    <img src="images/profile.jpg" alt="Foto profil" onerror="this.src='https://via.placeholder.com/400'">
                </div>
            </div>
    </section>

    <section id="projects" class="projects">
        <h2 class="section-title">Recent Projects</h2>
        <div class="project-grid">
            <?php echo displayProjects($projects); ?>
        </div>
    </section>

    <section id="contact" class="contact">
        <h2 class="section-title">Contact</h2>
        <div class="contact-content">
            <p>Tertarik bekerja sama atau punya pertanyaan? Silakan hubungi saya melalui salah satu kontak berikut:</p>

            <div class="contact-info">
                <!-- Wrap the contact card in a link -->
                <a href="mailto:<?php echo htmlspecialchars($contactData['email']); ?>" class="contact-card-link">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <?php if (!empty($contactData) && isset($contactData['email'])): ?>
                                <p><?php echo htmlspecialchars($contactData['email']); ?></p>
                            <?php else: ?>
                                <p>Email tidak tersedia</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <footer>
        <div class="social-media-header">
            <h3>Follow Me</h3>
        </div>
        <div class="social-links">

            <?php if (!empty($contactData) && isset($contactData['linkedin'])): ?>
                <a href="<?php echo htmlspecialchars($contactData['linkedin']); ?>" target="_blank">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
            <?php else: ?>
                <span>LinkedIn tidak tersedia</span>
            <?php endif; ?>

            <?php if (!empty($contactData) && isset($contactData['github'])): ?>
                <a href="<?php echo htmlspecialchars(string: $contactData['github']); ?>" target="_blank">
                    <i class="fa-brands fa-github"></i>
                </a>
            <?php else: ?>
                <span>GitHub tidak tersedia</span>
            <?php endif; ?>

            <?php if (!empty($contactData) && isset($contactData['instagram'])): ?>
                <a href="<?php echo htmlspecialchars($contactData['instagram']); ?>" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            <?php else: ?>
                <span>Instagram tidak tersedia</span>
            <?php endif; ?>

            <?php if (!empty($contactData) && isset($contactData['twitter'])): ?>
                <a href="<?php echo htmlspecialchars($contactData['twitter']); ?>" target="_blank">
                    <i class="fa-brands fa-square-x-twitter"></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($contactData) && isset($contactData['telegram'])): ?>
                <a href="<?php echo htmlspecialchars($contactData['telegram']); ?>" target="_blank">
                    <i class="fa-brands fa-telegram"></i>
                </a>
            <?php endif; ?>

        </div>
        <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($portfolioData['name'] ?? 'Nama Tidak Tersedia'); ?>. Semua hak dilindungi.</p>
    </footer>

    <div id="scroll-top">↑</div>

</body>

</html>