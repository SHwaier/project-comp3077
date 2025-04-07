
window.onload = async function () {
    const token = localStorage.getItem('Token');
    const loginLink = document.getElementById("desktop-header-profile-login");
    const iconGroup = document.getElementById("desktop-header-profile-icons");

    if (!token) {
        console.warn("No token found.");
        return;
    }

    try {
        const res = await fetch('/estore/api/auth/authorize_frontend.php', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const data = await res.json();

        if (res.ok && data.status === "verified") {
            if (loginLink) loginLink.style.display = "none";
            if (iconGroup) iconGroup.classList.remove("hidden");
            iconGroup.style.display = "flex";
            console.log("✅ User is signed in:", data);
        } else {
            console.warn("❌ Not signed in:", data.error);
        }
    } catch (err) {
        console.error("Authorization check failed:", err);
    }
};


// This function is used to toggle the mobile menu on and off
document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("mobile-menu-toggle");
    const closeBtn = document.getElementById("mobile-menu-close");
    const sidebar = document.getElementById("mobile-sidebar");
    const overlay = document.getElementById("sidebar-overlay");

    const openSidebar = () => {
        sidebar.classList.add("show");
        overlay.classList.add("show");
    };

    const closeSidebar = () => {
        sidebar.classList.remove("show");
        overlay.classList.remove("show");
    };

    toggleBtn.addEventListener("click", openSidebar);
    closeBtn.addEventListener("click", closeSidebar);
    overlay.addEventListener("click", closeSidebar);
});