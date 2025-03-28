<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawaPets Kenya - Find Your Perfect Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Hero Section -->
<section class="hero-section text-white">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 text-center">
                <h1 class="display-4 mb-4">Find Your Perfect Pet in Kenya</h1>
                <h2 class="display-4 mb-4">with <span class="text-warning">PawaPets</span></h2>
                
                <!-- Primary CTA Buttons -->
                <div class="d-flex justify-content-center gap-3 mb-4">
                    <a href="listing.php" class="btn btn-warning btn-lg px-4">
                        <i class="fas fa-paw"></i> Browse Pets
                    </a>
                    <a href="registration.php" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="search-bar bg-white p-3 rounded">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by breed...">
                        <select class="form-select" style="max-width: 150px;">
                            <option>Location</option>
                            <option>Nairobi</option>
                            <option>Mombasa</option>
                            <option>Kisumu</option>
                        </select>
                        <select class="form-select" style="max-width: 120px;">
                            <option>Age</option>
                            <option>Puppy</option>
                            <option>Adult</option>
                        </select>
                        <button class="btn btn-warning">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>

                <!-- Secondary Links -->
                <div class="mt-4">
                    <a href="#hiw" class="text-white me-3">
                        <i class="fas fa-play-circle"></i> How It Works
                    </a>
                    <a href="#vets" class="text-white">
                        <i class="fas fa-stethoscope"></i> Find Vets
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Pets Section -->
<section class="featured-pets py-5 bg-light">
  <div class="container">
    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2 class="section-title">Featured Pets</h2>
      <a href="listing.php" class="btn btn-outline-warning">View All <i class="fas fa-arrow-right ms-2"></i></a>
    </div>

    <div class="row g-4">
      <!-- Pet Card 1 -->
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card pet-card h-100 border-0 shadow-sm">
          <div class="position-relative">
            <img src="Images/stock1.jpg" class="card-img-top pet-image" alt="German Shepherd">
            <span class="badge bg-warning position-absolute top-0 start-0 m-2">Popular</span>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title mb-0">Max</h5>
              <h5 class="text-warning mb-0">KES 25,000</h5>
            </div>
            <div class="pet-meta d-flex flex-wrap gap-2 mb-3">
              <span class="text-muted"><i class="fas fa-paw me-1"></i> German Shepherd</span>
              <span class="text-muted"><i class="fas fa-birthday-cake me-1"></i> 3 months</span>
              <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> Nairobi</span>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-outline-primary btn-sm quick-view-btn">Quick View</button>
              <button class="btn btn-warning btn-sm"><i class="bi bi-whatsapp"> </i>Contact Seller</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pet Card 2 -->
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card pet-card h-100 border-0 shadow-sm">
          <div class="position-relative">
            <img src="Images/stock1.jpg" class="card-img-top pet-image" alt="German Shepherd">
            <span class="badge bg-success position-absolute top-0 start-0 m-2">New</span>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title mb-0">Bella</h5>
              <h5 class="text-warning mb-0">KES 30,000</h5>
            </div>
            <div class="pet-meta d-flex flex-wrap gap-2 mb-3">
              <span class="text-muted"><i class="fas fa-paw me-1"></i> Golden Retriever</span>
              <span class="text-muted"><i class="fas fa-birthday-cake me-1"></i> 2 months</span>
              <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> Mombasa</span>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-outline-primary btn-sm quick-view-btn">Quick View</button>
              <button class="btn btn-warning btn-sm">Contact Seller</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pet Card 3 -->
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card pet-card h-100 border-0 shadow-sm">
          <div class="position-relative">
            <img src="Images/stock1.jpg" class="card-img-top pet-image" alt="German Shepherd">
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title mb-0">Rocky</h5>
              <h5 class="text-warning mb-0">KES 18,000</h5>
            </div>
            <div class="pet-meta d-flex flex-wrap gap-2 mb-3">
              <span class="text-muted"><i class="fas fa-paw me-1"></i> Boerboel</span>
              <span class="text-muted"><i class="fas fa-birthday-cake me-1"></i> 4 months</span>
              <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> Kisumu</span>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-outline-primary btn-sm quick-view-btn">Quick View</button>
              <button class="btn btn-warning btn-sm">Contact Seller</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pet Card 4 -->
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card pet-card h-100 border-0 shadow-sm">
          <div class="position-relative">
            <img src="Images/stock1.jpg" class="card-img-top pet-image" alt="German Shepherd">
            <span class="badge bg-danger position-absolute top-0 start-0 m-2">-15%</span>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title mb-0">Luna</h5>
              <div>
                <span class="text-warning">KES 29,750</span>
              </div>
            </div>
            <div class="pet-meta d-flex flex-wrap gap-2 mb-3">
              <span class="text-muted"><i class="fas fa-paw me-1"></i> Husky</span>
              <span class="text-muted"><i class="fas fa-birthday-cake me-1"></i> 5 months</span>
              <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> Nakuru</span>
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-outline-primary btn-sm quick-view-btn">Quick View</button>
              <button class="btn btn-warning btn-sm">Contact Seller</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works py-5" id="hiw">
    <div class="container">
        <h2 class="text-center mb-5 text-light">How PawaPets Works</h2>
        
        <!-- Role Selector Tabs -->
        <div class="role-tabs mb-5">
            <ul class="nav nav-pills justify-content-center gap-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#buyers-tab">
                        <i class="fas fa-shopping-cart me-2 text-light"></i><strong class="text-light">Buyers</strong>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#sellers-tab">
                        <i class="fas fa-bullhorn me-2 text-light"></i><strong class="text-light">Sellers</strong>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#vets-tab">
                        <i class="fas fa-stethoscope me-2 text-light"></i><strong class="text-light">Vets</strong>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Buyers Tab -->
            <div class="tab-pane fade show active" id="buyers-tab">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">1</div>
                            <h5 class="text-light">Search for a Dog</h5>
                            <p class="lead text-light small">Filter by breed, age, location, or price</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">2</div>
                            <h5 class="text-light">View Listings</h5>
                            <p class="lead text-light small">Check out detailed dog profiles with images, health info, and seller details.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">3</div>
                            <h5 class="text-light">Connect with the Seller</h5>
                            <p class="lead text-light small">Message the seller directly to ask questions or arrange a meetup.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">4</div>
                            <h5  class="text-light">Complete Your Purchase</h5>
                            <p class="lead text-light small">Securely pay and bring home your new furry friend!</p>
                        </div>
                    </div>
                    <!-- Repeat for steps 2-4 -->
                </div>
            </div>

            <!-- Sellers Tab -->
            <div class="tab-pane fade" id="sellers-tab">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">1</div>
                            <h5 class="text-light">Create Account</h5>
                            <p class="lead text-light small">Set up your seller profile in minutes</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">2</div>
                            <h5 class="text-light">List Your Dog</h5>
                            <p class="lead text-light small">Upload high-quality photos, set a price, and add details about the dog.</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">3</div>
                            <h5 class="text-light">Connect with Buyers</h5>
                            <p class="lead text-light small">Receive inquiries and chat with interested buyers.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">4</div>
                            <h5  class="text-light">Sell & Earn</h5>
                            <p class="lead text-light small"> Finalize the sale and help a pet find a new home!</p>
                        </div>
                    </div>
                    <!-- Repeat for steps 2-4 -->
                </div>
            </div>

            <!-- Vets Tab -->
            <div class="tab-pane fade" id="vets-tab">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">1</div>
                            <h5 class="text-light">Sign Up as Vet</h5>
                            <p class="lead text-light small">Showcase your expertise & services</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">2</div>
                            <h5 class="text-light">Receive Booking Requests</h5>
                            <p class="lead text-light small">Pet owners can find and book your services</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">3</div>
                            <h5 class="text-light">Offer Consultations</h5>
                            <p class="lead text-light small"> Provide advice, checkups, or treatment for pets.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">4</div>
                            <h5 class="text-light"> Get Paid for Your Services</h5>
                            <p class="lead text-light small">Grow your veterinary practice through PuppyLink KE!</p>
                        </div>
                    </div>
                    <!-- Repeat for steps 2-4 -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Veterinary Services -->
