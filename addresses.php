<?php
session_start();
require 'components/connection.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch addresses from the database
$sql = "SELECT id, name, address, city, state, zip, phone, is_default FROM addresses WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $name, $address, $city, $state, $zip, $phone, $is_default);
$addresses = [];
while ($stmt->fetch()) {
    $addresses[] = ['id' => $id, 'name' => $name, 'address' => $address, 'city' => $city, 'state' => $state, 'zip' => $zip, 'phone' => $phone, 'is_default' => $is_default];
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="body">
    <?php
    include "components/header.php";
    ?>

    <div class="myaddress">

        <div class="sidenav">
            <h1>username</h1>
            <h2>omuk@gmail.com</h2>

            <div class="pages">
                <div class="box">
                    <a href="myprofile.php">
                        <img src="images/btn1.png" alt="Image 1">
                        My profile
                    </a>
                </div>
                <div class="box">
                    <a href="myorders.php">
                        <img src="images/btn2.svg" alt="Image 2">
                        Orders
                    </a>
                </div>
                <div class="box">
                    <a href="#">
                        <img src="images/btn3.svg" alt="Image 3">
                        Rewards
                    </a>
                </div>
                <div class="box clicked">
                    <a href="addresses.php">
                        <img src="images/btn4.svg" alt="Image 4">
                        Addresses
                    </a>
                </div>
                <div class="box">
                    <a href="change-password.php">
                        <img src="images/btn5.svg" alt="Image 5">
                        Change password
                    </a>
                </div>
                <div class="box">
                    <a href="faq.php">
                        <img src="images/btn6.svg" alt="Image 6">
                        FAQ
                    </a>
                </div>
                <div class="box last">
                    <a href="logout.php">
                        <img src="images/btn7.png" alt="Image 7">
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="overlay" id="overlay"></div>
        <section class="orders">
            <h2>Addresses</h2>
            <br>
            <hr><br>
            <div class="addresses">
                <a class="new-adrs" href="#" onclick="showForm('newAddressFormContainer')">
                    <img src="images/location.png" alt="">
                    Add new address
                </a>

                <div class="all-adrs" id="addressList">
                    <?php foreach ($addresses as $address) : ?>
                        <div class="an-adrs" data-id="<?php echo $address['id']; ?>">
                            <h3><?php echo htmlspecialchars($address['name']); ?></h3>
                            <br>
                            <p><?php echo htmlspecialchars($address['address']); ?></p>
                            <p><?php echo htmlspecialchars($address['city']); ?></p>
                            <p><?php echo htmlspecialchars($address['state']); ?></p>
                            <p><?php echo htmlspecialchars($address['zip']); ?></p>
                            <p><?php echo htmlspecialchars($address['phone']); ?></p>
                            <br><br>
                            <div class="edit-adrs">
                                <a href="#" onclick="editAddress(<?php echo $address['id']; ?>)"><img src="images/edit.png" alt=""></a>
                                <a href="#" onclick="confirmDelete(<?php echo $address['id']; ?>)"><img src="images/delete.png" alt=""></a>


                                <label class="container">
                                    <input type="checkbox" <?php echo $address['is_default'] ? 'checked' : ''; ?> onclick="setDefaultAddress(<?php echo $address['id']; ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 75 100" class="pin">
                                        <line stroke-width="6" stroke="#3a3a3a" y2="100" x2="37" y1="64" x1="37"></line>
                                        <path stroke-width="4" stroke="#3a3a3a" d="M16.5 36V4.5H58.5V36V53.75V54.9752L59.1862 55.9903L66.9674 67.5H8.03256L15.8138 55.9903L16.5 54.9752V53.75V36Z"></path>
                                    </svg>
                                </label>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <h3 id="modal-message-head">Delete address</h3>

                    <p id="modal-message">Are you sure you want to delete this address?</p>
                    <div class="btn">
                        <button id="confirm-button" class="modal-button confirm">Delete</button>
                        <button id="cancel-button" class="modal-button cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add New Address Form -->
        <div class="floating-form" id="newAddressFormContainer">
            <div class="floating-form-content">
                <h3>Add New Address</h3><br><br>
                <form id="newAddressForm">
                    <label class="label" for="newName">Name:</label>
                    <input type="text" id="newName" class="input-info" name="name" required><br><br>
                    <label class="label" for="newAddress">Address:</label>
                    <input type="text" id="newAddress" class="input-info" name="address" required><br><br>
                    <div style="width:100%; display: flex; justify-content: space-between;">
                        <div style="width:31%;">
                            <label class="label" for="newCity">City:</label><br>
                            <input type="text" id="newCity" class="smallinput" name="city" required>
                        </div>
                        <div style="width:31%;">
                            <label class="label" for="newState">State:</label><br>
                            <select class="smallinput" id="newState" name="state" placeholder="State" required>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Puducherry">Puducherry</option>
                            </select>
                        </div>
                        <div style="width:31%;">
                            <label class="label" for="newZip">Zip:</label><br>
                            <input type="text" id="newZip" class="smallinput" name="zip" required>
                        </div>
                    </div>
                    <br><br>

                    <label class="label" for="newPhone">Phone:</label>
                    <input type="text" id="newPhone" class="input-info" name="phone" required><br><br><br>
                    <div class="btn">
                        <button type="submit" class="newaddress confirm">Add Address</button>
                        <button type="button" class="newaddress cancel" onclick="hideForm('newAddressFormContainer')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Address Form -->
        <div class="floating-form" id="editAddressFormContainer">
            <div class="floating-form-content">
                <h3>Edit Address</h3>
                <form id="editAddressForm">
                    <input type="hidden" id="editAddressId" class="input-info" name="id">
                    <label class="label" for="editName">Name:</label>
                    <input type="text" id="editName" class="input-info" name="name" required><br><br>
                    <label class="label" for="editAddress">Address:</label>
                    <input type="text" id="editAddress" class="input-info" name="address" required><br><br>
                    <div style="width:100%; display: flex; justify-content: space-between;">
                        <div style="width:31%;">
                            <label class="label" for="editCity">City:</label>
                            <input type="text" id="editCity" class="smallinput" name="city" required>
                        </div>
                        <div style="width:31%;">
                            <label class="label" for="editState">State:</label>
                            <input type="text" id="editState" class="smallinput" name="state" required>
                        </div>
                        <div style="width:31%;">
                            <label class="label" for="editZip">Zip:</label>
                            <input type="text" id="editZip" class="smallinput" name="zip" required>
                        </div>
                    </div>
                    <br>
                    <label class="label" for="editPhone">Phone:</label>
                    <input type="text" id="editPhone" class="input-info" name="phone" required><br><br><br>
                    <div class="btn">
                        <button type="submit" class="newaddress confirm">Update Address</button>
                        <button type="button" class="newaddress cancel" onclick="hideForm('editAddressFormContainer')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>


        <script>
            let deleteAddressId = null;

            function confirmDelete(addressId) {
                deleteAddressId = addressId;
                document.getElementById('modal-message-head').innerText = 'Delete address';
                document.getElementById('modal-message').innerText = 'Are you sure you want to delete this address?';
                document.getElementById('modal').style.display = 'flex';
            }

            document.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('confirm-button').addEventListener('click', function() {
                    if (deleteAddressId !== null) {
                        $.ajax({
                            url: 'delete_address.php?id=' + deleteAddressId,
                            type: 'POST',
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data.success) {
                                    $('[data-id="' + deleteAddressId + '"]').remove();
                                } else {
                                    alert('Failed to delete address.');
                                }
                                document.getElementById('modal').style.display = 'none';
                            },
                            error: function() {
                                alert('Error in the request.');
                                document.getElementById('modal').style.display = 'none';
                            }
                        });
                    }
                });

                document.getElementById('cancel-button').addEventListener('click', function() {
                    document.getElementById('modal').style.display = 'none';
                });
            });

            // default set

            function setDefaultAddress(addressId) {
                $.ajax({
                    url: 'set_default_address.php',
                    type: 'POST',
                    data: {
                        id: addressId
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            // Uncheck all other checkboxes
                            document.querySelectorAll('.an-adrs input[type="checkbox"]').forEach(function(checkbox) {
                                checkbox.checked = false;
                            });
                            // Check the current checkbox
                            document.querySelector('.an-adrs[data-id="' + addressId + '"] input[type="checkbox"]').checked = true;
                        } else {
                            alert('Failed to set default address.');
                        }
                    },
                    error: function() {
                        alert('Error in the request.');
                    }
                });
            }

            // JavaScript code for handling new address and update address
            // Ensure that this code is placed within a DOMContentLoaded event listener or at the end of the HTML body

            // Function to display the form with the specified ID
            function showForm(formId) {
                document.getElementById(formId).style.display = 'block';
            }

            // Function to hide the form with the specified ID
            function hideForm(formId) {
                document.getElementById(formId).style.display = 'none';
            }

            // Event listener for form submission
            document.getElementById('newAddressForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                fetch('add_address.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var newAddress = document.createElement('div');
                            newAddress.classList.add('an-adrs');
                            newAddress.setAttribute('data-id', data.address.id);
                            newAddress.innerHTML = `
                    <h3>${data.address.name}</h3>
                    <br>
                    <p>${data.address.address}</p>
                    <p>${data.address.city}</p>
                    <p>${data.address.state}</p>
                    <p>${data.address.zip}</p>
                    <p>${data.address.phone}</p>
                    <br><br>
                    <div class="edit-adrs">
                        <a href="#" onclick="editAddress(${data.address.id})"><img src="images/edit.png" alt=""></a>
                        <a href="#"><img src="images/delete.png" alt=""></a>
                        <input type="checkbox" placeholder="Default">
                    </div>
                `;
                            document.getElementById('addressList').appendChild(newAddress);
                            hideForm('newAddressFormContainer');
                        } else {
                            alert('Failed to add address');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Function to handle editing an address
            function editAddress(addressId) {
                // Get the address details from the DOM
                var addressDiv = document.querySelector('.an-adrs[data-id="' + addressId + '"]');
                var name = addressDiv.querySelector('h3').textContent;
                var address = addressDiv.querySelector('p:nth-of-type(1)').textContent;
                var city = addressDiv.querySelector('p:nth-of-type(2)').textContent;
                var state = addressDiv.querySelector('p:nth-of-type(3)').textContent;
                var zip = addressDiv.querySelector('p:nth-of-type(4)').textContent;
                var phone = addressDiv.querySelector('p:nth-of-type(5)').textContent;

                // Populate the form with the current address details
                document.getElementById('editAddressId').value = addressId;
                document.getElementById('editName').value = name;
                document.getElementById('editAddress').value = address;
                document.getElementById('editCity').value = city;
                document.getElementById('editState').value = state;
                document.getElementById('editZip').value = zip;
                document.getElementById('editPhone').value = phone;

                // Show the edit form
                showForm('editAddressFormContainer');
            }

            // Event listener for edit address form submission
            document.getElementById('editAddressForm').addEventListener('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: 'update_address.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            // Update the address in the DOM
                            var addressId = document.getElementById('editAddressId').value;
                            var addressDiv = document.querySelector('.an-adrs[data-id="' + addressId + '"]');
                            addressDiv.querySelector('h3').textContent = document.getElementById('editName').value;
                            addressDiv.querySelector('p:nth-of-type(1)').textContent = document.getElementById('editAddress').value;
                            addressDiv.querySelector('p:nth-of-type(2)').textContent = document.getElementById('editCity').value;
                            addressDiv.querySelector('p:nth-of-type(3)').textContent = document.getElementById('editState').value;
                            addressDiv.querySelector('p:nth-of-type(4)').textContent = document.getElementById('editZip').value;
                            addressDiv.querySelector('p:nth-of-type(5)').textContent = document.getElementById('editPhone').value;

                            // Hide the edit form
                            hideForm('editAddressFormContainer');
                        } else {
                            alert('Failed to update address.');
                        }
                    },
                    error: function() {
                        alert('Error in the request.');
                    }
                });
            });
        </script>

</body>

</html>