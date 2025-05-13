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

include('../Includes/conn.php');
include('functions/functions.php');
// Check for the cookie on every page load. If the cookie exists, the user is logged in.
// Check if the user is logged in.
if (!is_logged_in()) {
  // The user is not logged in, so redirect them to the login page.
  header('Location: index.php');
  exit;
  $totalPets = 0;
  $activeUsers = 0;
  
  // Get Dashboard Statistics
$totalPets = $con->query("SELECT COUNT(*) FROM puppy_listing")->fetch_row()[0];
$activeUsers = $con->query("SELECT COUNT(*) FROM admin_table")->fetch_row()[0];

// Get Recent Pets
$recentPets = $con->query("
    SELECT p.*, b.breed_name 
    FROM pets p
    LEFT JOIN puppy_breed b ON p.breed_id = b.breed_id
    ORDER BY p.date_listed DESC 
    LIMIT 5
");

// Get Breeds with Listings Count
$breeds = $con->query("
    SELECT b.*, COUNT(p.pet_id) AS listings 
    FROM puppy_breed b
    LEFT JOIN pets p ON b.breed_id = p.breed_id
    GROUP BY b.breed_id
    ORDER BY listings DESC
    LIMIT 5
");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawaPets Admin Dashboard</title>
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
            /* border-bottom: 1px solid rgba(255, 255, 255, 0.1); */
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
            /* font-size: 0.9rem; */
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

        /* Card Styles */
        .admin-card {
            background: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            padding: 1rem 1.35rem;
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0.35rem 0.35rem 0 0 !important;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--dark-color);
        }

        .card-header h5 i {
            color: var(--primary-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Table Styles */
        .admin-table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--dark-color);
            border-collapse: collapse;
        }

        .admin-table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #e3e6f0;
            padding: 0.75rem;
            background-color: #f8f9fc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.65rem;
            letter-spacing: 0.1rem;
        }

        .admin-table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #e3e6f0;
        }

        /* Badge Styles */
        .badge {
            font-weight: 600;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            letter-spacing: 0.1em;
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

        /* Progress Bar Styles */
        .progress {
            height: 5px;
            background-color: #e9ecef;
            border-radius: 0.25rem;
        }

        /* Button Styles */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
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
            <!-- errors -->
              <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <!-- Dashboard Overview -->
            <div class="row mb-4">
                <?php 
                $totalPets = $con->query("SELECT COUNT(*) FROM puppy_listing")->fetch_row()[0];
                $activeUsers = $con->query("SELECT COUNT(*) FROM admin_table")->fetch_row()[0];
                ?>
                <div class="col-md-3">
                    <div class="admin-card h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Total Pets</h6>
                            <h3><?php echo number_format($totalPets) ?></h3>
                            <!-- Consider adding dynamic growth calculation -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card h-100">
                        <div class="card-body">
                            <h6 class="text-muted">Active Users</h6>
                            <h3><?= number_format($activeUsers) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Listed Pets Section -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dog me-2"></i> Recently Listed Pets</h5>
                    <div>
                        <a href="listed-pets.php" class="btn btn-sm btn-outline-primary ms-2">View All</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pet</th>
                                <th>Breed</th>
                                <th>Price</th>
                                <th>Location</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Get Recent Pets
                                $recentPets = $con->query("
                                SELECT p.*, b.breed_name 
                                FROM puppy_listing p
                                LEFT JOIN puppy_breed b ON p.breed_id = b.breed_id
                                ORDER BY p.created_at DESC 
                                LIMIT 5
                                ");
                            ?>
                            <?php if($recentPets->num_rows > 0): ?>
                                <?php while($pet = $recentPets->fetch_assoc()): ?>
                                    <tr>
                                        <td>#PET-<?= str_pad($pet['puppy_name'], 4, '0', STR_PAD_LEFT) ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                               
                                                <?= htmlspecialchars($pet['puppy_name']) ?>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($pet['breed_name']) ?? 'N/A' ?></td>
                                        <td>KES <?= number_format($pet['price']) ?></td>
                                        <td><?= htmlspecialchars($pet['puppy_location']) ?></td>
                                        
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">No recent listings</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>

            <!-- Breeds Management Section -->
            <div class="admin-card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dna me-2"></i> Breeds Catalog</h5>
                    <div>
                        <a href="breeds.php" class="btn btn-sm btn-outline-primary ms-2">View All</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Breed Name</th>
                                <th>Listings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Get Breeds with Listings Count
                                $breeds = $con->query("
                                SELECT b.*, COUNT(p.puppy_id) AS listings 
                                FROM puppy_breed b
                                LEFT JOIN puppy_listing p ON b.breed_id = p.breed_id
                                GROUP BY b.breed_id
                                ORDER BY listings DESC
                                LIMIT 5
                                ");
                            ?>
                            <?php if($breeds->num_rows > 0): ?>
                                <?php while($breed = $breeds->fetch_assoc()): ?>
                                    <tr>
                                        <td>BR-<?= str_pad($breed['breed_id'], 3, '0', STR_PAD_LEFT) ?></td>
                                        <td><?= htmlspecialchars($breed['breed_name']) ?></td>
                                        <td><?= number_format($breed['listings']) ?></td>
                                       
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">No breeds found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Settings Preview -->
            <div class="admin-card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i> Quick Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="approvalToggle" checked>
                                <label class="form-check-label" for="approvalToggle">Require Listing Approval</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="verificationToggle" checked>
                                <label class="form-check-label" for="verificationToggle">Vet Verification</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="maintenanceToggle">
                                <label class="form-check-label" for="maintenanceToggle">Maintenance Mode</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning btn-sm">Save Settings</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Breed Modal -->
    <div class="modal fade" id="addBreedModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Breed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Breed Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option>Dog</option>
                                <option>Cat</option>
                                <option>Bird</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Breed</button>
                </div>
            </div>
        </div>
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
        
        // Simulate data loading
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin dashboard loaded');
            // You would typically fetch data from your API here
        });
    </script>
</body>
</html>