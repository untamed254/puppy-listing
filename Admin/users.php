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

if (!is_logged_in()) {
    header('Location: index.php');
    exit;
}
if(isset($_POST['add_user'])) {
    $user_username = $_POST['username'];
    $user_email = $_POST['admin_email']; 
    $user_password = $_POST['password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $confirmPassword = $_POST['confirmPassword'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    
    // Select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$user_username' OR admin_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    
    if($row_count > 0) {
        echo "<script>alert('A User with this Name or Email already exists!')</script>";
    } elseif($user_password != $confirmPassword) {
        echo "<script>alert('Passwords do not match!')</script>";
    } else {
        // Insert Query
        move_uploaded_file($user_image_tmp, "adminImages/$user_image"); 
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_image, admin_password) VALUES ('$user_username', '$user_email', '$user_image', '$hash_password')";
        $sqlExecute = mysqli_query($con, $insert_query);
        
        if($sqlExecute) {
            echo "<script>alert('Registration successful! You can now login.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Registration failed! Please try again.')</script>";
        }
    }
}

// Get search parameter
$searchTerm = $_GET['search'] ?? '';

// Base query
$userQuery = "SELECT * FROM admin_table";

// Add search condition if term exists
if (!empty($searchTerm)) {
    $userQuery .= " WHERE admin_name LIKE ? OR admin_email LIKE ?";
    $stmt = $con->prepare($userQuery);
    $searchParam = "%$searchTerm%";
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $users = $stmt->get_result();
} else {
    // Default query without search
    $users = $con->query($userQuery . " ORDER BY admin_name ASC");
}

// Get all users
$users = $con->query("SELECT * FROM admin_table ");

// Delete User
if(isset($_GET['delete'])) {
    $admin_id = filter_var($_GET['delete'], FILTER_VALIDATE_INT);
    
    try {
        $stmt = $con->prepare("DELETE FROM admin_table WHERE admin_id = ?");
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        
        $_SESSION['success'] = "User deleted successfully";
        header("Location: users.php");
        exit;
    } catch(Exception $e) {
        $_SESSION['error'] = "Delete failed: " . $e->getMessage();
        header("Location: users.php");
        exit;
    }
}
// Update User
if(isset($_POST['update_user'])) {
    $admin_id = filter_var($_POST['admin_id'], FILTER_VALIDATE_INT);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['admin_email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $image = $_FILES['user_image']['name'];
    $image_tmp = $_FILES['user_image']['tmp_name'];

    try {
        // Base query and parameters
        $query = "UPDATE admin_table SET admin_name = ?, admin_email = ?";
        $types = "ss";
        $params = [$username, $email];

        // Add password if provided
        if(!empty($password)) {
            $query .= ", admin_password = ?";
            $types .= "s";
            $params[] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Add image if provided
        if(!empty($image)) {
            move_uploaded_file($image_tmp, "adminImages/$image");
            $query .= ", admin_image = ?";
            $types .= "s";
            $params[] = $image;
        }

        // Add WHERE clause
        $query .= " WHERE admin_id = ?";
        $types .= "i";
        $params[] = $admin_id;

        // Prepare and execute
        $stmt = $con->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        $_SESSION['success'] = "User updated successfully";
        header("Location: users.php");
        exit;
        
    } catch(Exception $e) {
        $_SESSION['error'] = "Update failed: " . $e->getMessage();
        header("Location: users.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | PawaPets Admin</title>
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
    <?php
         include("components/sidebar.php"); 
         include("components/adminHeader.php"); 
        ?>

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
                <h5 class="mb-0"><i class="fas fa-users me-2"></i> Users 
                    <?php if(!empty($searchTerm)): ?>
                        <span class="text-muted fs-6">(<?= $users->num_rows ?> results found)</span>
                    <?php endif; ?>
                </h5>
                <div>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBreedModal">
                        <i class="fas fa-plus me-1"></i> Add User
                    </button>
                </div>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php if($users->num_rows > 0): ?>
                                        <?php $count = 1; ?>
                                        <?php while($user = $users->fetch_assoc()): ?>
                                            <tr>
                                                <td>ADM-<?= str_pad($count++, 3, '0', STR_PAD_LEFT) ?></td>
                                                <td><?= htmlspecialchars($user['admin_name']) ?></td>
                                                <td><?= htmlspecialchars($user['admin_email']) ?></td>
                                                <td>
                                                <button class="btn btn-sm btn-outline-warning me-1 edit-user" 
                                                data-id="<?= $user['admin_id'] ?>"
                                                data-name="<?= htmlspecialchars($user['admin_name']) ?>"
                                                data-email="<?= htmlspecialchars($user['admin_email']) ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                                    <a href="users.php?delete=<?= $user['admin_id'] ?>" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Delete this user?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4">No users found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add user Modal -->
    <div class="modal fade" id="addBreedModal" tabindex="-1" aria-labelledby="addBreedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBreedModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="breedName" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="breedName" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="admin_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="breedName" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="breedName" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="breedName" class="form-label">Profile Picture <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="user_image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="add_user">Add user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Breed Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="admin_id" id="editAdminId">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="admin_email" id="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="user_image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="update_user">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Edit User Handler
    document.querySelectorAll('.edit-user').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('editAdminId').value = btn.dataset.id;
            document.getElementById('editUsername').value = btn.dataset.name;
            document.getElementById('editEmail').value = btn.dataset.email;
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
    });

    // Toggle sidebar
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('.admin-sidebar').classList.toggle('show');
    });
</script>
</body>
</html>