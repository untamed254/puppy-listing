<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact PawaPets Kenya</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Contact Page Styles */
        .contact-section {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .contact-container {
            display: flex;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .text-container {
            flex: 1;
            min-width: 300px;
            padding: 60px;
            background: linear-gradient(135deg, #0d3a8a 0%, #0d6efd 100%);
            color: white;
            position: relative;
        }

        .form-container {
            flex: 1;
            min-width: 300px;
            padding: 60px;
            position: relative;
        }

        .contact-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }

        .contact-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: #ffc107;
        }

        .contact-item {
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.5s ease;
        }

        .contact-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .contact-item h2 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: #ffc107;
        }

        .contact-item span {
            font-size: 1rem;
            display: block;
        }

        .phone-svg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            opacity: 1;
            transition: opacity 1s ease 4s;
        }

        .contact-form {
            opacity: 0;
            transition: opacity 1s ease 3s;
        }

        .contact-form.visible {
            opacity: 1;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            outline: none;
        }

        textarea.form-input {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .submit-btn:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }

        .alert {
            margin-top: 20px;
            padding: 10px 15px;
            border-radius: 6px;
            display: none;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
        }

        /* Animation for SVG path */
        .phone-svg path {
            stroke: #0d6efd;
            stroke-width: 0.2;
            fill: none;
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: draw 3s ease forwards;
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .text-container, .form-container {
                padding: 40px;
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
            }
            
            .text-container {
                order: 2;
            }
            
            .form-container {
                order: 1;
            }
            
            .phone-svg {
                display: none;
            }
            
            .contact-form {
                opacity: 1;
                transition: none;
            }
        }
    </style>
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
                    <a class="nav-link" href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contactus.php">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <!-- Text Container -->
            <div class="text-container">
                <h1 class="contact-title">Let's work together</h1>
                
                <div class="contact-item" id="mail-item">
                    <h2>Mail</h2>
                    <span>contact@pawapets.co.ke</span>
                </div>
                
                <div class="contact-item" id="phone-item">
                    <h2>Phone</h2>
                    <span>+254 700 123456</span>
                </div>
            </div>
            
            <!-- Form Container -->
            <div class="form-container">
                <div class="phone-svg">
                    <svg width="100%" height="100%" viewBox="0 0 32.666 32.666">
                        <path d="M28.189,16.504h-1.666c0-5.437-4.422-9.858-9.856-9.858l-0.001-1.664C23.021,4.979,28.189,10.149,28.189,16.504z
                        M16.666,7.856L16.665,9.52c3.853,0,6.983,3.133,6.981,6.983l1.666-0.001C25.312,11.735,21.436,7.856,16.666,7.856z M16.333,0
                        C7.326,0,0,7.326,0,16.334c0,9.006,7.326,16.332,16.333,16.332c0.557,0,1.007-0.45,1.007-1.006c0-0.559-0.45-1.01-1.007-1.01
                        c-7.896,0-14.318-6.424-14.318-14.316c0-7.896,6.422-14.319,14.318-14.319c7.896,0,14.317,6.424,14.317,14.319
                        c0,3.299-1.756,6.568-4.269,7.954c-0.913,0.502-1.903,0.751-2.959,0.761c0.634-0.377,1.183-0.887,1.591-1.529
                        c0.08-0.121,0.186-0.228,0.238-0.359c0.328-0.789,0.357-1.684,0.555-2.518c0.243-1.064-4.658-3.143-5.084-1.814
                        c-0.154,0.492-0.39,2.048-0.699,2.458c-0.275,0.366-0.953,0.192-1.377-0.168c-1.117-0.952-2.364-2.351-3.458-3.457l0.002-0.001
                        c-0.028-0.029-0.062-0.061-0.092-0.092c-0.031-0.029-0.062-0.062-0.093-0.092v0.002c-1.106-1.096-2.506-2.34-3.457-3.459
                        c-0.36-0.424-0.534-1.102-0.168-1.377c0.41-0.311,1.966-0.543,2.458-0.699c1.326-0.424-0.75-5.328-1.816-5.084
                        c-0.832,0.195-1.727,0.227-2.516,0.553c-0.134,0.057-0.238,0.16-0.359,0.24c-2.799,1.774-3.16,6.082-0.428,9.292
                        c1.041,1.228,2.127,2.416,3.245,3.576l-0.006,0.004c0.031,0.031,0.063,0.06,0.095,0.09c0.03,0.031,0.059,0.062,0.088,0.095
                        l0.006-0.006c1.16,1.118,2.535,2.765,4.769,4.255c4.703,3.141,8.312,2.264,10.438,1.098c3.67-2.021,5.312-6.338,5.312-9.719
                        C32.666,7.326,25.339,0,16.333,0z"/>
                    </svg>
                </div>
                
                <form class="contact-form" id="contactForm">
                    <input type="text" class="form-input" placeholder="Name" name="name" required>
                    <input type="email" class="form-input" placeholder="Email" name="email" required>
                    <textarea class="form-input" placeholder="Message" name="message" required></textarea>
                    <button type="submit" class="submit-btn">Submit</button>
                    
                    <div class="alert alert-success" id="successAlert">
                        Your message has been sent successfully!
                    </div>
                    
                    <div class="alert alert-error" id="errorAlert">
                        There was an error sending your message. Please try again.
                    </div>
                </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation for contact items
        document.addEventListener('DOMContentLoaded', function() {
            // Animate contact items one by one
            const contactItems = document.querySelectorAll('.contact-item');
            contactItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('visible');
                }, 300 * index);
            });

            // Hide phone SVG after 3 seconds
            setTimeout(() => {
                document.querySelector('.phone-svg').style.opacity = '0';
            }, 3000);

            // Show form after 4 seconds
            setTimeout(() => {
                document.querySelector('.contact-form').classList.add('visible');
            }, 4000);

            // Form submission handling
            const contactForm = document.getElementById('contactForm');
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');

            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Here you would normally send the form data to your server
                // For demo purposes, we'll simulate a successful submission
                const isSuccess = Math.random() > 0.2; // 80% chance of success for demo
                
                if (isSuccess) {
                    successAlert.style.display = 'block';
                    errorAlert.style.display = 'none';
                    contactForm.reset();
                } else {
                    errorAlert.style.display = 'block';
                    successAlert.style.display = 'none';
                }
                
                // Hide alerts after 5 seconds
                setTimeout(() => {
                    successAlert.style.display = 'none';
                    errorAlert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
</body>
</html>