<?php 
  include("Includes/conn.php");
  include("Admin/functions/functions.php");
?>
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
        <a href="listing.php" class="btn btn-outline-primary mb-4">
            ← Back to Listings
        </a>

        <div class="row g-4">
           <?php 
             view_puppy_details();
           ?>
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