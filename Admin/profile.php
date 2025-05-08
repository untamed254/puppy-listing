<?php
session_start();
// Time-based greeting
$hour = date('H');
$greeting = match(true) {
    $hour >= 5 && $hour < 12 => "Good morning",
    $hour >= 12 && $hour < 17 => "Good afternoon",
    $hour >= 17 && $hour < 21 => "Good evening",
    default => "Good night"
};

// Get admin name from session (assuming you store it during login)
$adminName = $_SESSION['admin_name'] ?? 'Admin';

include("../Includes/conn.php");
include("functions/functions.php");

if (!is_logged_in()) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | PawaPets Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #2e59d9;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--light-color);
            overflow-x: hidden;
        }

        /* Main Layout Structure */
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: 250px;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            font-weight: 800;
            font-size: 1.2rem;
            text-align: center;
            letter-spacing: 0.05rem;
        }

        .sidebar-brand i {
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar-menu {
            padding: 0;
            list-style: none;
            margin-top: 1rem;
        }

        .sidebar-menu li {
            position: relative;
            margin-bottom: 0.3rem;
        }

        .sidebar-menu li a {
            display: block;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu li a:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu li a i {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
        }

        .sidebar-menu li.active a {
            color: white;
            font-weight: 700;
        }

        .sidebar-menu li.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: white;
        }

        /* Header Styles */
        .admin-header {
            height: 56px;
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 999;
            transition: left 0.3s;
        }

        #sidebarToggle {
            margin-right: 1rem;
        }

        .admin-search {
            flex-grow: 1;
            max-width: 400px;
        }

        /* Main Content Area */
        .admin-main {
            margin-left: 250px;
            margin-top: 56px;
            padding: 1.5rem;
            flex: 1;
            transition: margin-left 0.3s;
        }

        /* Profile Specific Styles */
        .profile-header {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .profile-details {
            padding-left: 2rem;
        }

        .profile-nav {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .profile-nav .nav-link {
            color: var(--dark-color);
            padding: 0.75rem 1rem;
            border-radius: 0.35rem;
        }

        .profile-nav .nav-link.active {
            color: white;
            background-color: var(--primary-color);
        }

        .profile-card {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .admin-sidebar {
                left: -250px;
            }
            
            .admin-sidebar.show {
                left: 0;
            }
            
            .admin-header {
                left: 0;
            }
            
            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php
         include("components/sidebar.php"); 
         include("components/adminHeader.php"); 
        ?>
        <!-- Main Content -->
        <main class="admin-main">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">User Profile</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>

            <!-- Profile Header -->
            <div class="profile-header d-flex align-items-center">
                <div>
                    <img src="#" 
                         alt="Profile Picture" class="profile-picture">
                </div>
                <div class="profile-details">
                    <h2></h2>
                    <p class="text-muted mb-1"><i class="fas fa-envelope me-2"></i> </p>
                    <p class="text-muted mb-1"><i class="fas fa-user-tag me-2"></i> </p>
                    <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i> Member since</p>
                </div>
            </div>

            <!-- Profile Navigation -->
            <div class="profile-nav">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#personal" data-bs-toggle="tab">Personal Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#security" data-bs-toggle="tab">Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#activity" data-bs-toggle="tab">Activity</a>
                    </li>
                </ul>
            </div>

            <!-- Profile Content -->
            <div class="tab-content">
                <!-- Personal Info Tab -->
                <div class="tab-pane fade show active" id="personal">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-card">
                                <h4 class="mb-4">Personal Information</h4>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-card">
                                <h4 class="mb-4">Profile Picture</h4>
                                <form enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Upload New Photo</label>
                                        <input type="file" class="form-control" accept="image/*">
                                    </div>
                                    <div class="alert alert-info">
                                        <small>For best results, use an image at least 300px by 300px in .jpg or .png format</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Photo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="security">
                    <div class="profile-card">
                        <h4 class="mb-4">Change Password</h4>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
                </div>

                <!-- Activity Tab -->
                <div class="tab-pane fade" id="activity">
                    <div class="profile-card">
                        <h4 class="mb-4">Recent Activity</h4>
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Today, 10:45 AM</small>
                                    <span class="badge bg-success">Login</span>
                                </div>
                                <p class="mb-0">Logged in from 192.168.1.1</p>
                            </div>
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Yesterday, 3:20 PM</small>
                                    <span class="badge bg-info">Update</span>
                                </div>
                                <p class="mb-0">Updated pet listing "Max"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
        
        // Initialize Bootstrap tabs
        var tabElms = [].slice.call(document.querySelectorAll('a[data-bs-toggle="tab"]'));
        tabElms.forEach(function(tabEl) {
            new bootstrap.Tab(tabEl);
        });
    </script>
</body>
</html>