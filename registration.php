<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Sign up</title>
</head>
<body>
<a href="index.php" class="btn btn-outline-secondary mb-4 mx-2">
            ← Back to HomePage
        </a>
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
        <h1 class="display-5 mb-4">Join <span class="text-warning">PawaPets</span> Kenya</h1>
        <p class="lead mb-5">Connect with pet lovers across Kenya</p>
        
        <!-- Role Cards -->
        <div class="row g-4">
            <!-- Seller Card -->
            <div class="col-md-6">
            <div class="card role-card h-100 shadow-sm" data-role="seller">
                <div class="card-body p-4">
                <div class="icon-circle bg-warning mb-3 mx-auto">
                    <i class="fas fa-dog fa-2x text-white"></i>
                </div>
                <h3>Seller/Breeder</h3>
                <p class="text-muted">List pets and grow your business</p>
                <button class="continue-btn btn-outline-warning">Continue</button>
                </div>
            </div>
            </div>
            
            <!-- Vet Card -->
            <div class="col-md-6">
            <div class="card role-card h-100 shadow-sm" data-role="vet">
                <div class="card-body p-4">
                <div class="icon-circle bg-success mb-3 mx-auto">
                    <i class="fas fa-stethoscope fa-2x text-white"></i>
                </div>
                <h3>Veterinarian</h3>
                <p class="text-muted">Offer services and get clients</p>
                <button class="continue-btn btn-outline-success">Continue</button>
                </div>
            </div>
            </div>
        </div>
        
        <div class="mt-4">
            <p>Already have an account? <a href="signin.php" class="text-warning">Sign in</a></p>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <!-- Seller Registration Form -->
    <div class="registration-form" id="sellerForm">
        <div class="form-header">
            <h3 class="form-title">Seller Registration</h3>
            <button class="close-btn" onclick="closeForm()">&times;</button>
        </div>
        <div class="form-body">
            <form id="sellerRegistration">
                <div class="mb-3">
                    <label for="sellerName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="sellerName" required>
                </div>
                <div class="mb-3">
                    <label for="sellerEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="sellerEmail" required>
                </div>
                <div class="mb-3">
                    <label for="sellerPhone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="sellerPhone" required>
                </div>
                <div class="mb-3">
                    <label for="sellerBusiness" class="form-label">Business Type</label>
                    <select class="form-control" id="sellerBusiness" required>
                        <option value="">Select business type</option>
                        <option value="individual">Individual Breeder</option>
                        <option value="shop">Pet Shop</option>
                        <option value="rescue">Rescue Organization</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sellerLocation" class="form-label">Location</label>
                    <select class="form-control" id="sellerLocation" required>
                        <option value="">Select your location</option>
                        <option value="nairobi">Nairobi</option>
                        <option value="mombasa">Mombasa</option>
                        <option value="kisumu">Kisumu</option>
                        <option value="nakuru">Nakuru</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sellerPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="sellerPassword" required>
                </div>
                <div class="mb-3">
                    <label for="confirmsellerPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmsellerPassword" required>
                </div>
                <button type="submit" class="btn submit-btn">Register as Seller</button>
            </form>
        </div>
    </div>

    <!-- Vet Registration Form -->
    <div class="registration-form" id="vetForm">
        <div class="form-header">
            <h3 class="form-title">Veterinarian Registration</h3>
            <button class="close-btn" onclick="closeForm()">&times;</button>
        </div>
        <div class="form-body">
            <form id="vetRegistration">
                <div class="mb-3">
                    <label for="vetName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="vetName" required>
                </div>
                <div class="mb-3">
                    <label for="vetEmail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="vetEmail" required>
                </div>
                <div class="mb-3">
                    <label for="vetPhone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="vetPhone" required>
                </div>
                <div class="mb-3">
                    <label for="vetLicense" class="form-label">License Number</label>
                    <input type="text" class="form-control" id="vetLicense" required>
                </div>
                <div class="mb-3">
                    <label for="vetSpecialty" class="form-label">Specialty</label>
                    <select class="form-control" id="vetSpecialty" required>
                        <option value="">Select your specialty</option>
                        <option value="general">General Practice</option>
                        <option value="surgery">Surgery</option>
                        <option value="dermatology">Dermatology</option>
                        <option value="emergency">Emergency Care</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="vetClinic" class="form-label">Clinic/Hospital Name</label>
                    <input type="text" class="form-control" id="vetClinic" required>
                </div>
                <div class="mb-3">
                    <label for="vetPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="vetPassword" required>
                </div>
                <div class="mb-3">
                    <label for="confirmvetPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmvetPassword" required>
                </div>
                <button type="submit" class="btn submit-btn">Register as Veterinarian</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all continue buttons
    const continueButtons = document.querySelectorAll('.continue-btn');
    
    // Add click event to each button
    continueButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the role from parent card
            const card = this.closest('[data-role]');
            const role = card.getAttribute('data-role');
            
            // Show the correct form
            showForm(role);
        });
    });

    // Close button functionality
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', closeForm);
    });

    // Close when clicking outside form
    document.getElementById('modalOverlay').addEventListener('click', closeForm);

    // Close with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeForm();
    });

    // Form submissions
    document.getElementById('sellerRegistration')?.addEventListener('submit', handleSubmit);
    document.getElementById('vetRegistration')?.addEventListener('submit', handleSubmit);
});

function showForm(role) {
    const overlay = document.getElementById('modalOverlay');
    const form = document.getElementById(`${role}Form`);
    
    if (!form) {
        console.error(`Form with ID ${role}Form not found`);
        return;
    }
    
    // Display elements
    overlay.style.display = 'block';
    form.style.display = 'block';
    
    // Trigger animations
    setTimeout(() => {
        overlay.classList.add('modal-active');
        form.classList.add('form-active');
    }, 10);
}

function closeForm() {
    const overlay = document.getElementById('modalOverlay');
    const forms = document.querySelectorAll('.registration-form');
    
    // Start fade out
    overlay.classList.remove('modal-active');
    forms.forEach(form => form.classList.remove('form-active'));
    
    // Hide after animation completes
    setTimeout(() => {
        overlay.style.display = 'none';
        forms.forEach(form => form.style.display = 'none');
    }, 300);
}

function handleSubmit(e) {
    e.preventDefault();
    alert('Form submitted successfully!');
    closeForm();
}
</script>
</body>
</html>