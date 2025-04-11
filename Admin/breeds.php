<?php
session_start();
include('../Includes/conn.php');
include('functions/functions.php');

if (!is_logged_in()) {
    header('Location: index.php');
    exit;
}

// Handle Breed Operations
try {
    // Add Breed
    if(isset($_POST['insert-breed'])) {
        $breed_name = filter_var($_POST['breed_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $stmt = $con->prepare("INSERT INTO puppy_breed (breed_name) VALUES (?)");
        $stmt->bind_param("s", $breed_name);
        $stmt->execute();
        
        $_SESSION['success'] = "Breed added successfully";
        header("Location: breeds.php");
        exit;
    }

    // Delete Breed
    if(isset($_GET['delete'])) {
        $breed_id = filter_var($_GET['delete'], FILTER_VALIDATE_INT);
        
        $stmt = $con->prepare("DELETE FROM puppy_breed WHERE breed_id = ?");
        $stmt->bind_param("i", $breed_id);
        $stmt->execute();
        
        $_SESSION['success'] = "Breed deleted successfully";
        header("Location: breeds.php");
        exit;
    }

    // Update Breed
    if(isset($_POST['update-breed'])) {
        $breed_id = filter_var($_POST['breed_id'], FILTER_VALIDATE_INT);
        $breed_name = filter_var($_POST['breed_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $stmt = $con->prepare("UPDATE puppy_breed SET breed_name = ? WHERE breed_id = ?");
        $stmt->bind_param("si", $breed_name, $breed_id);
        $stmt->execute();
        
        $_SESSION['success'] = "Breed updated successfully";
        header("Location: breeds.php");
        exit;
    }
} catch(Exception $e) {
    $_SESSION['error'] = "Operation failed: " . $e->getMessage();
    header("Location: breeds.php");
    exit;
}

// Get all breeds
$breeds = $con->query("SELECT * FROM puppy_breed ORDER BY breed_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breeds Management | PawaPets Admin</title>
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
            background-color: #f8f9fc;
            overflow-x: hidden;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            width: 250px;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            font-weight: 800;
            font-size: 1.2rem;
            text-align: center;
            letter-spacing: 0.05rem;
            z-index: 1;
        }
        
        .sidebar-brand i {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .sidebar-menu {
            padding: 0;
            list-style: none;
        }
        
        .sidebar-menu li {
            position: relative;
            margin-bottom: 0.5rem;
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
            right: 0;
            left: 250px;
            z-index: 999;
        }
        
        #sidebarToggle {
            margin-right: 1rem;
        }
        
        .admin-search {
            flex-grow: 1;
            max-width: 400px;
        }
        
        /* Main Content Styles */
        .admin-main {
            flex: 1;
            padding: 1.5rem;
            margin-top: 56px;
            margin-left: 250px;
            min-height: calc(100vh - 56px);
        }
        
        .admin-card {
            background-color: white;
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
        
        .badge-primary {
            background-color: var(--primary-color);
        }
        
        /* Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Form Styles */
        .form-control, .form-select {
            border-radius: 0.35rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.85rem;
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
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <h3><i class="fas fa-paw me-2"></i> PawaPets Dashboard</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                <li><a href="listed-pets.php"><i class="fas fa-dog me-2"></i> Listed Pets</a></li>
                <li class="active"><a href="breeds.php"><i class="fas fa-dna me-2"></i> Breeds</a></li>
                <li><a href="listed-categories.php"><i class="fas fa-users me-2"></i> Pet Categories</a></li>
                <li><a href="vets.html"><i class="fas fa-stethoscope me-2"></i> Veterinarians</a></li>
                <li><a href="transactions.html"><i class="fas fa-money-bill-wave me-2"></i> Transactions</a></li>
                <li><a href="reports.html"><i class="fas fa-chart-bar me-2"></i> Reports</a></li>
                <li><a href="settings.html"><i class="fas fa-cog me-2"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dna me-2"></i> Breeds Catalog</h5>
                    <div>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBreedModal">
                            <i class="fas fa-plus me-1"></i> Add Breed
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Breed Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($breeds->num_rows > 0): ?>
                                    <?php $count = 1; ?>
                                    <?php while($breed = $breeds->fetch_assoc()): ?>
                                        <tr>
                                            <td>BR-<?= str_pad($count++, 3, '0', STR_PAD_LEFT) ?></td>
                                            <td><?= htmlspecialchars($breed['breed_name']) ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-warning me-1 edit-breed" 
                                                        data-id="<?= $breed['breed_id'] ?>"
                                                        data-name="<?= htmlspecialchars($breed['breed_name']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="breeds.php?delete=<?= $breed['breed_id'] ?>" 
                                                   class="btn btn-sm btn-outline-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this breed?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-4">No breeds found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Breed Modal -->
    <div class="modal fade" id="addBreedModal" tabindex="-1" aria-labelledby="addBreedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBreedModalLabel">Add New Breed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="breedName" class="form-label">Breed Name *</label>
                            <input type="text" class="form-control" name="breed_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="insert-breed">Save Breed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Breed Modal -->
    <div class="modal fade" id="editBreedModal" tabindex="-1" aria-labelledby="editBreedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBreedModalLabel">Edit Breed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="breed_id" id="editBreedId">
                        <div class="mb-3">
                            <label for="editBreedName" class="form-label">Breed Name *</label>
                            <input type="text" class="form-control" name="breed_name" id="editBreedName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="update-breed">Update Breed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Edit Breed Handler
        document.querySelectorAll('.edit-breed').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('editBreedId').value = btn.dataset.id;
                document.getElementById('editBreedName').value = btn.dataset.name;
                new bootstrap.Modal(document.getElementById('editBreedModal')).show();
            });
        });

        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>