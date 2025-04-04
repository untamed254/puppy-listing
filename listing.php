<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Dogs - PuppyLink KE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

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

<!-- Dog Listings Grid -->
<main class="container mt-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <!-- Dog Card 1 -->
        <div class="col" data-breed="german-shepherd" data-age="puppy" data-price="25000" data-location="nairobi">
            <a href="dog-profile.php?id=1" class="text-decoration-none text-dark">
                <div class="card dog-card">
                    <div class="position-relative">
                        <span class="price-badge text-white">KES 25,000</span>
                        <img src="Images/stock1.jpg" class="dog-image w-100">
                        <div class="image-overlay">
                            <span class="badge bg-light text-dark">3 months</span>
                            <span class="badge bg-light text-dark ms-2">Nairobi</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">German Shepherd</h5>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Purebred</small>
                            <small class="text-success">Available</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Dog Card 1 -->
        <div class="col" data-breed="german-shepherd" data-age="puppy" data-price="25000" data-location="nairobi">
            <a href="dog-profile.php?id=1" class="text-decoration-none text-dark">
                <div class="card dog-card">
                    <div class="position-relative">
                        <span class="price-badge text-white">KES 25,000</span>
                        <img src="Images/stock2.jpg" class="dog-image w-100">
                        <div class="image-overlay">
                            <span class="badge bg-light text-dark">3 months</span>
                            <span class="badge bg-light text-dark ms-2">Nairobi</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Rotweiller</h5>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Purebred</small>
                            <small class="text-success">Available</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Dog Card 1 -->
        <div class="col" data-breed="german-shepherd" data-age="puppy" data-price="25000" data-location="nairobi">
            <a href="dog-profile.php?id=1" class="text-decoration-none text-dark">
                <div class="card dog-card">
                    <div class="position-relative">
                        <span class="price-badge text-white">KES 25,000</span>
                        <img src="Images/stock3.jpg" class="dog-image w-100">
                        <div class="image-overlay">
                            <span class="badge bg-light text-dark">3 months</span>
                            <span class="badge bg-light text-dark ms-2">Mombasa</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">German Shepherd</h5>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">Purebred</small>
                            <small class="text-success">Available</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Add more dog cards following the same structure -->
    </div>
</main>

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