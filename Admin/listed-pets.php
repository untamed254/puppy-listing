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
            --sidebar-width: 250px;
            --header-height: 60px;
            --primary-color: #FFC107;
            --secondary-color: #2C3E50;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        /* Dashboard Layout */
        .admin-container {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            grid-template-rows: var(--header-height) 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            background: var(--secondary-color);
            color: white;
            grid-row: 1 / -1;
            position: fixed;
            width: var(--sidebar-width);
            height: 100vh;
            transition: all 0.3s;
        }
        
        .sidebar-brand {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
        }
        
        .sidebar-menu li {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .sidebar-menu li.active {
            background: rgba(255,193,7,0.2);
            border-left: 3px solid var(--primary-color);
        }
        
        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: block;
        }
        
        /* Header Styles */
        .admin-header {
            grid-column: 2;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        /* Main Content Styles */
        .admin-main {
            grid-column: 2;
            padding: 2rem;
            background: #f5f7fa;
        }
        
        /* Card Styles */
        .admin-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Table Styles */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .admin-table th {
            background: #f8f9fa;
            padding: 0.75rem 1rem;
            text-align: left;
        }
        
        .admin-table td {
            padding: 0.75rem 1rem;
            border-top: 1px solid #eee;
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
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <h3><i class="fas fa-paw me-2"></i> PawaPets Dashboard</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                <li class="active"><a href="pets.html"><i class="fas fa-dog me-2"></i> Listed Pets</a></li>
                <li><a href="breeds.html"><i class="fas fa-dna me-2"></i> Breeds</a></li>
                <li><a href="users.html"><i class="fas fa-users me-2"></i> Users</a></li>
                <li><a href="vets.html"><i class="fas fa-stethoscope me-2"></i> Veterinarians</a></li>
                <li><a href="transactions.html"><i class="fas fa-money-bill-wave me-2"></i> Transactions</a></li>
                <li><a href="reports.html"><i class="fas fa-chart-bar me-2"></i> Reports</a></li>
                <li><a href="settings.html"><i class="fas fa-cog me-2"></i> Settings</a></li>
            </ul>
        </aside>

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
                        <i class="fas fa-user-circle me-1"></i> Admin User
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#profile"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#settings"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 mb-0"><i class="fas fa-dog me-2"></i> Listed Pets</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPetModal">
                    <i class="fas fa-plus me-2"></i> Add Pet
                </button>
            </div>
            
            <!-- Filters Row -->
            <div class="admin-card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <select class="form-select">
                                <option selected>All Breeds</option>
                                <option>German Shepherd</option>
                                <option>Boerboel</option>
                                <option>Golden Retriever</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option selected>All Locations</option>
                                <option>Nairobi</option>
                                <option>Mombasa</option>
                                <option>Kisumu</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search pets...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pets Table -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0">All Pets (124)</h5>
                    <div class="d-flex align-items-center">
                        <span class="me-3 text-muted">Export:</span>
                        <button class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-file-excel me-1"></i> Excel
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-file-pdf me-1"></i> PDF
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pet</th>
                                <th>Breed</th>
                                <th>Age</th>
                                <th>Location</th>
                                <th>Seller</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Pet 1 -->
                            <tr>
                                <td>#PET-1001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="Images/stock1.jpg" class="pet-image-thumb me-3">
                                        <div>
                                            <strong>Max</strong>
                                            <div class="text-muted small">KES 25,000</div>
                                        </div>
                                    </div>
                                </td>
                                <td>German Shepherd</td>
                                <td>3 months</td>
                                <td>Nairobi</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>John M.</span>
                                        <small class="text-muted">+254 712 345 678</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary action-btn" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger action-btn" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Pet 2 -->
                            <tr>
                                <td>#PET-1002</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="Images/stock2.jpg" class="pet-image-thumb me-3">
                                        <div>
                                            <strong>Bella</strong>
                                            <div class="text-muted small">KES 30,000</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Golden Retriever</td>
                                <td>2 months</td>
                                <td>Mombasa</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>Sarah K.</span>
                                        <small class="text-muted">+254 723 456 789</small>
                                    </div>
                                </td>
                                <td>
                                <button class="btn btn-sm btn-outline-primary action-btn" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger action-btn" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                </td>
                            </tr>
                            
                            <!-- Pet 3 -->
                            <tr>
                                <td>#PET-1003</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="Images/stock3.jpg" class="pet-image-thumb me-3">
                                        <div>
                                            <strong>Rocky</strong>
                                            <div class="text-muted small">KES 18,000</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Boerboel</td>
                                <td>4 months</td>
                                <td>Kisumu</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>David O.</span>
                                        <small class="text-muted">+254 734 567 890</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary action-btn" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning action-btn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger action-btn" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Additional pet rows would go here -->
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">Showing 1 to 10 of 124 entries</div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Pet Modal -->
    <div class="modal fade" id="addPetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Pet Listing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Pet Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Breed</label>
                                <select class="form-select" required>
                                    <option value="">Select Breed</option>
                                    <option>German Shepherd</option>
                                    <option>Boerboel</option>
                                    <option>Golden Retriever</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" min="0">
                                    <select class="form-select" style="max-width: 100px;">
                                        <option>months</option>
                                        <option>years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price (KES)</label>
                                <input type="number" class="form-control" min="0" step="1000">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select class="form-select">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Location</label>
                                <select class="form-select" required>
                                    <option value="">Select Location</option>
                                    <option>Nairobi</option>
                                    <option>Mombasa</option>
                                    <option>Kisumu</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Seller</label>
                                <select class="form-select" required>
                                    <option value="">Select Seller</option>
                                    <option>John M. (+254712345678)</option>
                                    <option>Sarah K. (+254723456789)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Upload Images</label>
                                <div class="border rounded p-3 text-center">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-2">Drag & drop images here or click to browse</p>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        Select Files
                                    </button>
                                </div>
                                <small class="text-muted">Upload at least 3 clear photos (max 5MB each)</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Pet Listing</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
        
        // Example of dynamic actions
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.title;
                const petId = this.closest('tr').querySelector('td:first-child').textContent;
                console.log(`${action} clicked for ${petId}`);
                
                // In a real app, you would call API endpoints here
                if (action === 'View') {
                    // Open view modal
                } else if (action === 'Approve') {
                    // Approve pet listing
                }
            });
        });
    </script>
</body>
</html>