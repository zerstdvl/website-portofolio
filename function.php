<?php
// Get portofolio data
$result = $conn->query("SELECT * FROM portfolio LIMIT 1");
$portfolioData = $result->fetch_assoc();

// Get skills data
$skills = [];
$skillResult = $conn->query("SELECT skill_name FROM skills");
while ($row = $skillResult->fetch_assoc()) {
    $skills[] = $row['skill_name'];
}

// Get projects data
$projects = [];
$projectResult = $conn->query("SELECT title, description, image FROM projects");
while ($row = $projectResult->fetch_assoc()) {
    $projects[] = $row;
}

// Get contacts data
$contactResult = $conn->query("SELECT * FROM contact LIMIT 1");
$contactData = $contactResult->fetch_assoc();

// Function to display skills
function displaySkills($skills) {
    $html = '';
    foreach ($skills as $skill) {
        $html .= "<span class='skill-tag'>$skill</span>";
    }
    return $html;
}

// Function to display projects
function displayProjects($projects) {
    $html = '';
    foreach ($projects as $project) {
        $html .= "
        <div class='project-card'>
            <div class='project-image' style='background-image: url(\"images/{$project['image']}\");'></div>
            <div class='project-info'>
                <h3 class='project-title'>{$project['title']}</h3>
                <p>{$project['description']}</p>
                <a href='#' class='btn'>Lihat Detail</a>
            </div>
        </div>";
    }
    return $html;
}
?>