// Initialize toast
var toastElList = [].slice.call(document.querySelectorAll('.toast'));
var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl);
});

// Show the toast
toastList.forEach(toast => toast.show());

// Function to display success toast message based on operation type
function displaySuccessToast(type) {
    var successMessage = "";
    switch (type) {
        case 'edit':
            successMessage = "Product updated successfully";
            break;
        case 'add':
            successMessage = "Product added successfully";
            break;
        default:
            successMessage = "Product deleted successfully";
    }
    document.querySelector('.toast-body').innerText = successMessage;
    toastList.forEach(toast => toast.show());
}


// Check for status parameter in URL and show toast if present
const urlParams = new URLSearchParams(window.location.search);
const status = urlParams.get('status');
const type = urlParams.get('type'); // Get the operation type parameter
if (status === 'success') {
    displaySuccessToast(type);
}
