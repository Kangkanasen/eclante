        
function getCityName() {
    const zipCode = document.getElementById('zipCodeInput').value.trim();
    const apiUrl = `https://api.postalpincode.in/pincode/${zipCode}`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Check if data is not empty and has valid structure
            if (Array.isArray(data) && data.length > 0 && Array.isArray(data[0].PostOffice)) {
                const cityName = data[0].PostOffice[0].Name;
                const stateName = data[0].PostOffice[0].State;
                document.getElementById('cityInput').value = cityName; // Optional: Update city input value
                // Clear existing options
                const stateSelect = document.getElementById('stateSelect');
                stateSelect.innerHTML = '';
                // Create and append new option
                const option = document.createElement('option');
                option.value = stateName;
                option.textContent = stateName;
                stateSelect.appendChild(option);
            } else {
                throw new Error('Invalid or empty response data');
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            // Handle error if necessary
        });
}


// api ends here

// quantity

$(document).ready(function() {
    // Function to increase quantity
    $(document).on('click', '.plus', function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');
        var quantityInput = $('#quantity-form-' + productId + ' .quantity-input');
        var quantity = parseInt(quantityInput.val());
        quantity++;
        updateQuantity(productId, quantity);
    });

    // Function to decrease quantity
    $(document).on('click', '.minus', function(event) {
        event.preventDefault();
        var productId = $(this).data('product-id');
        var quantityInput = $('#quantity-form-' + productId + ' .quantity-input');
        var quantity = parseInt(quantityInput.val());
        if (quantity > 1) {
            quantity--;
            updateQuantity(productId, quantity);
        }
    });

    // Function to update quantity via AJAX
    function updateQuantity(productId, quantity) {
        $.ajax({
            url: 'update_cart.php',
            method: 'POST',
            data: { productId: productId, quantity: quantity },
            success: function(response) {
                // Update the input value after the server response
                $('#quantity-form-' + productId + ' .quantity-input').val(quantity);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});

// remove from cart

// Remove the product from cart database
function removeProduct(cartItemId) {
    if (confirm("Are you sure you want to remove this product from your cart?")) {
        // Send AJAX request to remove product from cart
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Reload the page to reflect changes
                    location.reload();
                } else {
                    console.error("Error removing product from cart.");
                }
            }
        };
        xhr.open("POST", "remove_from_cart.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("cartItemId=" + cartItemId);
    }
}




// radio button

    const paymentMethodRadios = document.querySelectorAll('input[name="paymentMethod"]');
    const paymentDetails = document.querySelectorAll('.payment-details');

    function togglePaymentDetails() {
      paymentDetails.forEach(element => {
        element.style.display = 'none';
      });

      const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
      document.getElementById(selectedPaymentMethod + 'Details').style.display = 'block';
    }

    paymentMethodRadios.forEach(radio => {
      radio.addEventListener('change', togglePaymentDetails);
    });

    
// Get all radio buttons with the name "paymentMethod"
const radioButtons = document.querySelectorAll('input[name="paymentMethod"]');

// Add event listener to each radio button
radioButtons.forEach(radioButton => {
  radioButton.addEventListener('change', function() {
    // Remove 'checked' class from all radioinput divs
    document.querySelectorAll('.radioinput').forEach(div => {
      div.classList.remove('checked');
    });

    // Add 'checked' class to the parent div of the selected radio button
    this.parentElement.classList.add('checked');
  });
});


    togglePaymentDetails(); // Show default payment details based on initial selection

