<main>
    <?php
        include 'addProduct.php';
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        ?>
    <!--Toast Message -->
    <div class="container mt-5 pt-5 d-flex align-items-start">
        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="toast-container position-fixed bottom-0 end-0 py-4">
            <div class="toast border-2" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto text-uppercase fw-light text-dark">Status</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body fw-lighter">
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <!--Product Listing -->
    <div class="container mb-5 mt-5 py-5">
        <div class=" row g-2 g-lg-4 pricing flex-column flex-md-row justify-content-md-center mb-3">
            <div class="col card card-pricing popular text-center px-3 mb-4 col-md-8 col-lg-6 col-xl-4">
                <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm fw-light">Product
                    Listing</span>
                <div class="bg-transparent card-header pt-4 border-0 position-relative">
                    <p class='fw-light text-muted' style="color: #282828; font-size:32px">Product</p>
                    <div class="bg-transparent card-header pt-4 border-0">
                        <div class="card-image-container view overlay">
                            <img class='mb-4 ml-2 img-fluid rounded card-img-top border-0'
                                style='object-fit:contain; background-color:#f0f0f0; height: 200px;' />
                        </div>
                    </div>
                </div>
                <div class="card-body product hover-blur pt-0">

                    <ul class='list-unstyled mb-4 '>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light text-danger'>
                                Units: <a
                                    class='h6 text-decoration-none fw-lighter text-primary text-center mb-0 fw-lighter'><i
                                        class="bi bi-info-circle-fill"></i></span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Price: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 d-flex justify-content-between fw-lighter'>₱</span>
                        </li></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Expiry date: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'>yyyy/mm/dd</span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Inventory: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'><i
                                        class="bi bi-box-seam-fill "></i></span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Inventory cost: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'>₱</span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-center fw-light'><button
                                    type="button" class="btn btn-outline-secondary mx-auto" data-bs-toggle="modal"
                                    data-bs-target="#addProduct">Add Product</button></span>
                        </li>
                    </ul>

                </div>

            </div>
            <!--Display product -->
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>

            <div class="col card card-pricing popular text-center px-3 mb-4 col-md-8 col-lg-6 col-xl-4">
                <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-dark text-white shadow-sm fw-light">New
                    Item</span>
                <div class="bg-transparent card-header pt-4 border-0 position-relative">
                    <p class='fw-light text-muted' style="color: #282828; font-size:32px">
                        <?php echo $row["name"]; ?></p>
                    <div class="bg-transparent card-header head hover-blur pt-4 border-0">
                        <div class="card-image-container view overlay">
                            <img src="Images/<?php echo $row["image"];?>"
                                class='mb-4 ml-2 img-fluid img-thumbnail rounded card-img-top border-0'
                                style='object-fit:contain;' />
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-around text-center">
                        <!-- Edit Modal -->
                        <!-- Edit Button trigger modal -->
                        <?php include 'editProduct.php'; ?>
                        <button type="button"
                            class="position-relative bg-transparent border-0 bottom-0 mt-3 me-2 text-primary"
                            data-bs-toggle="modal" id="edit" data-bs-target="#editModal<?php echo $row['id']; ?>">
                            Edit
                        </button>
                        <!-- Delete Modal -->
                        <!-- Delete Button trigger modal -->
                        <?php include 'deleteProduct.php';?>
                        <button type="button"
                            class="position-relative bg-transparent border-0 bottom-0 mt-3 me-2 text-danger"
                            data-bs-toggle="modal" id="delete" data-bs-target="#deleteModal<?php echo $row['id']; ?>">
                            Delete
                        </button>
                    </div>
                </div>
                <div class="card-body product hover-blur pt-0">

                    <ul class='list-unstyled mb-4 '>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light text-danger'>
                                Units: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'><?php echo $row["unit"]; ?></span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Price: <a
                                    class='h6 text-decoration-none text-primary text-center mb-0 d-flex justify-content-between fw-lighter'>₱<?php echo $row["price"]; ?></span>
                        </li></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Expiry date: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'><?php echo $row["expiry_date"]; ?></span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Inventory: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'><?php echo $row["inventory"]; ?></span></a>
                        </li>
                        <li>
                            <span class='h6 text-muted ml-2 d-flex justify-content-between fw-light'>
                                Inventory cost: <a
                                    class='h6 text-decoration-none  text-primary text-center mb-0 fw-lighter'>₱<?php echo $row["inventory_cost"]; ?></span></a>
                        </li>
                    </ul>
                </div>

            </div>
            <?php
                    }
                } else {
                 
                }
                ?>
        </div>
    </div>

</main>