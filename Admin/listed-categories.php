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

if(isset($_POST['insert-category'])) {
    // Sanitize and validate input
    $cat_title = filter_var($_POST['category_title'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if(empty(trim($cat_title))) {
        echo "<script>alert('Category name cannot be empty')</script>";
        exit;
    }

    try {
        // Check for existing category
        $stmt = $con->prepare("SELECT category_title FROM pet_category WHERE category_title = ?");
        $stmt->bind_param("s", $cat_title);
        $stmt->execute();
        
        if($stmt->get_result()->num_rows > 0) {
            echo "<script>alert('This category already exists')</script>";
        } else {
            // Insert new category
            $insert_stmt = $con->prepare("INSERT INTO pet_category (category_title) VALUES (?)");
            $insert_stmt->bind_param("s", $cat_title);
            
            if($insert_stmt->execute()) {
                echo "<script>
                    alert('Category added successfully');
                    window.location.reload();
                </script>";
            }
        }
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        echo "<script>alert('Operation failed. Please try again.')</script>";
    }
}

if(isset($_POST['update-category'])) {
    $cat_id = $_POST['cat_id'];
    $new_title = $_POST['category_title'];
    
    $stmt = $con->prepare("UPDATE pet_category SET category_title = ? WHERE category_id = ?");
    $stmt->bind_param("si", $new_title, $cat_id);
    $stmt->execute();
    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
// Handle category operations
if(isset($_GET['delete'])) {
    $cat_id = $_GET['delete'];
    $delete_stmt = $con->prepare("DELETE FROM pet_category WHERE category_id = ?");
    $delete_stmt->bind_param("i", $cat_id);
    $delete_stmt->execute();
}

// Get all categories
$categories = $con->query("SELECT * FROM pet_category ORDER BY category_title ASC");
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
        <!-- sidebar -->
    <?php
         include("components/sidebar.php"); 
         include("components/adminHeader.php"); 
    ?>
        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dna me-2"></i> Pet Categories</h5>
                    <div>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBreedModal">
                            <i class="fas fa-plus me-1"></i> Add Category
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                while($row = $categories->fetch_assoc()):
                                    $count++;
                                ?>
                                <tr class='text-center'>
                                    <td><?= $count ?></td>
                                    <td><?= htmlspecialchars($row['category_title']) ?></td>
                                    <td>
                                    <button class="btn btn-sm btn-outline-warning edit-category" 
                                                data-id="<?= $row['category_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['category_title']) ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="?delete=<?= $row['category_id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Add Category Modal -->
<div class="modal fade" id="addBreedModal" tabindex="-1" aria-labelledby="addBreedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="breedForm" action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBreedModalLabel">Add New Pet category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="breedName" class="form-label">Pet Category Name *</label>
                                <input type="text" class="form-control" id="breedName" 
                                       name="category_title" required> <!-- Fixed name attribute -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="insert-category">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- Edit Category Modal -->
 <div class="modal fade" id="editCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="cat_id" id="editCatId">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_title" id="editCatName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="update-category">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Edit Category Handler
    document.querySelectorAll('.edit-category').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('editCatId').value = btn.dataset.id;
            document.getElementById('editCatName').value = btn.dataset.name;
            new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
        });
    });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Search functionality
        document.getElementById('searchBtn').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value;
            console.log('Searching for:', searchTerm);
            // In a real application, this would filter the table
        });
        
        // Filter functionality
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const category = this.value;
            console.log('Filtering by category:', category);
            // In a real application, this would filter the table
        });
        
        document.getElementById('statusFilter').addEventListener('change', function() {
            const status = this.value;
            console.log('Filtering by status:', status);
            // In a real application, this would filter the table
        });
    </script>
</body>
</html>