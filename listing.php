<?php 
  include("Includes/conn.php");
  include("Admin/functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Dogs - PuppyLink KE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-paw"></i> PawaPets
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="listing.php">Listed Pets</a>
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

<!-- Sticky Search & Filters -->
<div class="sticky-header">
    <div class="container">
        <div class="text-center">
            <div class="brand-title">
                <h1 class="text-warning">PawaPets Kenya</h1>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search breeds..." id="searchInput">
            </div>
            <div class="col-md-2">
                <select class="form-select" id="ageFilter">
                    <option value="">All Ages</option>
                    <option>Puppy (0-1yr)</option>
                    <option>Adult (1-8yrs)</option>
                    <option>Senior (8+yrs)</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="locationFilter">
                    <option value="">All Locations</option>
                    <option>Nairobi</option>
                    <option>Mombasa</option>
                    <option>Kisumu</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="sortBy">
                    <option value="newest">Newest First</option>
                    <option value="priceLow">Price: Low to High</option>
                    <option value="priceHigh">Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Modern Dog Listings Grid -->
<main class="container mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
       <?php
         getAllPets();
       ?>
    </div>
</main>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Filter and Sort Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dogs = Array.from(document.querySelectorAll('.col'));
        
        function filterAndSort() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const ageFilter = document.getElementById('ageFilter').value;
            const locationFilter = document.getElementById('locationFilter').value;
            const sortBy = document.getElementById('sortBy').value;

            dogs.forEach(dog => {
                const breed = dog.dataset.breed.toLowerCase();
                const age = dog.dataset.age;
                const location = dog.dataset.location.toLowerCase();
                const price = parseInt(dog.dataset.price);

                const matchesSearch = breed.includes(searchTerm);
                const matchesAge = !ageFilter || age === ageFilter.toLowerCase();
                const matchesLocation = !locationFilter || location === locationFilter.toLowerCase();

                dog.style.display = (matchesSearch && matchesAge && matchesLocation) ? 'block' : 'none';
            });

            // Sorting logic
            const visibleDogs = dogs.filter(dog => dog.style.display !== 'none');
            
            visibleDogs.sort((a, b) => {
                const aPrice = parseInt(a.dataset.price);
                const bPrice = parseInt(b.dataset.price);
                
                if(sortBy === 'priceLow') return aPrice - bPrice;
                if(sortBy === 'priceHigh') return bPrice - aPrice;
                return 0; // Newest first by default
            });

            // Re-insert sorted dogs
            const container = document.querySelector('.row');
            visibleDogs.forEach(dog => container.appendChild(dog));
        }

        // Add event listeners to all filters and search
        document.querySelectorAll('#searchInput, #ageFilter, #locationFilter, #sortBy').forEach(element => {
            element.addEventListener('input', filterAndSort);
            element.addEventListener('change', filterAndSort);
        });
    });
</script>

</body>
</html>