<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="add-pet.css">
    <title>Pets</title>
</head>
<body>
<div class="registration-form">
        <div class="form-header">
            <h3 class="form-title">Add Pet</h3>
        </div>
        <div class="form-body">
            <form>
                <div class="mb-3">
                    <label for="PetName" class="form-label">Pet's Name</label>
                    <input type="text" class="form-control" id="PetName" required>
                </div>
                <div class="mb-3">
                    <label for="Breed" class="form-label">Breed</label>
                    <input type="Text" class="form-control" id="Breed" required>
                </div>
                <div class="mb-3">
                    <label for="PetAge" class="form-label">Age</label>
                    <input type="number" class="form-control" id="PetAge" required>
                </div>
                <div class="mb-3">
                    <label for="sellerLocation" class="form-label">Location</label>
                    <select class="form-control" id="sellerLocation" required>
                        <option value="">Select your location</option>
                        <option value="nairobi">Nairobi</option>
                        <option value="mombasa">Mombasa</option>
                        <option value="kisumu">Kisumu</option>
                        <option value="nakuru">Nakuru</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sellerPhone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="sellerPhone" required>
                </div>
                <button type="submit" class="btn submit-btn">Add Pet</button>
            </form>
        </div>
    </div>
</body>
</html>