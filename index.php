<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Inventory</title>
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
</head>

<body>
   <!--Main Class-->
   <?php include 'viewProduct.php';?>
    <!--Footer Class-->
    <?php include 'footer.php';?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="main.js"></script>
    <script src="toastMessage.js"><sc/
    <script>
        // Call the function to fetch products when the document is ready
        $(document).ready(function () {
            fetchProducts();
        });
    </script>
   
</body>

</html>