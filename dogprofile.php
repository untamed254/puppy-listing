<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>German Shepherd - PuppyLink KE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<!-- Main Content -->
<div class="dog-main">
    <div class="container mt-4">
        <!-- Back Button -->
        <a href="shop.php" class="btn btn-outline-secondary mb-4">
            ← Back to Listings
        </a>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image Carousel -->
                <div id="dogCarousel" class="carousel slide image-carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="Images/stock1.jpg" class="d-block w-100 carousel-image">
                        </div>
                        <div class="carousel-item">
                            <img src="Images/stock3.jpg" class="d-block w-100 carousel-image">
                        </div>
                        <!-- Add more carousel items -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#dogCarousel">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dogCarousel">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <!-- Dog Information -->
                <div class="dog-info mt-4">
                    <h1 class="display-5">German Shepherd</h1>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Breed:</span>
                                    <span>German Shepherd</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Age:</span>
                                    <span>3 months</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Price:</span>
                                    <span class="text-primary">KES 25,000</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Location:</span>
                                    <span>Nairobi</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mt-4">
                        <h4>About This Dog</h4>
                        <p>Healthy male German Shepherd puppy with complete vaccinations. Comes with pedigree papers and vet records. Raised in a loving home environment.</p>
                    </div>
                </div>

                <!-- Similar Listings -->
                <section class="similar-listings mt-5">
                    <h4 class="mb-4">Similar Listings</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <!-- Repeat similar cards -->
                        <div class="col">
                            <div class="card similar-card h-100">
                                <img src="Images/stock3.jpg" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">German Shepherd</h5>
                                    <p class="text-muted">4 months | Mombasa</p>
                                    <h5 class="text-primary">KES 28,000</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Seller Info & Contact (Sticky) -->
            <div class="col-lg-4">
                <div class="sticky-contact">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Seller Information</h5>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <img src="Images/img1.jpg" class="rounded-circle" width="50">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6>John Mwangi</h6>
                                    <small class="text-success">Verified Seller ★★★★☆ (4.8)</small>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100" onclick="openChat()">
                                <i class="fas fa-comment"></i> Contact Seller
                            </button>
                            <div class="mt-3 text-center">
                                <small class="text-muted">Response time: usually within 1 hour</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Contact Button -->
    <button class="btn btn-primary btn-lg contact-btn-fixed rounded-pill px-4" onclick="openChat()">
        <i class="fas fa-comment"></i> Contact Seller
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openChat() {
        // Implement chat functionality here
        alert('Chat initiated with seller!');
    }

    // Make contact button visible on scroll
    window.addEventListener('scroll', function() {
        const contactBtn = document.querySelector('.contact-btn-fixed');
        if (window.scrollY > 100) {
            contactBtn.style.display = 'block';
        } else {
            contactBtn.style.display = 'none';
        }
    });
</script>

</body>
</html>