<section class="py-5" id= "vets">
    <div class="container">
        <h2 class="text-center mb-5">Featured Vets</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card vet-card h-100">
                    <img src="Images/doc1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Dr. Jane Muthoni</h5>
                        <p class="text-muted">Nairobi · Vaccinations · Surgery</p>
                        <button class="btn btn-outline-secondary">Book Consultation</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card vet-card h-100">
                    <img src="Images/doc1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Dr. Jane Muthoni</h5>
                        <p class="text-muted">Nairobi · Vaccinations · Surgery</p>
                        <button class="btn btn-outline-secondary">Book Consultation</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card vet-card h-100">
                    <img src="Images/doc1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Dr. Jane Muthoni</h5>
                        <p class="text-muted">Nairobi · Vaccinations · Surgery</p>
                        <button class="btn btn-outline-secondary">Book Consultation</button>
                    </div>
                </div>
            </div>
            <!-- Add more vet cards -->
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">What Our Users Say</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <p class="fst-italic">"Found my perfect puppy in 2 days!"</p>
                        <h5>Mary Kariuki</h5>
                        <p class="text-muted">Nairobi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <p class="fst-italic">"Found my perfect puppy in 2 days!"</p>
                        <h5>Mary Kariuki</h5>
                        <p class="text-muted">Nairobi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <p class="fst-italic">"Found my perfect puppy in 2 days!"</p>
                        <h5>Mary Kariuki</h5>
                        <p class="text-muted">Nairobi</p>
                    </div>
                </div>
            </div>
            <!-- Add more testimonials -->
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary bg-gradient text-white">
    <div class="container text-center">
        <h2 class="mb-4">Ready to Get Started?</h2>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-light btn-lg px-5">
                <i class="fas fa-dog"></i> List a Dog
            </button>
            
           <a href="listing.php" class="btn btn-light btn-lg px-5 text-decoration-none"><i class="fas fa-search"></i> Find a Dog</a>
            
        </div>
    </div>
</section>

<script>
  // Wishlist functionality
  document.querySelectorAll('.wishlist-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      this.classList.toggle('active');
      const icon = this.querySelector('i');
      icon.classList.toggle('far');
      icon.classList.toggle('fas');
      
      // Add your wishlist logic here
      const petName = this.closest('.pet-card').querySelector('.card-title').textContent;
      console.log(`${petName} ${this.classList.contains('active') ? 'added to' : 'removed from'} wishlist`);
    });
  });
  
  // Quick View functionality
  document.querySelectorAll('.quick-view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const petCard = this.closest('.pet-card');
      const petName = petCard.querySelector('.card-title').textContent;
      // Implement your quick view modal here
      console.log(`Quick view for ${petName}`);
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>