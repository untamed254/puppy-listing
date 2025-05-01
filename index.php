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
                    <a href="#" class="btn btn-outline-light btn-lg px-4" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
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
<section class="testimonials py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-6 mb-3">What Pet Lovers Say</h2>
      <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#testimonialModal">
        <i class="fas fa-plus me-2"></i>Share Your Experience
      </button>
    </div>

    <!-- Testimonials Carousel -->
    <div class="row g-4 justify-content-center">
      <div class="col-md-8">
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <!-- Testimonial 1 -->
            <div class="carousel-item active">
              <div class="testimonial-card text-center p-4 p-lg-5">
                <div class="rating mb-3 text-warning">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <p class="lead mb-4">"Found my perfect puppy in just 2 days! The process was so easy and the seller was incredibly helpful."</p>
                <div class="user d-flex align-items-center justify-content-center">
                  <div>
                    <h6 class="mb-0">Mary Kariuki</h6>
                    <small class="text-muted">Nairobi • German Shepherd</small>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="carousel-item">
              <div class="testimonial-card text-center p-4 p-lg-5">
                <div class="rating mb-3 text-warning">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="lead mb-4">"As a first-time dog owner, I was nervous, but PawaPets connected me with an amazing breeder."</p>
                <div class="user d-flex align-items-center justify-content-center">
                  <div>
                    <h6 class="mb-0">James Mwangi</h6>
                    <small class="text-muted">Mombasa • Golden Retriever</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-warning rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-warning rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonial Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-0">
        <h5 class="modal-title">Share Your Experience</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="testimonialForm">
          <div class="mb-3">
            <label class="form-label">Your Name</label>
            <input type="text" class="form-control" placeholder="John Doe">
          </div>
          <div class="mb-3">
            <label class="form-label">Your Rating</label>
            <div class="rating-stars mb-2">
              <i class="far fa-star" data-rating="1"></i>
              <i class="far fa-star" data-rating="2"></i>
              <i class="far fa-star" data-rating="3"></i>
              <i class="far fa-star" data-rating="4"></i>
              <i class="far fa-star" data-rating="5"></i>
              <input type="hidden" name="rating" id="ratingValue">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Your Experience</label>
            <textarea class="form-control" rows="3" placeholder="Tell us about your experience..."></textarea>
          </div>
          <button type="submit" class="btn btn-warning w-100 mt-3">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
                    <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="listing.php" class="text-white text-decoration-none">Listed Pets</a></li>
                    <li class="mb-2"><a href="aboutus.php" class="text-white text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="#vets" class="text-white text-decoration-none">Veterinary Services</a></li>
                    <li class="mb-2"><a href="contactus.php" class="text-white text-decoration-none">Contact Us</a></li>
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

<!-- Pet Profile Modal -->
<div class="modal fade" id="petProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0d6efd; color: white;">
                <h5 class="modal-title" id="petProfileModalLabel">Pet Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Main Pet Info Column -->
                        <div class="col-md-7">
                            <!-- Pet Image Carousel -->
                            <div id="petImagesCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                                <div class="carousel-indicators" id="carouselIndicators"></div>
                                <div class="carousel-inner rounded-3" id="carouselInner"></div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#petImagesCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#petImagesCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            
                            <!-- Pet Details -->
                            <div class="pet-details">
                                <h3 id="petName" class="mb-3 text-primary"></h3>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p><i class="fas fa-dog me-2 text-warning"></i> <strong>Breed:</strong> <span id="petBreed"></span></p>
                                        <p><i class="fas fa-birthday-cake me-2 text-warning"></i> <strong>Age:</strong> <span id="petAge"></span></p>
                                    </div>
                                    <div class="col-6">
                                        <p><i class="fas fa-map-marker-alt me-2 text-warning"></i> <strong>Location:</strong> <span id="petLocation"></span></p>
                                        <p><i class="fas fa-venus-mars me-2 text-warning"></i> <strong>Gender:</strong> <span id="petGender"></span></p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h5 class="text-primary">Description</h5>
                                    <p id="petDescription" class="text-muted"></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side Column -->
                        <div class="col-md-5">
                            <!-- Seller Info -->
                            <div class="card mb-4 border-primary">
                                <div class="card-header text-white" style="background-color: #ffc107;">
                                    <h5 class="mb-0">Contact Seller</h5>
                                </div>
                                <div class="card-body">
                                    <div class="seller-info mb-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="seller-avatar me-3">
                                                <i class="fas fa-user-circle fa-3x text-warning"></i>
                                            </div>
                                            <div>
                                                <h6 id="sellerName" class="mb-0">Unknown Seller</h6>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-warning w-100 mb-2 text-white" id="contactSellerBtn">
                                            <i class="fas fa-envelope me-2"></i> Send Message
                                        </a>
                                        <a href="#" class="btn btn-outline-primary w-100">
                                            <i class="fas fa-phone-alt me-2"></i> Call Seller
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Similar Pets Section -->
                            <div class="card border-warning">
                                <div class="card-header text-white" style="background-color: #ffc107;">
                                    <h5 class="mb-0">Similar Pets</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2" id="similarPetsContainer">
                                        <!-- Similar pets will be loaded here -->
                                        <div class="col-12 text-center">
                                            <p class="text-muted">Loading similar pets...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Coming Soon Modal -->
