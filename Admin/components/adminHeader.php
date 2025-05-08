
<!-- Header -->
<header class="admin-header">
    <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <div class="admin-search">
        <div class="input-group">
            <input type="text" class="form-control form-control-sm" placeholder="Search...">
            <button class="btn btn-sm btn-outline-secondary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div class="admin-actions">
        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                <?= htmlspecialchars("$greeting, $adminName") ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>