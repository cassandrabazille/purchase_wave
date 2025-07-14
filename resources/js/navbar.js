window.toggleDropdown = function () {
   
    const dropdown = document.getElementById("userDropdownMenu");
    const username = document.querySelector(".user-dropdown .user"); // le <p>

    if (!dropdown || !username) return;

    // Toggle visibility du menu
    const isOpen = dropdown.style.display === "block";
    dropdown.style.display = isOpen ? "none" : "block";

    // Toggle visibility du nom
    username.style.display = isOpen ? "block" : "none";
}

// Fermer le menu si on clique ailleurs
document.addEventListener("click", (event) => {
    const dropdown = document.getElementById("userDropdownMenu");
    const userInfo = document.querySelector(".user-info");
    const username = document.querySelector(".user-dropdown .user");

    if (!dropdown || !userInfo || !username) return;

    if (!userInfo.contains(event.target)) {
        dropdown.style.display = "none";
        username.style.display = "block"; // Réaffiche le nom si on clique ailleurs
    }
});
