<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/includes_css/profile.css">
    <title>Document</title>
</head>
<body>
    <div class="top-navbar">
    <div class="profile-section">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Profile Picture" class="profile-img">
        <div class="profile-info">
            <span class="profile-name"><?php echo $_SESSION['username'] ?></span>
            <span class="profile-role">Administrator Utama</span>
        </div>
    </div>

    <div class="action-section">
        <div class="theme-toggle-wrapper">
            <i class="fa-solid fa-sun icon-sun"></i>
            <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="checkbox" onclick="toggleTheme()" />
                <div class="slider round"></div>
            </label>
            <i class="fa-solid fa-moon icon-moon"></i>
        </div>

        <button class="nav-icon-btn" title="Pesan">
            <i class="fa-solid fa-envelope"></i>
            <span class="badge-dot"></span>
        </button>

        <button class="nav-icon-btn" title="Notifikasi">
            <i class="fa-solid fa-bell"></i>
            <span class="badge-dot"></span>
        </button>
    </div>
</div>
<script>
    function toggleTheme() {
        const checkbox = document.getElementById('checkbox');
        if (checkbox.checked) {
            console.log("Dark Mode diaktifkan, Tuan Muda.");
            // Kode modifikasi warna dark mode bisa ditaruh di sini nanti
        } else {
            console.log("Light Mode diaktifkan, Tuan Muda.");
        }
    }
</script>
</body>
</html>