<div class="modal fade" id="comingSoonModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-warning"><i class="fas fa-exclamation-circle me-2"></i>Coming Soon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-clock fa-4x text-warning mb-3"></i>
        <h4>Registration Feature Coming Soon!</h4>
        <p>We're working hard to launch our registration system. Please check back later.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Got It!</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const petProfileModal = new bootstrap.Modal(document.getElementById('petProfileModal'));
        
        // Add click event to all Quick View buttons
        document.querySelectorAll('.quick-view-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const petCard = this.closest('.pet-card');
                loadPetProfile(petCard);
            });
        });
        
        // Function to load pet data into modal
        function loadPetProfile(petCard) {
            // Extract data from the pet card
            const petData = {
                id: petCard.dataset.puppyId,
                name: petCard.dataset.puppyName,
                breed: petCard.dataset.breedName,
                age: petCard.dataset.puppyAge + ' month(s)',
                location: petCard.dataset.puppyLocation,
                gender: 'Unknown',
                price: petCard.dataset.price,
                description: petCard.dataset.puppyDesc || 'No description available for this pet.',
                sellerName: petCard.dataset.sellerName || 'Unknown Seller',
                images: [
                    petCard.querySelector('img').src,
                    'https://via.placeholder.com/800x600/0d6efd/FFFFFF?text=Pet+Image+2',
                    'https://via.placeholder.com/800x600/ffc107/FFFFFF?text=Pet+Image+3'
                ]
            };
            
            // Populate the modal with pet data
            document.getElementById('petProfileModalLabel').textContent = petData.name;
            document.getElementById('petName').textContent = petData.name;
            document.getElementById('petBreed').textContent = petData.breed;
            document.getElementById('petAge').textContent = petData.age;
            document.getElementById('petLocation').textContent = petData.location;
            document.getElementById('petGender').textContent = petData.gender;
            document.getElementById('petDescription').textContent = petData.description;
            document.getElementById('sellerName').textContent = petData.sellerName;
            
            // Update contact links
            document.getElementById('contactSellerBtn').href = `contact_seller.php?puppy_id=${petData.id}`;
            document.querySelector('.btn-outline-primary').href = `contact_seller.php?puppy_id=${petData.id}`;
            
            // Set up carousel
            const carouselInner = document.getElementById('carouselInner');
            const carouselIndicators = document.getElementById('carouselIndicators');
            
            carouselInner.innerHTML = '';
            carouselIndicators.innerHTML = '';
            
            petData.images.forEach((img, index) => {
                // Add carousel item
                const item = document.createElement('div');
                item.className = `carousel-item ${index === 0 ? 'active' : ''}`;
                item.innerHTML = `<img src="${img}" class="d-block w-100" alt="${petData.name}">`;
                carouselInner.appendChild(item);
                
                // Add indicator
                const indicator = document.createElement('button');
                indicator.type = 'button';
                indicator.setAttribute('data-bs-target', '#petImagesCarousel');
                indicator.setAttribute('data-bs-slide-to', index);
                indicator.className = index === 0 ? 'active' : '';
                indicator.setAttribute('aria-current', index === 0 ? 'true' : 'false');
                indicator.setAttribute('aria-label', `Slide ${index + 1}`);
                carouselIndicators.appendChild(indicator);
            });
            
            // Load similar pets
            loadSimilarPets(petData.breed, petData.id);
            
            // Show the modal
            petProfileModal.show();
        }
        
        // Function to load similar pets
        function loadSimilarPets(breed, currentPetId) {
            const similarPetsContainer = document.getElementById('similarPetsContainer');
            similarPetsContainer.innerHTML = '';
            
            // Find similar pets from the page (same breed, different pet)
            const allPets = Array.from(document.querySelectorAll('.pet-card'));
            const similarPets = allPets.filter(pet => 
                pet.dataset.breedName === breed && pet.dataset.puppyId !== currentPetId
            ).slice(0, 3); // Get max 3 similar pets
            
            if (similarPets.length === 0) {
                similarPetsContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No similar pets found.</p></div>';
                return;
            }
            
            similarPets.forEach(pet => {
                const petCard = document.createElement('div');
                petCard.className = 'col-12 similar-pet-card';
                petCard.innerHTML = `
                    <div class="card mb-2">
                        <img src="${pet.querySelector('img').src}" class="card-img-top" alt="${pet.dataset.puppyName}">
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1">${pet.dataset.puppyName}</h6>
                            <p class="card-text text-muted small mb-1">${pet.dataset.breedName}</p>
                            <p class="card-text text-warning fw-bold">KES ${pet.dataset.price}</p>
                        </div>
                    </div>
                `;
                
                // Add click event to similar pet cards
                petCard.querySelector('.card').addEventListener('click', () => {
                    loadPetProfile(pet);
                });
                
                similarPetsContainer.appendChild(petCard);
            });
        }
    });
</script>

<script>
  // Star Rating in Modal
  document.querySelectorAll('.rating-stars i').forEach(star => {
    star.addEventListener('click', function() {
      const rating = this.getAttribute('data-rating');
      const container = this.parentElement;
      
      container.querySelectorAll('i').forEach((s, index) => {
        s.classList.toggle('active', index < rating);
        s.classList.toggle('far', index >= rating);
        s.classList.toggle('fas', index < rating);
      });
      
      container.querySelector('#ratingValue').value = rating;
    });

    star.addEventListener('mouseover', function() {
      const rating = this.getAttribute('data-rating');
      const container = this.parentElement;
      
      container.querySelectorAll('i').forEach((s, index) => {
        s.classList.toggle('hovered', index < rating);
      });
    });

    star.addEventListener('mouseout', function() {
      const container = this.parentElement;
      container.querySelectorAll('i').forEach(s => {
        s.classList.remove('hovered');
      });
    });
  });

  // Form Submission
  document.getElementById('testimonialForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Here you would normally send data to server
    alert('Thank you for your feedback!');
    bootstrap.Modal.getInstance(document.getElementById('testimonialModal')).hide();
    this.reset();
    
    // Reset stars
    document.querySelectorAll('.rating-stars i').forEach(star => {
      star.classList.remove('fas', 'active');
      star.classList.add('far');
    });
  });
</script>
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