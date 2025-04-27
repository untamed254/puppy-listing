<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>About PawaPets Kenya</title>
    <!-- Use your existing head content -->
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listing.php">Listed Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contactus.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- About Us Hero Section -->
    <section class="about-hero bg-dark text-white position-relative overflow-hidden">
    <!-- Background Elements -->
    <div class="position-absolute w-100 h-100" style="
        background: linear-gradient(rgba(13, 58, 138, 0.9), rgba(13, 110, 253, 0.8)),
                    url('Images/paw-pattern-light.png');
        background-size: cover;
        opacity: 0.15;
        z-index: 0;
    "></div>
    
    <div class="container position-relative z-1" style="min-height: 80vh;">
        <div class="row align-items-center h-100 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.2;">
                    More Than Pets.<br>
                    <span class="text-warning">Forever Families.</span>
                </h1>
                <p class="lead mb-5" style="max-width: 600px;">
                    At PawaPets Kenya, we believe every pet deserves a loving home and every home deserves the perfect companion.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="listing.php" class="btn btn-warning btn-lg px-4 py-3">
                        <i class="fas fa-search me-2"></i> Find Your Match
                    </a>
                </div>
            </div>
            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="hero-image-container position-relative">
                    <img src="Images/hero01.jpg" alt="Happy family" class="img-fluid rounded-3 hero-main-image">
                </div>
            </div>
        </div>
    </div>

    <!-- Scrolling Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 z-1">
        <a href="#mission" class="text-white text-decoration-none">
            <div class="d-flex flex-column align-items-center">
                <span class="mb-2">Explore More</span>
                <i class="fas fa-chevron-down fs-4 animate-bounce"></i>
            </div>
        </a>
    </div>
</section>


    <!-- Mission Section -->
    <section id="mission" class="py-5 bg-light">
        <div class="container py-4">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="mission-img-box position-relative p-4">
                        <img src="Images/mission-img.jpg" alt="Our team" class="img-fluid rounded-3 shadow">
                        <div class="shape-overlay"></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ps-lg-4">
                        <h2 class="section-title mb-4">
                            <span class="section-title-main">Our Mission</span>
                            <span class="section-title-bg">Purpose</span>
                        </h2>
                        <p class="lead mb-4">At PawaPets Kenya, we're dedicated to creating meaningful connections between pets and loving families while promoting responsible pet ownership nationwide.</p>
                        
                        <div class="mission-points">
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <div class="mission-icon bg-primary text-white rounded-circle">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-2">Compassionate Matching</h5>
                                    <p class="text-muted mb-0">We carefully vet all pets and owners to ensure perfect, lifelong matches.</p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <div class="mission-icon bg-warning text-dark rounded-circle">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-2">Health Guarantee</h5>
                                    <p class="text-muted mb-0">All pets come with health checks and vaccination records.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title mb-3">
                    <span class="section-title-main">Our Core Values</span>
                    <span class="section-title-bg">Beliefs</span>
                </h2>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="value-card text-center p-4 rounded-3 h-100">
                        <div class="value-icon mx-auto mb-4">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h5 class="mb-3">Compassion</h5>
                        <p class="text-muted mb-0">We treat every animal with the love and respect they deserve</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="value-card text-center p-4 rounded-3 h-100">
                        <div class="value-icon mx-auto mb-4">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="mb-3">Integrity</h5>
                        <p class="text-muted mb-0">Honest and ethical practices in all we do</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="value-card text-center p-4 rounded-3 h-100">
                        <div class="value-icon mx-auto mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="mb-3">Community</h5>
                        <p class="text-muted mb-0">Building a network of responsible pet lovers</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="value-card text-center p-4 rounded-3 h-100">
                        <div class="value-icon mx-auto mb-4">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="mb-3">Education</h5>
                        <p class="text-muted mb-0">Empowering owners with pet care knowledge</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center py-4">
            <h2 class="mb-4">Ready to Find Your Perfect Pet?</h2>
            <p class="lead mb-5 mx-auto" style="max-width: 600px;">Join thousands of happy pet owners who found their companions through PawaPets Kenya</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="listing.php" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-search"></i> Browse Pets
                </a>
                <a href="contactus.php" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-question-circle"></i> Ask Questions
                </a>
            </div>
        </div>
    </section>

    <!-- Include your existing footer -->

    <!-- CSS for About Page -->
    <style>
        /* About Hero Section */
.about-hero {
    background: linear-gradient(135deg, #0d3a8a 0%, #0d6efd 100%);
    padding-top: 50px;
}

.hero-main-image {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    border: 5px solid rgba(255, 255, 255, 0.1);
    transform: perspective(1000px) rotateY(-5deg);
    transition: all 0.5s ease;
}

.hero-main-image:hover {
    transform: perspective(1000px) rotateY(0deg);
    border-color: rgba(255, 193, 7, 0.3);
}

.hero-image-container::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: url('Images/paw-pattern-light.png');
    opacity: 0.05;
    z-index: -1;
}

@keyframes animate-bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.animate-bounce {
    animation: animate-bounce 2s infinite;
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .about-hero {
        text-align: center;
    }
    
    .about-hero .d-flex {
        justify-content: center;
    }
    
    .hero-main-image {
        max-width: 80%;
        margin: 2rem auto 0;
    }
    
    .hero-image-container::before {
        display: none;
    }
}

@media (max-width: 767.98px) {
    .about-hero {
        min-height: auto;
        padding: 4rem 0;
    }
    
    h1.display-3 {
        font-size: 2.5rem;
    }
}
        
        /* Mission Section */
        .mission-img-box {
            background: linear-gradient(45deg, #0d6efd 0%, #0dcaf0 100%);
            border-radius: 12px;
        }
        
        .mission-img-box img {
            position: relative;
            z-index: 1;
            transform: rotate(-3deg);
            transition: all 0.3s ease;
        }
        
        .mission-img-box:hover img {
            transform: rotate(0deg);
        }
        
        .mission-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        /* Team Section */
        .team-img {
            width: 150px;
            height: 150px;
            border: 3px solid #ffc107;
            padding: 5px;
        }
        
        .team-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Values Section */
        .value-icon {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #0d6efd;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .value-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border-color: rgba(13, 110, 253, 0.2);
        }
        
        /* Section Titles */
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title-main {
            position: relative;
            z-index: 2;
            font-weight: 700;
        }
        
        .section-title-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3.5rem;
            font-weight: 900;
            color: rgba(13, 110, 253, 0.05);
            white-space: nowrap;
            z-index: 1;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .about-hero::before {
                width: 100%;
                opacity: 0.03;
            }
            
            .img-badge {
                right: 10px;
                bottom: -15px;
            }
            
            .section-title-bg {
                font-size: 2.5rem;
            }
            
            .team-img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</body>
</html>