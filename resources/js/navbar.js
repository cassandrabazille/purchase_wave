window.toggleDropdown = function () {
    const dropdown = document.getElementById("userDropdownMenu");
    const username = document.querySelector(".user-dropdown .user");

    if (!dropdown || !username) return;

    const isOpen = dropdown.style.display === "block";
    dropdown.style.display = isOpen ? "none" : "block";
    username.style.display = isOpen ? "block" : "none";
};

window.toggleReferencesDropdown = function () {
    const dropdown = document.getElementById("referencesDropdownMenu");
    const label = document.querySelector(".manage-reference .dropdown-ref");

    if (!dropdown || !label) return;

    const isOpen = dropdown.style.display === "block";
    dropdown.style.display = isOpen ? "none" : "block";
    label.style.display = isOpen ? "block" : "none";
};


document.addEventListener("click", (event) => {

    const userDropdown = document.getElementById("userDropdownMenu");
    const userInfo = document.querySelector(".user-info");
    const username = document.querySelector(".user-dropdown .user");

    if (userDropdown && userInfo && username && !userInfo.contains(event.target)) {
        userDropdown.style.display = "none";
        username.style.display = "block";
    }

    const refDropdown = document.getElementById("referencesDropdownMenu");
    const refInfo = document.querySelector(".manage-reference");
    const refLabel = document.querySelector(".manage-reference .dropdown-ref");

    if (refDropdown && refInfo && refLabel && !refInfo.contains(event.target)) {
        refDropdown.style.display = "none";
        refLabel.style.display = "block";
    }
});
