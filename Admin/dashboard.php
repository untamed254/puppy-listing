<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawaPets Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <h3><i class="fas fa-paw me-2"></i> PawaPets Dashboard</h3>
            </div>
            <ul class="sidebar-menu">
                <li class="active"><a href="#dashboard"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                <li><a href="listed-pets.php"><i class="fas fa-dog me-2"></i> Listed Pets</a></li>
                <li><a href="#breeds"><i class="fas fa-dna me-2"></i> Breeds</a></li>
                <li><a href="#users"><i class="fas fa-users me-2"></i> Users</a></li>
                <li><a href="#vets"><i class="fas fa-stethoscope me-2"></i> Veterinarians</a></li>
                <li><a href="#transactions"><i class="fas fa-money-bill-wave me-2"></i> Transactions</a></li>
                <li><a href="#reports"><i class="fas fa-chart-bar me-2"></i> Reports</a></li>
                <li><a href="#settings"><i class="fas fa-cog me-2"></i> Settings</a></li>
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
            <!-- Dashboard Overview -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="admin-card">
                        <div class="card-body">
                            <h6 class="text-muted">Total Pets</h6>
                            <h3>1,248</h3>
                            <small class="text-success"><i class="fas fa-arrow-up me-1"></i> 12% from last month</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card">
                        <div class="card-body">
                            <h6 class="text-muted">Active Users</h6>
                            <h3>3,542</h3>
                            <small class="text-success"><i class="fas fa-arrow-up me-1"></i> 8% from last month</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card">
                        <div class="card-body">
                            <h6 class="text-muted">Veterinarians</h6>
                            <h3>187</h3>
                            <small class="text-success"><i class="fas fa-arrow-up me-1"></i> 5 new this week</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card">
                        <div class="card-body">
                            <h6 class="text-muted">Revenue</h6>
                            <h3>KES 1.2M</h3>
                            <small class="text-danger"><i class="fas fa-arrow-down me-1"></i> 3% from last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Listed Pets Section -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dog me-2"></i> Recently Listed Pets</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBreedModal">
                        <i class="fas fa-plus me-1"></i> Add Pet
                    </button>
                    <a href="#view-all" class="btn btn-sm btn-outline-primary">View All</a>
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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#PET-1001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="Images/stock1.jpg" width="40" height="40" class="rounded-circle me-2">
                                        Max
                                    </div>
                                </td>
                                <td>German Shepherd</td>
                                <td>KES 25,000</td>
                                <td>Nairobi</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- More pet rows... -->
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Breeds Management Section -->
            <div class="admin-card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dna me-2"></i> Breeds Catalog</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBreedModal">
                        <i class="fas fa-plus me-1"></i> Add Breed
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Breed Name</th>
                                <th>Category</th>
                                <th>Popularity</th>
                                <th>Listings</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#BR-001</td>
                                <td>German Shepherd</td>
                                <td>Dog</td>
                                <td>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                    <small>85%</small>
                                </td>
                                <td>142</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- More breed rows... -->
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
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
        });
        
        // Simulate data loading
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin dashboard loaded');
            // You would typically fetch data from your API here
        });
    </script>
</body>
</html>