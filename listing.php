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

    <style>
        /* Pet Modal Styles */
        .pet-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid #0d6efd;
        }

        .carousel-control-prev, 
        .carousel-control-next {
            background-color: rgba(13, 110, 253, 0.2);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(13, 110, 253, 0.5);
        }

        .carousel-indicators button.active {
            background-color: #0d6efd;
        }

        .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .similar-pet-card .card {
            transition: transform 0.2s;
            border: 1px solid rgba(0,0,0,0.1);
        }

        .similar-pet-card .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-color: #ffc107;
        }
    </style>
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

</body>
</html>