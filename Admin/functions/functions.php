<?php
if (!isset($con)) {
    include("Includes/conn.php"); 
}

function is_logged_in() {
    // Check if the user has a session.
    if (!isset($_SESSION['admin_name'])) {
        return false;
    }

    // Check if the user has a session cookie.
    if (!isset($_COOKIE['session_id'])) {
        return false;
    }

    // If the user has both a session and a session cookie, they are logged in.
    return true;
}
//logout fxn
function logout_user() {
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
}
function getHomePagePets() {
    global $con;

    if (!isset($_GET['breed'])) {
        $select_query = "
        SELECT 
            pl.puppy_id,
            pl.puppy_name,
            pl.puppy_age,
            pl.puppy_location,
            pl.price,
            pl.puppy_desc,
            b.breed_name,
            MIN(pi.image_url) AS image_url
        FROM 
            puppy_listing pl
        LEFT JOIN 
            pet_images pi ON pl.puppy_id = pi.puppy_id
        LEFT JOIN 
            puppy_breed b ON pl.breed_id = b.breed_id
        GROUP BY 
            pl.puppy_id
        ORDER BY 
            RAND()
        LIMIT 4";

        $result_query = mysqli_query($con, $select_query);

        if (!$result_query) {
            die("Query Failed: " . mysqli_error($con));
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $puppy_id = $row['puppy_id'];
            $puppy_title = $row['puppy_name'];
            $puppy_age = $row['puppy_age'];
            $puppy_location = $row['puppy_location'];
            $puppy_price = $row['price'];
            $puppy_desc = $row['puppy_desc'];
            $breed_title = $row['breed_name'] ?? 'Unknown';

            // Fetch the first image
            $img_query = mysqli_query($con, "SELECT image_url FROM pet_images WHERE puppy_id = $puppy_id LIMIT 1");
            $img_row = mysqli_fetch_assoc($img_query);
            $P_image_one = str_replace('../', '', $img_row['image_url'] ?? 'Images/default.jpg');

            echo "
            <div class='col-md-6 col-lg-4 col-xl-3'>
              <div class='card pet-card h-100 border-0 shadow-sm'
                   data-puppy-id='$puppy_id'
                   data-puppy-name='$puppy_title'
                   data-breed-name='$breed_title'
                   data-puppy-age='$puppy_age'
                   data-puppy-location='$puppy_location'
                   data-puppy-desc='$puppy_desc'
                   data-price='$puppy_price'
                   data-seller-name='Unknown Seller'
                   data-seller-rating='★★★★☆'>
                <div class='position-relative'>
                  <img src='$P_image_one' class='card-img-top pet-image' alt='$puppy_title'>
                </div>
                <div class='card-body'>
                  <div class='d-flex justify-content-between align-items-start mb-2'>
                    <h5 class='card-title mb-0'>$puppy_title</h5>
                    <h5 class='text-warning mb-0'>KES $puppy_price</h5>
                  </div>
                  <div class='pet-meta d-flex flex-wrap gap-2 mb-3'>
                   <span class='text-muted'><i class='fas fa-paw me-1'></i> $breed_title</span>
                    <span class='text-muted'><i class='fas fa-birthday-cake me-1'></i> $puppy_age Month(s)</span>
                    <span class='text-muted'><i class='fas fa-map-marker-alt me-1'></i> $puppy_location</span>
                  </div>
                  <div class='d-grid gap-2'>
                    <a href='#' class='btn btn-outline-primary btn-sm quick-view-btn'>
                        <i class='fas fa-eye me-2'></i> Quick View
                    </a>
                    <a href='contact_seller.php?puppy_id=$puppy_id' class='btn btn-warning btn-sm'>Contact Seller</a>
                  </div>
                </div>
              </div>
            </div>
            ";
        }
    }
}


