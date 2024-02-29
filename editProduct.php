<?php
include 'dbconnect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productId = $_POST['productId']; // Product ID to identify which product to update
    $productName = $_POST['productName'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $expiryDate = $_POST['expiryDate'];
    $inventory = $_POST['inventory'];
    
    // Calculate inventory cost
    $inventoryCost = $price * $inventory;

    // Handle image upload (if required)
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_temp, "Images/$image");
    } else {
        // If no new image is uploaded, retain the existing image filename
        $image = $_POST['currentImage'];
    }

    // Update data in the database
    $sql = "UPDATE products 
            SET name = '$productName', unit = '$unit', price = $price, expiry_date = '$expiryDate', inventory = '$inventory', inventory_cost = $inventoryCost, image = '$image'
            WHERE id = $productId";

    if ($conn->query($sql) === TRUE) {
        header('location: index.php?status=success&type=edit');
        exit();
    } else {
        // Return error response
        $response = array("status" => "error", "message" => "Error editing product: " . $conn->error);
        echo json_encode($response);
    }
}

// Fetch the product details for editing
if(isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found!";
    }
}
?>

<!-- Edit Modal -->
<div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="editProduct.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="currentImage" value="<?php echo $row['image']; ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="productName" class="fw-light">Product Name</label>
                        <input type="text" class="form-control fw-lighter" id="productName" name="productName"
                            value='<?php echo $row['name']; ?>'>
                    </div>
                    <!-- Other input fields for product details -->
                    <div class="form-group">
                        <label for="unit" class="fw-light">Unit</label>
                        <input type="text" class="form-control fw-lighter" id="unit" name="unit"
                            value='<?php echo $row['unit']; ?>'>
                    </div>
                    <div class="form-group">
                        <label for="price" class="fw-light">Price</label>
                        <input type="number" step="0.01" class="form-control fw-lighter" id="price" name="price"
                            value='<?php echo $row['price']; ?>'>
                    </div>
                    <div class="form-group">
                        <label for="expiryDate" class="fw-light">Date of Expiry</label>
                        <input type="date" class="form-control fw-lighter" id="expiryDate" name="expiryDate"
                            value='<?php echo $row['expiry_date']; ?>'>
                    </div>
                    <div class="form-group">
                        <label for="inventory" class="fw-light">Available Inventory</label>
                        <input type="number" class="form-control fw-lighter" id="inventory" name="inventory"
                            value='<?php echo $row['inventory']; ?>'>
                    </div>
                    <!-- Display calculated inventory cost -->
                    <div class="form-group">
                        <label for="inventoryCost" class="fw-light">Inventory Cost</label>
                        <input type="text" class="form-control fw-lighter" id="inventoryCost" name="inventoryCost"
                            value='<?php echo $row['inventory_cost']; ?>' readonly>
                    </div>
                    <!-- Input field for image -->
                    <div class="form-group">
                        <label for="image" class="fw-light">Image: </label>
                        <input type="file" class="form-control-file fw-lighter" id="image" name="image">
                    </div>
                    <small class="text-muted text-center">Leave empty if you don't want to change the image.</small>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>