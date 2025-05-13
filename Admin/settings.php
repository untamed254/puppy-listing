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
    <title>Settings | PawaPets Admin</title>
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
            transition: transform 0.3s ease-in-out;
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
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .admin-header {
                left: 0 !important;
            }
            
            .admin-main {
                margin-left: 0 !important;
            }
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

        /* Settings Specific Styles */
        .settings-card {
            background-color: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .settings-section {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 1.5rem;
        }

        .settings-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .settings-section-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .settings-section-title i {
            margin-right: 0.75rem;
            color: var(--primary-color);
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
    <div class="sidebar-overlay"></div>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php
         include("components/sidebar.php"); 
         include("components/adminHeader.php"); 
        ?>
        <!-- Main Content -->
        <main class="admin-main">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0"><i class="fas fa-cog me-2"></i> System Settings</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            </div>

            <!-- General Settings -->
            <div class="settings-card">
                <div class="settings-section">
                    <h3 class="settings-section-title"><i class="fas fa-sliders-h"></i> General Settings</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" class="form-control" value="PawaPets">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Site Logo</label>
                                <input type="file" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Default Currency</label>
                                <select class="form-select">
                                    <option>KES - Kenyan Shilling</option>
                                    <option>USD - US Dollar</option>
                                    <option>EUR - Euro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Timezone</label>
                                <select class="form-select">
                                    <option>Africa/Nairobi (EAT)</option>
                                    <option>UTC</option>
                                    <option>Other timezones...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="maintenanceMode" checked>
                        <label class="form-check-label" for="maintenanceMode">Maintenance Mode</label>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="settings-section">
                    <h3 class="settings-section-title"><i class="fas fa-shield-alt"></i> Security Settings</h3>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="twoFactorAuth" checked>
                        <label class="form-check-label" for="twoFactorAuth">Enable Two-Factor Authentication</label>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="passwordComplexity">
                        <label class="form-check-label" for="passwordComplexity">Require Strong Passwords</label>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="loginAttempts" checked>
                        <label class="form-check-label" for="loginAttempts">Limit Login Attempts</label>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Session Timeout (minutes)</label>
                        <input type="number" class="form-control" value="30" min="5" max="1440">
                    </div>
                </div>

                <!-- Email Settings -->
                <div class="settings-section">
                    <h3 class="settings-section-title"><i class="fas fa-envelope"></i> Email Settings</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">SMTP Host</label>
                                <input type="text" class="form-control" value="smtp.example.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">SMTP Port</label>
                                <input type="number" class="form-control" value="587">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">SMTP Username</label>
                                <input type="text" class="form-control" value="admin@example.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">SMTP Password</label>
                                <input type="password" class="form-control" value="password">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="smtpEncryption" checked>
                        <label class="form-check-label" for="smtpEncryption">Use SSL/TLS Encryption</label>
                    </div>
                </div>

                <!-- Payment Settings -->
                <div class="settings-section">
                    <h3 class="settings-section-title"><i class="fas fa-credit-card"></i> Payment Settings</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Payment Gateway</label>
                                <select class="form-select">
                                    <option>M-Pesa</option>
                                    <option>PayPal</option>
                                    <option>Stripe</option>
                                    <option>Manual Payment</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Transaction Fee (%)</label>
                                <input type="number" class="form-control" value="2.5" step="0.1" min="0" max="20">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">M-Pesa Paybill Number</label>
                        <input type="text" class="form-control" value="123456">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">M-Pesa Account Number</label>
                        <input type="text" class="form-control" value="PAWAPETS">
                    </div>
                </div>

                <!-- Save Button -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-primary">Save Settings</button>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar with overlay
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.admin-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        // Close sidebar when clicking overlay
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            this.classList.remove('show');
            document.querySelector('.admin-sidebar').classList.remove('show');
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>