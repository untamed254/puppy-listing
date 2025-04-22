<?php 
  include("Includes/conn.php");
  include("Admin/functions/functions.php");
?>
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

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-paw"></i> PawaPets
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listing.php">Listed Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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

    <div class="row d-flex g-4">
      <?php
      getHomePagePets();
      ?>
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
                            <div class="step-card-body">
                                <h5 class="text-light">Search for a Dog</h5>
                                <p class="lead text-light small">Filter by breed, age, location, or price</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">2</div>
                            <div class="step-card-body">
                                <h5 class="text-light">View Listings</h5>
                                <p class="lead text-light small">Check out detailed dog profiles with images, health info, and seller details.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">3</div>
                            <div class="step-card-body">
                                <h5 class="text-light">Connect with the Seller</h5>
                                <p class="lead text-light small">Message the seller directly to ask questions or arrange a meetup.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-primary text-white mb-3">4</div>
                            <div class="step-card-body">
                                <h5  class="text-light">Complete Your Purchase</h5>
                                <p class="lead text-light small">Securely pay and bring home your new furry friend!</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for more steps -->
                </div>
            </div>

            <!-- Sellers Tab -->
            <div class="tab-pane fade" id="sellers-tab">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">1</div>
                            <div class="step-card-body">
                                <h5 class="text-light">Create Account</h5>
                                <p class="lead text-light small">Set up your seller profile in minutes</p>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">2</div>
                            <div class="step-card-body">
                                <h5 class="text-light">List Your Dog</h5>
                                <p class="lead text-light small">Upload high-quality photos, set a price, and add details about the dog.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">3</div>
                            <div class="step-card-body">
                                <h5 class="text-light">Connect with Buyers</h5>
                                <p class="lead text-light small">Receive inquiries and chat with interested buyers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-success text-white mb-3">4</div>
                            <div class="step-card-body">
                                <h5  class="text-light">Sell & Earn</h5>
                                <p class="lead text-light small"> Finalize the sale and help a pet find a new home!</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for more steps -->
                </div>
            </div>

            <!-- Vets Tab -->
            <div class="tab-pane fade" id="vets-tab">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">1</div>
                            <div class="step-card-body">
                                <h5 class="text-light">Sign Up as Vet</h5>
                                <p class="lead text-light small">Showcase your expertise & services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">2</div>
                            <div class="step-card-body">
                                <h5 class="text-light">Receive Booking Requests</h5>
                                <p class="lead text-light small">Pet owners can find and book your services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">3</div>
                            <div class="step-card-body">
                                <h5 class="text-light">Offer Consultations</h5>
                                <p class="lead text-light small"> Provide advice, checkups, or treatment for pets.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="step-card text-center p-4">
                            <div class="step-icon bg-info text-white mb-3">4</div>
                            <div class="step-card-body">
                                <h5 class="text-light"> Get Paid for Your Services</h5>
                                <p class="lead text-light small">Grow your veterinary practice through PuppyLink KE!</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for more steps-->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Veterinary Services - Coming Soon (Final Version) -->
