// Fonction pour basculer l'affichage du menu déroulant utilisateur
window.toggleDropdown = function () {
    // Récupère l'élément du menu déroulant utilisateur
    const dropdown = document.getElementById("userDropdownMenu");
    // Récupère l'élément affichant le nom d'utilisateur
    const username = document.querySelector(".user-dropdown .user");

    // Si l'un des éléments est introuvable, on arrête la fonction
    if (!dropdown || !username) return;

    // Vérifie si le menu déroulant est actuellement affiché (display: block)
    const isOpen = dropdown.style.display === "block";

    // Si ouvert, cache le menu et affiche le nom d'utilisateur
    // Sinon, affiche le menu et cache le nom d'utilisateur
    dropdown.style.display = isOpen ? "none" : "block";
    username.style.display = isOpen ? "block" : "none";
};

// Fonction similaire pour basculer l'affichage du menu déroulant des références
window.toggleReferencesDropdown = function () {
    // Récupère le menu déroulant des références
    const dropdown = document.getElementById("referencesDropdownMenu");
    // Récupère le label affiché quand le menu est fermé
    const label = document.querySelector(".manage-reference .dropdown-ref");

    // Si un élément est introuvable, on arrête
    if (!dropdown || !label) return;

    // Vérifie si le menu est ouvert (display: block)
    const isOpen = dropdown.style.display === "block";

    // Bascule l'affichage du menu et du label selon l'état actuel
    dropdown.style.display = isOpen ? "none" : "block";
    label.style.display = isOpen ? "block" : "none";
};

// Écouteur global qui ferme les menus déroulants si on clique en dehors
document.addEventListener("click", (event) => {

    // Récupère le menu utilisateur, la zone info utilisateur et le nom d'utilisateur
    const userDropdown = document.getElementById("userDropdownMenu");
    const userInfo = document.querySelector(".user-info");
    const username = document.querySelector(".user-dropdown .user");

    // Si les éléments existent et que le clic est en dehors de la zone utilisateur
    if (userDropdown && userInfo && username && !userInfo.contains(event.target)) {
        // On cache le menu déroulant utilisateur
        userDropdown.style.display = "none";
        // On affiche le nom d'utilisateur (le label)
        username.style.display = "block";
    }

    // Même logique pour le menu déroulant des références
    const refDropdown = document.getElementById("referencesDropdownMenu");
    const refInfo = document.querySelector(".manage-reference");
    const refLabel = document.querySelector(".manage-reference .dropdown-ref");

    // Si les éléments existent et que le clic est en dehors de la zone des références
    if (refDropdown && refInfo && refLabel && !refInfo.contains(event.target)) {
        // On cache le menu déroulant des références
        refDropdown.style.display = "none";
        // On affiche le label des références
        refLabel.style.display = "block";
    }
});
