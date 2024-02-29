<?php
include 'dbconnect.php';

// Check if the form is submitted and the product ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productId'])) {
    // Get product ID to delete
    $productId = $_POST['productId'];

    // Retrieve the image file name from the database
    $sql_select_image = "SELECT image FROM products WHERE id = $productId";
    $result = $conn->query($sql_select_image);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageFileName = $row['image'];
        // Construct the file path
        $imageFilePath = "Images/$imageFileName";

        // Delete the image file from the images folder
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);
        }
    }

    // Construct SQL DELETE query
    $sql = "DELETE FROM products WHERE id = $productId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header('location: index.php?status=success');
        exit(); // Add this to prevent further execution of the script
    }  else {
        // Return error response
        $response = array("status" => "error", "message" => "Error deleting product: " . $conn->error);
        echo json_encode($response);
    }
}
?>
<div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalLabel"><i
                        class="bi bi-exclamation-octagon-fill text-danger"></i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="deleteProduct.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
                <div class="modal-body">

                    <h5 class="fw-lighter">Are you sure you want to delete this product?</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-light" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger fw-light">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>