// Fungsi untuk menambahkan animasi fade-in pada setiap form
document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        form.classList.add("fade-in");
    });
});

// Efek animasi fade-in pada form
const formElements = document.querySelectorAll('form');
formElements.forEach((form, index) => {
    setTimeout(() => {
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
    }, index * 300); // Memberikan delay untuk setiap form
});

// Untuk Bagian Update Skill
document.addEventListener("DOMContentLoaded", function() {
    const skillsContainer = document.getElementById("skills-container");
    const addSkillButton = document.getElementById("add-skill");

    // Fungsi untuk membuat skill row baru
    function createNewSkillRow(value = "") {
        let newSkillRow = document.createElement("div");
        newSkillRow.classList.add("skill-row");

        let newSkillInput = document.createElement("input");
        newSkillInput.type = "text";
        newSkillInput.name = "skills[]";
        newSkillInput.value = value;
        newSkillInput.required = true;

        let removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("remove-skill");
        removeButton.innerText = "X";
        removeButton.onclick = function() {
            newSkillRow.remove();
        };

        newSkillRow.appendChild(newSkillInput);
        newSkillRow.appendChild(removeButton);
        return newSkillRow;
    }

    // Tambahkan skill baru ketika tombol add diklik
    addSkillButton.addEventListener("click", function() {
        const newRow = createNewSkillRow();
        skillsContainer.appendChild(newRow);
        // Fokus ke input baru
        newRow.querySelector("input").focus();
    });

    // Event delegation untuk tombol hapus skill
    skillsContainer.addEventListener("click", function(e) {
        if (e.target.classList.contains("remove-skill")) {
            e.target.parentElement.remove();
        }
    });
});