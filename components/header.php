<?php

require 'components/connection.php'; // Database connection

$isLoggedIn = false;
$username = '';

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT name FROM users_signup WHERE id = ?";
  $stmt = $conn->prepare($sql);
  if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
  }
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $stmt->bind_result($username);
  $stmt->fetch();
  $stmt->close();
  $isLoggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eclante</title>
  <link rel="icon" href="images/eclante logo.svg">
  <link rel="stylesheet" type="text/css" href="style.css?<?php echo filemtime('style.css'); ?>">
  <!-- Include Select2 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <script src="js/side-nav.js"></script>
  <!-- Include jQuery (required for Select2) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<div class="menu" id="menu">
  <nav>
    <div class="pages">

      <a href="index.php">About</a>
      <a href="shop-now.php">Products</a>
      <a href="myprofile.php">Account</a>

    </div>

    <label class="buttons__burger" for="burger">
      <input type="checkbox" id="burger">
      <span></span>
      <span style="right: 5px;"></span>
      <span></span>
    </label>
    <!-- side navigation links go here -->


    <ul id="menu-list">
      <h2>Hello!</h2>
      <?php if ($isLoggedIn) : ?>
        <h3><?php echo htmlspecialchars($username); ?></h3>

        <a class="margin-top" href="index.php">About</a>
        <hr>
        <a href="shop-now.php">Products</a>
        <hr>
        <a href="myprofile.php">Account</a>
        <hr>
        <span><a href="logout.php">Logout</a></span>
      <?php else : ?>
        <a class="margin-top" href="login.php">Login/Signup</a>
        <hr>
        <a href="index.php">About</a>
        <hr>
        <a href="shop-now.php">Products</a>
        <hr>
      <?php endif; ?>
    </ul>



    <!-- eclante logo in the middle of nav-->
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
    <div style="display: flex; align-items:center;">
      <a href="#" id="search-button"><img src="images/search-icon.svg" alt="Search"></a>
      <a href="cart.php" class="cart"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
          <path d="M15.1798 13.5936V19.9373C15.1798 20.1176 15.1082 20.2905 14.9808 20.418C14.8533 20.5454 14.6804 20.617 14.5002 20.617C14.3199 20.617 14.147 20.5454 14.0195 20.418C13.8921 20.2905 13.8205 20.1176 13.8205 19.9373V13.5936C13.8205 13.4133 13.8921 13.2404 14.0195 13.113C14.147 12.9855 14.3199 12.9139 14.5002 12.9139C14.6804 12.9139 14.8533 12.9855 14.9808 13.113C15.1082 13.2404 15.1798 13.4133 15.1798 13.5936ZM26.9475 11.0844L25.3752 22.8657C25.3244 23.2465 25.1371 23.5959 24.8481 23.849C24.5592 24.1022 24.1881 24.2418 23.8039 24.242H5.19637C4.81219 24.2418 4.44115 24.1022 4.15217 23.849C3.86319 23.5959 3.67592 23.2465 3.62516 22.8657L2.05395 11.0844C2.0241 10.8605 2.04243 10.6328 2.10771 10.4165C2.17299 10.2003 2.28372 10.0004 2.43248 9.83044C2.58125 9.66044 2.76461 9.52418 2.9703 9.43079C3.17599 9.3374 3.39926 9.28902 3.62516 9.28891H7.84828L13.9881 2.27113C14.0519 2.19881 14.1304 2.14089 14.2182 2.10121C14.3061 2.06153 14.4015 2.04102 14.4979 2.04102C14.5943 2.04102 14.6896 2.06153 14.7775 2.10121C14.8654 2.14089 14.9439 2.19881 15.0077 2.27113L21.1475 9.29457H25.3752C25.6011 9.29469 25.8243 9.34306 26.03 9.43645C26.2357 9.52985 26.4191 9.66611 26.5678 9.8361C26.7166 10.0061 26.8273 10.2059 26.8926 10.4222C26.9579 10.6384 26.9762 10.8662 26.9464 11.0901L26.9475 11.0844ZM9.65399 9.28891H19.3463L14.5002 3.75059L9.65399 9.28891ZM25.5451 10.7253C25.5238 10.7011 25.4977 10.6818 25.4684 10.6685C25.4391 10.6552 25.4073 10.6483 25.3752 10.6483H3.62516C3.5928 10.6482 3.56079 10.655 3.53128 10.6683C3.50178 10.6815 3.47546 10.701 3.4541 10.7253C3.43262 10.7495 3.41655 10.7779 3.40698 10.8088C3.3974 10.8397 3.39455 10.8722 3.3986 10.9043L4.96867 22.6855C4.97612 22.7402 5.00323 22.7902 5.04494 22.8263C5.08665 22.8624 5.14009 22.882 5.19524 22.8815H23.8039C23.8591 22.882 23.9125 22.8624 23.9542 22.8263C23.9959 22.7902 24.0231 22.7402 24.0305 22.6855L25.6017 10.9043C25.6062 10.8721 25.6034 10.8394 25.5936 10.8084C25.5838 10.7775 25.5672 10.7491 25.5451 10.7253ZM20.5494 12.9139C20.4606 12.905 20.3709 12.9136 20.2854 12.9394C20.1999 12.9651 20.1204 13.0074 20.0513 13.0639C19.9821 13.1204 19.9248 13.19 19.8826 13.2686C19.8404 13.3472 19.814 13.4334 19.8051 13.5222L19.1707 19.866C19.1609 19.9553 19.1688 20.0457 19.1941 20.132C19.2194 20.2182 19.2616 20.2986 19.3181 20.3685C19.3747 20.4383 19.4446 20.4963 19.5237 20.5389C19.6028 20.5816 19.6896 20.6081 19.7791 20.617H19.8482C20.0172 20.6179 20.1806 20.5557 20.3063 20.4426C20.4319 20.3294 20.5109 20.1735 20.5279 20.0053L21.1622 13.6616C21.1716 13.5721 21.1632 13.4817 21.1373 13.3956C21.1115 13.3095 21.0689 13.2293 21.0119 13.1598C20.9549 13.0902 20.8847 13.0327 20.8053 12.9905C20.7259 12.9483 20.6389 12.9223 20.5494 12.9139ZM9.1952 13.5256C9.17717 13.3463 9.08863 13.1814 8.94905 13.0673C8.80948 12.9532 8.6303 12.8993 8.45094 12.9173C8.27158 12.9353 8.10672 13.0239 7.99264 13.1634C7.87856 13.303 7.82459 13.4822 7.84262 13.6616L8.47699 20.0053C8.4939 20.1735 8.57291 20.3294 8.69859 20.4426C8.82427 20.5557 8.9876 20.6179 9.15668 20.617H9.22578C9.31459 20.6081 9.40078 20.5818 9.47941 20.5395C9.55805 20.4973 9.6276 20.44 9.68409 20.3709C9.74057 20.3018 9.7829 20.2222 9.80864 20.1368C9.83438 20.0513 9.84303 19.9616 9.8341 19.8728L9.1952 13.5256Z" fill="black" />
        </svg></a>

      <a href="favorites.php" class="fav"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
          <path d="M17.3828 3.32031C15.332 3.32031 13.5488 4.24512 12.5 5.79492C11.4512 4.24512 9.66797 3.32031 7.61719 3.32031C6.06374 3.32212 4.57444 3.94003 3.47598 5.03848C2.37753 6.13694 1.75962 7.62624 1.75781 9.17969C1.75781 12.0312 3.53516 14.999 7.04102 17.999C8.64751 19.3679 10.3828 20.578 12.2227 21.6123C12.3079 21.6581 12.4032 21.6821 12.5 21.6821C12.5968 21.6821 12.6921 21.6581 12.7773 21.6123C14.6172 20.578 16.3525 19.3679 17.959 17.999C21.4648 14.999 23.2422 12.0312 23.2422 9.17969C23.2404 7.62624 22.6225 6.13694 21.524 5.03848C20.4256 3.94003 18.9363 3.32212 17.3828 3.32031ZM12.5 20.4209C10.8975 19.4961 2.92969 14.6211 2.92969 9.17969C2.93098 7.93688 3.42526 6.74535 4.30405 5.86655C5.18285 4.98776 6.37438 4.49348 7.61719 4.49219C9.59766 4.49219 11.2607 5.5498 11.958 7.25293C12.0022 7.3604 12.0772 7.45231 12.1738 7.517C12.2703 7.58169 12.3838 7.61623 12.5 7.61623C12.6162 7.61623 12.7297 7.58169 12.8262 7.517C12.9228 7.45231 12.9978 7.3604 13.042 7.25293C13.7393 5.5498 15.4023 4.49219 17.3828 4.49219C18.6256 4.49348 19.8172 4.98776 20.6959 5.86655C21.5747 6.74535 22.069 7.93688 22.0703 9.17969C22.0703 14.6211 14.1025 19.4961 12.5 20.4209Z" fill="black" />
        </svg></a>
    </div>
    

    <div id="search-bar" class="hidden">
    <img src="images/search-icon.svg" alt="Search">
        <button id="close-search-bar" class="close-button">&times;</button>
        <input type="text" id="search-input" placeholder="Search for products...">
        <div id="suggestions-container">
            <!-- Static Search Suggestions -->
            <div id="static-suggestions">
                <h4>Popular Searches</h4>
                <ul>
                    <a href="shop-now.php" class="static-suggestion">Shop</a>
                    <a href="search-results.php?q=duo" class="static-suggestion">Duo</a>
                    <a href="search-results.php?q=radiance" class="static-suggestion">Radiance</a>
                    <a href="search-results.php?q=brilliance" class="static-suggestion">Brilliance</a>
                </ul>
            </div>
            <!-- Dynamic Product Suggestions -->
            <div id="suggestions"></div>
        </div>
        <button id="search-submit">Search for "<span id="search-term"></span>"</button>
    </div>


