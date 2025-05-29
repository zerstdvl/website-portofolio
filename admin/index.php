<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

require '../config.php';

// Mengambil data portofolio
$result = $conn->query("SELECT * FROM portfolio LIMIT 1");
$portfolioData = $result->fetch_assoc();

// Jika data portfolio tidak ditemukan, set default kosong
if (!$portfolioData) {
    $portfolioData = [
        'name' => '',
        'title' => '',
        'about' => '',
        'email' => '',
        'linkedin' => '',
        'github' => '',
        'instagram' => ''
    ];
}

// Mengambil data kontak
$contactResult = $conn->query("SELECT * FROM contact LIMIT 1");
$contactData = $contactResult->fetch_assoc();

// Jika data kontak tidak ditemukan, set default kosong
if (!$contactData) {
    $contactData = [
        'email' => '',
        'linkedin' => '',
        'github' => '',
        'instagram' => ''
    ];
}

// Ambil data skill dari database (dipindahkan ke luar blok POST)
$skills = [];
$skillResult = $conn->query("SELECT skill_name FROM skills");
while ($row = $skillResult->fetch_assoc()) {
    $skills[] = $row['skill_name'];
}

// Jika tidak ada skill di database, tampilkan satu kolom kosong
if (empty($skills)) {
    $skills[] = "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Proses Update data portofolio
if (isset($_POST['updatePortfolio'])) {
    $stmt = $conn->prepare("UPDATE portfolio SET name = ?, title = ?, about = ? WHERE id = 1");
    $stmt->bind_param("sss", $_POST['name'], $_POST['title'], $_POST['about']);
    $stmt->execute();
    header("Location: index.php");
}

    // Proses Update Skill
    if (isset($_POST['updateSkills'])) {
        $newSkills = $_POST['skills'];

        // Hapus skill lama
        $conn->query("DELETE FROM skills");

        // Insert ulang skill yang ada
        foreach ($newSkills as $skill) {
            if (!empty($skill)) { // Hindari memasukkan string kosong
                $stmt = $conn->prepare("INSERT INTO skills (skill_name) VALUES (?)");
                $stmt->bind_param("s", $skill);
                $stmt->execute();
            }
        }
        header("Location: index.php");
        exit();
    }

    // Proses Update kontak
    if (isset($_POST['updateContact'])) {
        $email = $_POST['email'];
        $linkedin = $_POST['linkedin'];
        $github = $_POST['github'];
        $instagram = $_POST['instagram'];

        $conn->query("UPDATE contact SET email = '$email', linkedin = '$linkedin', github = '$github', instagram = '$instagram' WHERE id = 1");
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="script.js" defer></script>
    <title>Admin Panel</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Admin Panel</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="panels-container">
            <div class="panel">
                <h3>Update Portfolio</h3>
                <form method="post" action="index.php">
                    <input type="text" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($portfolioData['name']); ?>" required>
                    <input type="text" name="title" placeholder="Your Title" value="<?php echo htmlspecialchars($portfolioData['title']); ?>" required>
                    <textarea name="about" placeholder="About Yourself" required><?php echo htmlspecialchars($portfolioData['about']); ?></textarea>
                    <button type="submit" name="updatePortfolio">Update Portfolio</button>
                </form>
            </div>

            <div class="panels-container">
                <div class="panel">
                    <h3>Update Skills</h3>
                    <form method="post" action="index.php">
                        <div id="skills-container">
                            <?php foreach ($skills as $index => $skill): ?>
                                <div class="skill-row">
                                    <input type="text" name="skills[]" value="<?php echo htmlspecialchars($skill); ?>" required>
                                    <button type="button" class="remove-skill">X</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" id="add-skill">+ Add Skill</button>
                        <button type="submit" name="updateSkills">Update Skills</button>
                    </form>
                </div>
            </div>

            <div class="panel">
                <h3>Update Contact Info</h3>
                <form method="post" action="index.php">
                    <input type="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($contactData['email']); ?>" required>
                    <input type="text" name="linkedin" placeholder="LinkedIn URL" value="<?php echo htmlspecialchars($contactData['linkedin']); ?>" required>
                    <input type="text" name="github" placeholder="GitHub URL" value="<?php echo htmlspecialchars($contactData['github']); ?>" required>
                    <input type="text" name="instagram" placeholder="Instagram URL" value="<?php echo htmlspecialchars($contactData['instagram']); ?>" required>
                    <button type="submit" name="updateContact">Update Contact</button>
                </form>
            </div>
        </div>
    </div>






</body>

</html>