<section class="vet-coming-soon py-5" id="vets">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="vet-coming-card">
                    <div class="vet-card-body p-4 p-md-5">
                        <div class="vet-icon-container mb-4">
                            <i class="fas fa-stethoscope vet-main-icon"></i>
                            <i class="fas fa-paw vet-paw-icon vet-paw-1"></i>
                            <i class="fas fa-paw vet-paw-icon vet-paw-2"></i>
                        </div>
                        <h2 class="vet-section-title mb-3">Veterinary Services</h2>
                        <p class="vet-description mb-4">
                            We're curating trusted veterinary partners to provide the best care for your pets!
                        </p>
                        <div class="vet-badge-container mt-3">
                            <span class="vet-badge">
                                <i class="fas fa-clock me-2"></i>Coming Soon
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title position-relative d-inline-block">
                <span class="section-title-main">Happy Pet Parents</span>
                <span class="section-title-bg">Testimonials</span>
            </h2>
            <p class="section-subtitle text-muted">Don't just take our word for it</p>
        </div>

        <div class="row g-4">
            <!-- Testimonial 1 -->
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-content">
                        <p>"Found my perfect puppy in just 2 days! The process was so easy and the seller was incredibly helpful."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Mary Kariuki">
                        </div>
                        <div class="author-info">
                            <h5>Mary Kariuki</h5>
                            <span>Nairobi</span>
                        </div>
                        <div class="author-pet">
                            <i class="fas fa-dog"></i> German Shepherd
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="col-md-4">
                <div class="testimonial-card featured">
                    <div class="featured-badge">Featured</div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-content">
                        <p>"As a first-time dog owner, I was nervous, but PawaPets connected me with an amazing breeder who provided ongoing support."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="James Mwangi">
                        </div>
                        <div class="author-info">
                            <h5>James Mwangi</h5>
                            <span>Mombasa</span>
                        </div>
                        <div class="author-pet">
                            <i class="fas fa-dog"></i> Golden Retriever
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="testimonial-content">
                        <p>"Sold my Labrador puppies quickly to loving families through PawaPets. Highly recommend for breeders!"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Sarah Omondi">
                        </div>
                        <div class="author-info">
                            <h5>Sarah Omondi</h5>
                            <span>Kisumu</span>
                        </div>
                        <div class="author-pet">
                            <i class="fas fa-dog"></i> Labrador
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial Controls -->
        <div class="testimonial-controls text-center mt-5">
            <button class="btn btn-outline-primary mx-2 testimonial-prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="btn btn-outline-primary mx-2 testimonial-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer-section bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Info Column -->
            <div class="col-lg-4 mb-4">
                <div class="footer-brand d-flex align-items-center mb-3">
                    <i class="fas fa-paw fa-2x text-warning me-2"></i>
                    <h3 class="mb-0">PawaPets Kenya</h3>
                </div>
                <p class="text-muted">Connecting loving homes with perfect pets across Kenya.</p>
                
                <div class="social-links mt-4">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div class="col-md-4 col-lg-2 mb-4">
                <h5 class="text-warning mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="listing.php" class="text-white text-decoration-none">Listed Pets</a></li>
                    <li class="mb-2"><a href="#about" class="text-white text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="#vets" class="text-white text-decoration-none">Veterinary Services</a></li>
                    <li class="mb-2"><a href="#contact" class="text-white text-decoration-none">Contact Us</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                </ul>
            </div>

            <!-- Pet Categories Column -->
            <div class="col-md-4 col-lg-2 mb-4">
                <h5 class="text-warning mb-3">Pet Types</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Dogs</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Cats</a></li>
                </ul>
            </div>

            <!-- Contact Info Column -->
            <div class="col-md-4 col-lg-4 mb-4">
                <h5 class="text-warning mb-3">Contact Us</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-phone-alt text-warning me-2 mt-1"></i>
                        <span>+254 700 123456</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-envelope text-warning me-2 mt-1"></i>
                        <span>info@pawapets.co.ke</span>
                    </li>
                </ul>

                <div class="newsletter mt-4">
                    <h6 class="text-white mb-2">Subscribe for Updates</h6>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-warning" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- Copyright Row -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; 2025 PawaPets Kenya. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline small mb-0">
                    <li class="list-inline-item"><a href="#" class="text-muted text-decoration-none">Privacy Policy</a></li>
                    <li class="list-inline-item mx-2">•</li>
                    <li class="list-inline-item"><a href="#" class="text-muted text-decoration-none">Terms of Service</a></li>
                    <li class="list-inline-item mx-2">•</li>
                    <li class="list-inline-item"><a href="#" class="text-muted text-decoration-none">Sitemap</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
  
  // Quick View functionality
  document.querySelectorAll('.quick-view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const petCard = this.closest('.pet-card');
      const petName = petCard.querySelector('.card-title').textContent;
      // Implement your quick view modal here
      console.log(`Quick view for ${petName}`);
    });
  });

  // Navbar scroll effect
  window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-custom');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>