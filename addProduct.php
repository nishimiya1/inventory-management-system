<?php
include 'dbconnect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productName = $_POST['productName'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $expiryDate = $_POST['expiryDate'];
    $inventory = $_POST['inventory'];
    
    // Calculate inventory cost
    $inventoryCost = $price * $inventory;

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name']; // Get image file name
        
        // Move uploaded image to desired location
        move_uploaded_file($_FILES['image']['tmp_name'], "Images/" . $_FILES['image']['name']);
    } else {
        // Set default value if no image uploaded
        $image = "";
    }

    // Insert data into database
    $sql = "INSERT INTO products (name, unit, price, expiry_date, inventory, inventory_cost, image)
            VALUES ('$productName', '$unit', $price, '$expiryDate', $inventory, $inventoryCost, '$image')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to index.php with success message in URL
        header('location: index.php?status=success&type=add');
        exit();
    } else {
        // Return error response
        $response = array("status" => "error", "message" => "Error adding product: " . $conn->error);
        echo json_encode($response);
    }
}
?>


<!-- Add Product Modal -->
<div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-light" id="staticBackdropLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="addProduct.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName"
                            placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter unit" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            placeholder="Enter price" required>
                    </div>
                    <div class="form-group">
                        <label for="expiryDate">Date of Expiry</label>
                        <input type="date" class="form-control" id="expiryDate" name="expiryDate" required>
                    </div>
                    <div class="form-group">
                        <label for="inventory">Available Inventory</label>
                        <input type="number" class="form-control" id="inventory" name="inventory"
                            placeholder="Enter available inventory" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image: </label>
                        <input type="file" class="form-control-file" id="image" name="image" accept=".jpg, .jpeg, .png">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>