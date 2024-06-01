<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>
<form class="info cart-page" action="ordered.php" method="post">

    <nav>
        <a href="index.php" class="eclante-logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="103" height="20" viewBox="0 0 103 20" fill="none">
                <path d="M97.1471 3.37252C98.3221 3.37252 99.5405 3.5901 100.607 4.06878C101.651 4.56922 103 5.5701 103 6.83207C103 7.81119 102.326 8.55097 101.107 8.52921C102.043 5.89647 99.8669 3.72065 97.1471 3.72065C93.9487 3.72065 91.3159 6.61449 90.859 10.3787C91.49 9.55185 92.4473 9.29075 93.3394 9.31251C94.9713 9.31251 96.4073 10.4439 97.9304 10.6398C98.7137 10.7268 99.6493 10.5962 99.8451 9.6824C100.346 11.6406 98.9095 12.5762 97.1471 12.3151C95.3194 12.0105 93.6005 10.2916 92.0557 10.2916C91.2506 10.3134 90.7937 10.7268 90.7937 11.5318C90.8155 14.5345 92.1862 17.1455 94.188 18.451C97.2777 20.4527 100.977 18.8208 103 16.0576V17.8852C101.521 19.0602 99.4317 19.6912 97.1471 19.6912C92.6649 19.6912 88.9878 16.0576 88.9878 11.5318C88.9878 7.0279 92.6432 3.37252 97.1471 3.37252ZM97.1471 2.41516L97.8434 0H99.3882L97.4952 2.41516H97.1471Z" fill="black" />
                <path d="M89.1787 3.37256V5.20025C87.5468 4.59102 86.3066 3.78597 83.7391 3.72069V19.6912H81.9332V3.72069C79.3657 3.78597 78.1255 4.59102 76.4937 5.20025V3.37256H89.1787Z" fill="black" />
                <path d="M74.0073 19.6912H73.6809C73.5721 15.4701 65.0647 7.15849 61.6486 3.72069C61.6922 11.3361 62.519 14.9262 63.1282 19.6912H61.3223V3.37256H63.7374C66.9794 6.70156 70.8088 10.4005 73.5286 14.491C73.2675 9.94353 72.6583 7.00618 72.2014 3.37256H74.0073V19.6912Z" fill="black" />
                <path d="M52.2279 3.37256L59.5387 19.6912H57.5587L54.8607 13.7077C54.8607 16.7539 52.9242 19.6912 49.3776 19.6912C46.5055 19.6912 44.7431 17.6677 45.0477 14.9262C45.2653 12.9244 46.5055 11.075 47.5934 9.4431C48.9207 7.4631 49.9216 5.83124 50.2262 3.37256H52.2279ZM54.3602 12.598L50.4873 3.96003C50.1609 5.76596 49.3994 7.33255 48.4855 8.94266C47.5064 10.6833 46.2009 12.8374 46.4185 14.9044C46.6361 17.0585 48.3332 18.5815 50.8572 18.1246C53.0112 17.7547 55.2958 14.6651 54.3602 12.598Z" fill="black" />
                <path d="M31.6812 19.6912V3.37256H33.4871V19.3648C38.2086 19.3431 40.4062 18.5163 43.3218 17.8853V19.6912H31.6812Z" fill="black" />
                <path d="M23.3302 3.37256C24.5052 3.37256 25.7236 3.59014 26.7898 4.06882C27.8342 4.56926 29.1832 5.57014 29.1832 6.83211C29.1832 7.81123 28.5087 8.55101 27.2902 8.52925C28.2258 5.89651 26.05 3.72069 23.3302 3.72069C19.8272 3.72069 16.9768 7.22376 16.9768 11.5319C16.9768 14.5345 18.3694 17.1455 20.3711 18.451C23.4608 20.4527 27.1597 18.8209 29.1832 16.0576V17.8853C27.7036 19.0602 25.6148 19.6912 23.3302 19.6912C18.848 19.6912 15.1709 16.0576 15.1709 11.5319C15.1709 7.02794 18.8263 3.37256 23.3302 3.37256Z" fill="black" />
                <path d="M8.15932 3.37256C9.33427 3.37256 10.5527 3.59014 11.6189 4.06882C12.6633 4.56926 14.0123 5.57014 14.0123 6.83211C14.0123 7.81123 13.3378 8.55101 12.1193 8.52925C13.0549 5.89651 10.8791 3.72069 8.15932 3.72069C4.96087 3.72069 2.32813 6.61453 1.87121 10.3787C2.50219 9.55189 3.45955 9.29079 4.35164 9.31255C5.9835 9.31255 7.41955 10.444 8.94262 10.6398C9.72591 10.7268 10.6615 10.5963 10.8573 9.68244C11.3578 11.6407 9.92174 12.5763 8.15932 12.3152C6.33164 12.0106 4.61274 10.2917 3.06791 10.2917C2.26285 10.3134 1.80593 10.7268 1.80593 11.5319C1.82769 14.5345 3.19845 17.1455 5.20021 18.451C8.28987 20.4527 11.9888 18.8209 14.0123 16.0576V17.8853C12.5327 19.0602 10.4439 19.6912 8.15932 19.6912C3.67714 19.6912 0 16.0576 0 11.5319C0 7.02794 3.65538 3.37256 8.15932 3.37256Z" fill="black" />
            </svg></a>

        <a href="favorite"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                <path d="M17.3828 3.32031C15.332 3.32031 13.5488 4.24512 12.5 5.79492C11.4512 4.24512 9.66797 3.32031 7.61719 3.32031C6.06374 3.32212 4.57444 3.94003 3.47598 5.03848C2.37753 6.13694 1.75962 7.62624 1.75781 9.17969C1.75781 12.0312 3.53516 14.999 7.04102 17.999C8.64751 19.3679 10.3828 20.578 12.2227 21.6123C12.3079 21.6581 12.4032 21.6821 12.5 21.6821C12.5968 21.6821 12.6921 21.6581 12.7773 21.6123C14.6172 20.578 16.3525 19.3679 17.959 17.999C21.4648 14.999 23.2422 12.0312 23.2422 9.17969C23.2404 7.62624 22.6225 6.13694 21.524 5.03848C20.4256 3.94003 18.9363 3.32212 17.3828 3.32031ZM12.5 20.4209C10.8975 19.4961 2.92969 14.6211 2.92969 9.17969C2.93098 7.93688 3.42526 6.74535 4.30405 5.86655C5.18285 4.98776 6.37438 4.49348 7.61719 4.49219C9.59766 4.49219 11.2607 5.5498 11.958 7.25293C12.0022 7.3604 12.0772 7.45231 12.1738 7.517C12.2703 7.58169 12.3838 7.61623 12.5 7.61623C12.6162 7.61623 12.7297 7.58169 12.8262 7.517C12.9228 7.45231 12.9978 7.3604 13.042 7.25293C13.7393 5.5498 15.4023 4.49219 17.3828 4.49219C18.6256 4.49348 19.8172 4.98776 20.6959 5.86655C21.5747 6.74535 22.069 7.93688 22.0703 9.17969C22.0703 14.6211 14.1025 19.4961 12.5 20.4209Z" fill="black" />
            </svg></a>
    </nav>
    <div class="cart-page">
        <section class="checkout">
            <p class="express-checkout">express checkout</p>

            <div class="quickpay">
                <button name="paymentMethod" value="Shop Pay"><img src="images/Link - Shop Pay.png" alt=""></button>
                <button name="paymentMethod" value="Google Pay"><img src="images/Button - Google Pay.png" alt=""></button>
                <button name="paymentMethod" value="Venmo"><img src="images/div._Zhco (1).png" alt=""></button>
                <button name="paymentMethod" value="PayPal"><img src="images/div._Zhco.png" alt=""></button>
            </div>
            <div class="or">
                <hr>
                <p>or</p>
                <hr>
            </div>

            <label class="label" for="delivery">Delivery</label>
            <!-- <select name="country" id="country">
                <option value="india">India</option>
                <option value="united states">United States</option>
                <option value="japan">Japan</option>
            </select> -->
            <input class="input-info" type="text" name="name" placeholder="Name" required>
            <input class="input-info" type="text" name="address" placeholder="Address" required>
            <div style="width:90%; display: flex; justify-content: space-between;">
                <input class="smallinput" type="text" name="city" id="cityInput" placeholder="City" required>
                <select class="smallinput" id="stateSelect" name="state" placeholder="State" required>
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
                <input name="zip_code" class="smallinput" type="text" id="zipCodeInput" placeholder="Zip Code" required oninput="getCityName()" required>

            </div>

            <input class="input-info" type="text" name="phone" placeholder="Phone">

            <label class="label" for="payment">Payment</label>
            <p style="margin: 6px 0px;">All transactions are secure and encrypted.</p>
            <div class="pay">
                <div class="radioinput">
                    <input type="radio" id="creditCard" name="paymentMethod" value="creditCard">
                    <label for="creditCard">Credit Card</label>
                    <div style="width: 4%; "><img src="images/card.png" alt=""></div>
                </div>

                <div id="creditCardDetails" class="payment-details">
                    <input type="text" id="cardNumber" name="cardNumber" placeholder="Card number"><br>
                    <div style="display: flex; gap: 2%;"><input type="text" placeholder="Expiration date (MM / YY)"><input type="text" placeholder="Security code"></div>
                    <input type="text" placeholder="Name on card">
                    <div class="check"><input type="checkbox">
                        <p>Use shipping address as billing address</p>
                    </div>
                    <!-- <button id="pay" type="submit">pay</button> -->
                </div>

                <div class="radioinput">
                    <input type="radio" id="paypal" name="paymentMethod" value="paypal">
                    <label for="upi">UPI</label>
                    <div style="width: 4%;"><img src="images/upi_logo_icon_170312.png" alt=""></div>
                </div>

                <div id="paypalDetails" class="payment-details">
                    <input type="email" id="paypalEmail" name="paypalEmail" placeholder="Enter your UPI ID"><button class="verify">Verify</button>
                    <br>
                    <!-- <button id="pay" type="submit">pay</button> -->
                    <!-- Add more fields for PayPal details -->
                </div>

                <div class="radioinput">
                    <input type="radio" id="cashOnDelivery" name="paymentMethod" value="cashOnDelivery">
                    <label for="cashOnDelivery">Cash on Delivery</label><br>
                </div>

                <div id="cashOnDeliveryDetails" class="payment-details">
                    <!-- <button id="pay" type="submit" style="margin: 0% 2%;">Pay with Cash</button> -->
                    <p>No additional details required.</p>
                </div>
            </div>



        </section>
        <section class="cart">
            <?php
            require 'components/connection.php';

            $subtotal = 0;
            $discount = 0;

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $sql = "SELECT * FROM `cart` WHERE `user_id` = '$userId'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $productId = $row['product_id'];
                        $productQuery = "SELECT * FROM `products` WHERE `id` = '$productId'";
                        $productResult = mysqli_query($conn, $productQuery);

                        if (mysqli_num_rows($productResult) > 0) {
                            $productData = mysqli_fetch_assoc($productResult);

                            echo "<div class='product-display'>";
                            echo "<div class='product-display-img'><img src='images/" . $productData['image_url'] . "' alt=''></div>";
                            echo "<div style='display: flex; flex-direction: column; width: 80%;'>";
                            echo "<h2>" . $productData['name'] . "</h2>";
                            echo "<br>";
                            echo "<div style='display: flex; align-items: center;'>";
                            echo '
                    <div class="quantity" id="quantity-form-' . $row['product_id'] . '">
                        <span class="plus" data-product-id="' . $row['product_id'] . '">+</span>
                        <input a class="quantity-input" type="text" value="' . $row['quantity'] . '" data-product-id="' . $row['product_id'] . '">
                        <span class="minus" data-product-id="' . $row['product_id'] . '">-</span>
                    </div>';
                            echo "<span class='remove-btn' onclick='removeProduct(" . $row['id'] . ")'>Remove</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "<h2>₹" . $row['price'] . "</h2>";
                            echo "</div>";

                            $subtotal += ($row['price'] * $row['quantity']);
                        }
                    }
                } else {
                    echo "<script>location.href='empty-cart.php'</script>";
                }
            } else {
                echo "<script>location.href='login.php'</script>";
            }

            $total = $subtotal - $discount;
            ?>

            <div class="final-amount">
                <div class="final-amount-row">
                    <h2>Subtotal</h2>
                    <h2><?php echo "₹" . $subtotal; ?></h2>
                </div>
                <div class="final-amount-row">
                    <h2>Discount</h2>
                    <h2>- ₹<?php echo $discount; ?></h2>
                </div>
                <div class="final-amount-row">
                    <h2><span>Total</span></h2>
                    <h2><span>₹<?php echo $total; ?></span></h2>
                </div>
            </div>
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button id="pay" type="submit">Pay</button>
        </section>

    </div>
</form>
<?php
include "components/footer.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/cart.js"></script>