</div>
</div>
</nav>
</div>
<script>
  // search
  document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    const searchBar = document.getElementById('search-bar');
    const searchInput = document.getElementById('search-input');
    const suggestions = document.getElementById('suggestions');
    const closeSearchBarButton = document.getElementById('close-search-bar');
    const searchTerm = document.getElementById('search-term');
    const searchSubmit = document.getElementById('search-submit');

    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        searchBar.classList.toggle('show');
        searchInput.focus(); // Focus on the input when the search bar is shown
    });

    closeSearchBarButton.addEventListener('click', function(event) {
        event.preventDefault();
        searchBar.classList.remove('show');
    });

    searchInput.addEventListener('input', function() {
        const query = searchInput.value;
        searchTerm.textContent = query || ''; // Update the search term in the button
        if (query.length > 2) {
            fetchSuggestions(query);
        } else {
            suggestions.innerHTML = '';
        }
    });

    searchSubmit.addEventListener('click', function() {
        const query = searchInput.value;
        window.location.href = 'search-results.php?q=' + encodeURIComponent(query);
    });

    function fetchSuggestions(query) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'search.php?q=' + encodeURIComponent(query), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const results = JSON.parse(xhr.responseText).slice(0, 3);
                suggestions.innerHTML = results.map(result => 
                    `<div class="suggestion-item">
                        <a class="searched-item" href="product-page.php?id=${result.id}">
                            <img src="images/${result.image_url}" alt="${result.name}" class="suggestion-img">
                            <span class="suggestion-name">${result.name}</span>
                            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
                            <span class="suggestion-price">₹${result.actual_price}</span>
                            <span class="suggestion-mrp">₹${result.mrp}</span>
                            </div>
                        </a>
                    </div>`
                ).join('');
            }
        };
        xhr.send();
    }
});

</script>