function getAllPets() {
    global $con;
    
    if (!isset($_GET['breed'])) {
        $select_query = "
        SELECT 
            pl.puppy_id,
            pl.puppy_name,
            pl.puppy_age,
            pl.puppy_location,
            pl.price,
            pl.puppy_desc,
            b.breed_name,
            MIN(pi.image_url) AS image_url
        FROM 
            puppy_listing pl
        LEFT JOIN 
            pet_images pi ON pl.puppy_id = pi.puppy_id
        LEFT JOIN 
            puppy_breed b ON pl.breed_id = b.breed_id
        GROUP BY 
            pl.puppy_id
        ORDER BY 
            RAND()
        ";
        
        $result_query = mysqli_query($con, $select_query);

        while ($row = mysqli_fetch_assoc($result_query)) {
            $puppy_id = $row['puppy_id'];
            $puppy_title = $row['puppy_name'];
            $puppy_age = $row['puppy_age'];
            $puppy_location = $row['puppy_location'];
            $puppy_price = $row['price'];
            $puppy_desc = $row['puppy_desc'];
            $breed_title = $row['breed_name'] ?? 'Unknown';

            // Fetch the first image
            $img_query = mysqli_query($con, "SELECT image_url FROM pet_images WHERE puppy_id = $puppy_id LIMIT 1");
            $img_row = mysqli_fetch_assoc($img_query);
            $P_image_one = str_replace('../', '', $img_row['image_url'] ?? 'Images/default.jpg');

            echo "
            <div class='col pet-card' 
                 data-puppy-id='$puppy_id'
                 data-puppy-name='$puppy_title'
                 data-breed-name='$breed_title'
                 data-puppy-age='$puppy_age'
                 data-puppy-location='$puppy_location'
                 data-puppy-desc='$puppy_desc'
                 data-price='$puppy_price'
                 data-seller-name='Unknown Seller'
                 data-seller-rating='★★★★☆'>
              <div class='card h-100 border-0 shadow-sm'>
                <div class='position-relative'>
                  <img src='$P_image_one' class='card-img-top pet-image' alt='$puppy_title'>
                </div>
                <div class='card-body'>
                  <div class='d-flex justify-content-between align-items-start mb-2'>
                    <h5 class='card-title mb-0'>$puppy_title</h5>
                    <h5 class='text-warning mb-0'>KES $puppy_price</h5>
                  </div>
                  <div class='pet-meta d-flex flex-wrap gap-2 mb-3'>
                   <span class='text-muted'><i class='fas fa-paw me-1'></i> $breed_title</span>
                    <span class='text-muted'><i class='fas fa-birthday-cake me-1'></i> $puppy_age month(s)</span>
                    <span class='text-muted'><i class='fas fa-map-marker-alt me-1'></i> $puppy_location</span>
                  </div>
                  <div class='d-grid gap-2'>
                    <a href='#' class='btn btn-outline-primary btn-sm quick-view-btn'>
                        <i class='fas fa-eye me-2'></i> Quick View
                    </a>
                    <a href='contact_seller.php?puppy_id=$puppy_id' class='btn btn-warning btn-sm'>Contact Seller</a>
                  </div>
                </div>
              </div>
            </div>
            ";
        }
    }
}
function view_puppy_details() {
    global $con;

    if (isset($_GET['puppy_id'])) {
        $puppy_id = intval($_GET['puppy_id']);

        // Fetch puppy details + breed
        $query = "
            SELECT 
                pl.*, 
                b.breed_name 
            FROM 
                puppy_listing pl
            LEFT JOIN 
                puppy_breed b ON pl.breed_id = b.breed_id
            WHERE 
                pl.puppy_id = $puppy_id
        ";

        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $puppy = mysqli_fetch_assoc($result);

            $puppy_title = $puppy['puppy_name'];
            $puppy_age = $puppy['puppy_age'];
            // $puppy_gender = $puppy['puppy_gender'];
            $puppy_desc = $puppy['puppy_desc'];
            $puppy_location = $puppy['puppy_location'];
            $puppy_price = number_format($puppy['price']);
            $breed_title = $puppy['breed_name'] ?? 'Unknown';

            // Fetch pet images
            $img_query = "SELECT image_url FROM pet_images WHERE puppy_id = $puppy_id";
            $img_result = mysqli_query($con, $img_query);
            $images = [];
            while ($img_row = mysqli_fetch_assoc($img_result)) {
                // Clean image path and store
                $clean_path = str_replace('../', '', $img_row['image_url']);
                $images[] = $clean_path;
            }

            // Output HTML
            echo '<div class="row g-4">';
            
            // LEFT SIDE
            echo '<div class="col-lg-8">';
            // Carousel
            echo '<div id="dogCarousel" class="carousel slide image-carousel">';
            echo '<div class="carousel-inner">';
            foreach ($images as $index => $img) {
                $active = $index === 0 ? 'active' : '';
                echo "<div class='carousel-item $active'>
                        <img src='$img' class='d-block w-100 carousel-image'>
                      </div>";
            }
            echo '</div>
                <button class="carousel-control-prev" type="button" data-bs-target="#dogCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#dogCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>';

            // Dog Info
            echo "
            <div class='dog-info mt-4'>
                <h1 class='display-5 text-warning'><strong>$puppy_title</strong></h1>
                <div class='row mt-4'>
                    <div class='col-md-6'>
                        <ul class='list-group'>
                            <li class='list-group-item d-flex justify-content-between'>
                                <span>Breed:</span>
                                <span>$breed_title</span>
                            </li>
                            <li class='list-group-item d-flex justify-content-between'>
                                <span>Age:</span>
                                <span>$puppy_age month(s)</span>
                            </li>
                            
                        </ul>
                    </div>
                    <div class='col-md-6'>
                        <ul class='list-group'>
                            <li class='list-group-item d-flex justify-content-between'>
                                <span>Price:</span>
                                <span class='text-primary'>KES $puppy_price</span>
                            </li>
                            <li class='list-group-item d-flex justify-content-between'>
                                <span>Location:</span>
                                <span>$puppy_location</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class='mt-4'>
                    <h4>About This Dog</h4>
                    <p>$puppy_desc</p>
                </div>
            </div>";

            // Similar Listings placeholder
            echo '
            <section class="similar-listings mt-5">
                <h4 class="mb-4">Similar Listings</h4>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
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
            ';
            echo '</div>';

            // RIGHT SIDE (Seller)
            echo '
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
            </div>';
            echo '</div>'; // end row
        } else {
            echo "<p class='text-danger'>Pet not found.</p>";
        }
    }
}
// search function
function searchPets($search_query = null, $age = null, $location = null) {
    global $con;
    
    $query = "
        SELECT p.*, b.breed_name, 
               GROUP_CONCAT(i.image_url) AS images 
        FROM puppy_listing p
        LEFT JOIN puppy_breed b ON p.breed_id = b.breed_id
        LEFT JOIN pet_images i ON p.puppy_id = i.puppy_id
        WHERE 1=1";
    
    $params = [];
    $types = '';

    if (!empty($search_query)) {
        $query .= " AND (p.puppy_name LIKE ? OR b.breed_name LIKE ? OR p.puppy_desc LIKE ?)";
        $search_term = "%$search_query%";
        $params = array_merge($params, [$search_term, $search_term, $search_term]);
        $types .= 'sss';
    }

    if (!empty($age)) {
        $query .= " AND p.puppy_age = ?";
        $params[] = $age;
        $types .= 'i';
    }

    if (!empty($location)) {
        $query .= " AND p.puppy_location LIKE ?";
        $params[] = "%$location%";
        $types .= 's';
    }

    $query .= " GROUP BY p.puppy_id ORDER BY p.puppy_id DESC";

    $stmt = $con->prepare($query);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    return $stmt->get_result();
}
//salutation function



?>
<!--  -->
  