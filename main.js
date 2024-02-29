// Add  Product 
$(document).ready(function () {
    // Add product form submission using AJAX
    $('#addProductForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'addProduct.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle response from server
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    // Display success message
                    var toast = new bootstrap.Toast($('.toast'));
                    $('.toast-body').text(responseData.message);
                    toast.show();
                    // Optionally, you can reload the page or perform other actions
                } else {
                    // Display error message
                    console.error('Error: ' + responseData.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

// Edit Product
$(document).ready(function () {
    // Edit product form submission using AJAX
    $('#editProductForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'editProduct.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle response from server
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    // Display success message
                    var toast = new bootstrap.Toast($('.toast'));
                    $('.toast-body').text(responseData.message);
                    toast.show();
                    // Optionally, you can reload the page or perform other actions
                } else {
                    // Display error message
                    console.error('Error: ' + responseData.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

// Delete Product
$(document).ready(function () {
    // Delete product using AJAX
    $('.deleteProductForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'deleteProduct.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle response from server
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    // Display success message
                    var toast = new bootstrap.Toast($('.toast'));
                    $('.toast-body').text(responseData.message);
                    toast.show();
                    // Optionally, you can reload the page or perform other actions
                } else {
                    // Display error message
                    console.error('Error: ' + responseData.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
});

// Read Product
function fetchProducts() {
    $.ajax({
        type: 'GET',
        url: 'readProduct.php', // PHP script to fetch products
        dataType: 'json',
        success: function (response) {
            // Update the webpage with the fetched products
            // For example, you can iterate over the products and create HTML elements to display them
            console.log(response); // Log the response for demonstration
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
