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

// Handle Pet Operations
try {
    // Add Pet
    if(isset($_POST['insert-pet'])) {
        // Validate required fields
        $required = ['puppy_name', 'category_id', 'breed_id', 'age', 'price', 'location'];
        foreach($required as $field) {
            if(empty($_POST[$field])) {
                $_SESSION['error'] = "All required fields must be filled!";
                header("Location: listed-pets.php");
                exit;
            }
        }
    
        // Get and sanitize inputs
        $puppy_name = filter_var($_POST['puppy_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category_id = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
        $breed_id = filter_var($_POST['breed_id'], FILTER_VALIDATE_INT);
        $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        // Validate critical fields
        if(!$puppy_name || strlen($puppy_name) > 100) {
            $_SESSION['error'] = "Invalid pet name (1-100 characters)";
            header("Location: listed-pets.php");
            exit;
        }
    
        // Proceed with database insertion
        $stmt = $con->prepare("INSERT INTO puppy_listing 
        (category_id, breed_id, puppy_name, puppy_age, price, puppy_location, puppy_desc)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("iisidss", 
        $category_id,
        $breed_id,
        $puppy_name,
        $age,
        $price,
        $location,
        $description
    );
    
    $stmt->execute(); // Execute the insert query
    $pet_id = $con->insert_id; // Get the auto-generated puppy_id
    
    // Handle image uploads
    if (!empty($_FILES['pet_images']['name'][0])) {
        $upload_dir = '../uploads/pets/';
        
        foreach ($_FILES['pet_images']['tmp_name'] as $key => $tmp_name) {
            $file_name = uniqid() . '_' . basename($_FILES['pet_images']['name'][$key]);
            $target_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($tmp_name, $target_path)) {
                $img_stmt = $con->prepare("INSERT INTO pet_images (puppy_id, image_url) VALUES (?, ?)");
                $img_stmt->bind_param("is", $pet_id, $target_path);
                $img_stmt->execute();
            }
        }
    }
    
    $_SESSION['success'] = "Pet added successfully";
    header("Location: listed-pets.php");
    exit;
    }

} 
catch(Exception $e) {
    $_SESSION['error'] = "Operation failed: " . $e->getMessage();
    header("Location: listed-pets.php");
    exit;
}
 // Update Pet
 if(isset($_POST['update-pet'])) {
    $pet_id = filter_var($_POST['pet_id'], FILTER_VALIDATE_INT);
    
    // Validate and sanitize inputs (same as insert)
    $required = ['puppy_name', 'category_id', 'breed_id', 'age', 'price', 'location'];
    foreach($required as $field) {
        if(empty($_POST[$field])) {
            $_SESSION['error'] = "All required fields must be filled!";
            header("Location: listed-pets.php");
            exit;
        }
    }

    $puppy_name = filter_var($_POST['puppy_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
    $breed_id = filter_var($_POST['breed_id'], FILTER_VALIDATE_INT);
    $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
    $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    try {
        $stmt = $con->prepare("UPDATE puppy_listing SET 
            category_id = ?, breed_id = ?, puppy_name = ?, puppy_age = ?, 
            price = ?, puppy_location = ?, puppy_desc = ?
            WHERE puppy_id = ?");
        
        $stmt->bind_param("iisidssi", $category_id, $breed_id, $puppy_name, 
            $age, $price, $location, $description, $pet_id);
        $stmt->execute();

        $_SESSION['success'] = "Pet updated successfully";
    } catch(Exception $e) {
        $_SESSION['error'] = "Update failed: " . $e->getMessage();
    }
    header("Location: listed-pets.php");
    exit;
}

// Delete Pet
if(isset($_POST['delete'])) {
    $pet_id = filter_var($_POST['pet_id'], FILTER_VALIDATE_INT);
    
    // Delete images
    $stmt = $con->prepare("DELETE FROM pet_images WHERE puppy_id = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();

    // Delete main record
    $stmt = $con->prepare("DELETE FROM puppy_listing WHERE puppy_id = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();

    $_SESSION['success'] = "Pet deleted successfully";
    header("Location: listed-pets.php");
    exit;
}

// Get search parameters
$search = $_GET['search'] ?? null;
$location = $_GET['location'] ?? null;
$age = $_GET['age'] ?? null; // You can add age filter if needed

// Get filtered pets
$pets = searchPets($search, $age, $location);

// Get breeds for dropdown
$breeds = $con->query("SELECT * FROM puppy_breed ORDER BY breed_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listed Pets - PawaPets Admin</title>
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
        
        /* Pet Specific Styles */
        .pet-image-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .status-badge {
            padding: 0.35rem 0.65rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .admin-container {
                grid-template-columns: 1fr;
            }
            
            .admin-sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }
            
            .admin-sidebar.show {
                transform: translateX(0);
            }
            
            .admin-header, .admin-main {
                grid-column: 1;
            }
        }
        
        @media (max-width: 768px) {
            .pet-image-thumb {
                width: 50px;
                height: 50px;
            }
            
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
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

            <!-- Pets Table -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">All Pets</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPetModal">
                        <i class="fas fa-plus me-2"></i> Add Pet
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="admin-table table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>

                                <th>Pet</th>
                                <th>Breed</th>
                                <th>Age</th>
                                <th>Price</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php while($pet = $pets->fetch_assoc()): 
                                $images = explode(',', $pet['images']);
                            ?>
                            <tr>
                                <td>#PET-<?= $pet['puppy_id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if(!empty($images[0])): ?>
                                            <img src="<?= $images[0] ?>" class="pet-image-thumb me-3">
                                        <?php endif; ?>
                                        <div>
                                            <strong><?= htmlspecialchars($pet['puppy_name']) ?></strong>
                                            <div class="text-muted small"><?= $pet['puppy_desc'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $pet['breed_name'] ?></td>
                                <td><?= $pet['puppy_age'] ?> months</td>
                                <td>KES <?= number_format($pet['price']) ?></td>
                                <td><?= $pet['puppy_location'] ?></td>
                                <td>
                                <div class="d-flex gap-2">
        <button class="btn btn-sm btn-outline-warning action-btn edit-btn" 
                data-bs-toggle="modal" data-bs-target="#editPetModal"
                data-pet-id="<?= $pet['puppy_id'] ?>"
                data-pet-name="<?= htmlspecialchars($pet['puppy_name']) ?>"
                data-category-id="<?= $pet['category_id'] ?>"
                data-breed-id="<?= $pet['breed_id'] ?>"
                data-age="<?= $pet['puppy_age'] ?>"
                data-price="<?= $pet['price'] ?>"
                data-location="<?= htmlspecialchars($pet['puppy_location']) ?>"
                data-description="<?= htmlspecialchars($pet['puppy_desc']) ?>">
            <i class="fas fa-edit"></i>
        </button>
        
        <button class="btn btn-sm btn-outline-danger action-btn delete-btn" 
                data-bs-toggle="modal" data-bs-target="#deleteModal"
                data-pet-id="<?= $pet['puppy_id'] ?>">
            <i class="fas fa-trash"></i>
        </button>
    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Pet Modal -->
    <div class="modal fade" id="addPetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Pet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Pet Name</label>
                                <input type="text" name="puppy_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <?php 
                                    $categories = $con->query("SELECT * FROM pet_category");
                                    while($cat = $categories->fetch_assoc()):
                                    ?>
                                    <option value="<?= $cat['category_id'] ?>"><?= $cat['category_title'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                    <label class="form-label">Breed</label>
                                    <select name="breed_id" class="form-select" required>
                                        <option value="">Select Breed</option>
                                        <?php 
                                        $breeds = $con->query("SELECT * FROM puppy_breed");
                                        while($breed = $breeds->fetch_assoc()):
                                        ?>
                                        <option value="<?= $breed['breed_id'] ?>"><?= $breed['breed_name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            <div class="col-md-4">
                                <label class="form-label">Age (months)</label>
                                <input type="number" name="age" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price (KES)</label>
                                <input type="number" name="price" class="form-control" min="0" step="1000" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Upload Images</label>
                                <input type="file" name="pet_images[]" multiple accept="image/*" class="form-control">
                                <small class="text-muted">Select multiple images (JPEG, PNG, max 5MB each)</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="insert-pet" class="btn btn-primary">Save Pet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!-- Edit Pet Modal -->
     <div class="modal fade" id="editPetModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="pet_id" id="edit_pet_id">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Pet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Pet Name</label>
                                <input type="text" name="puppy_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <?php 
                                    $categories = $con->query("SELECT * FROM pet_category");
                                    while($cat = $categories->fetch_assoc()):
                                    ?>
                                    <option value="<?= $cat['category_id'] ?>"><?= $cat['category_title'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                    <label class="form-label">Breed</label>
                                    <select name="breed_id" class="form-select" required>
                                        <option value="">Select Breed</option>
                                        <?php 
                                        $breeds = $con->query("SELECT * FROM puppy_breed");
                                        while($breed = $breeds->fetch_assoc()):
                                        ?>
                                        <option value="<?= $breed['breed_id'] ?>"><?= $breed['breed_name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            <div class="col-md-4">
                                <label class="form-label">Age (months)</label>
                                <input type="number" name="age" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price (KES)</label>
                                <input type="number" name="price" class="form-control" min="0" step="1000" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Upload Images</label>
                                <input type="file" name="pet_images[]" multiple accept="image/*" class="form-control">
                                <small class="text-muted">Select multiple images (JPEG, PNG, max 5MB each)</small>
                            </div>
                        </div>
                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="update-pet" class="btn btn-primary">Update Pet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST">
                            <input type="hidden" name="pet_id" id="delete_pet_id">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this pet? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="delete" class="btn btn-danger">Delete Pet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Edit Modal Handler
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const petId = this.dataset.petId;
            document.getElementById('edit_pet_id').value = petId;
            document.getElementById('edit_puppy_name').value = this.dataset.petName;
            document.querySelector('#editPetModal select[name="category_id"]').value = this.dataset.categoryId;
            document.querySelector('#editPetModal select[name="breed_id"]').value = this.dataset.breedId;
            document.querySelector('#editPetModal input[name="age"]').value = this.dataset.age;
            document.querySelector('#editPetModal input[name="price"]').value = this.dataset.price;
            document.querySelector('#editPetModal input[name="location"]').value = this.dataset.location;
            document.querySelector('#editPetModal textarea[name="description"]').value = this.dataset.description;
        });
    });

    // Delete Modal Handler
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('delete_pet_id').value = this.dataset.petId;
        });
    });
</script>
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>