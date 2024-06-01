// sliding nav js
document.addEventListener('DOMContentLoaded', function() {
    const burgerCheckbox = document.getElementById('burger');
    const menuList = document.getElementById('menu-list');
  
    // Set the initial state to hide the menu
    menuList.style.display = 'none';
  
    burgerCheckbox.addEventListener('change', function() {
      // Check if the checkbox is checked
      if (burgerCheckbox.checked) {
        // Show the side nav (set display to 'block' and adjust the position if needed)
        menuList.style.display = 'block';
        menuList.style.width = '50%';
        menuList.style.backgroundColor = 'white';
      } else {
        // Hide the side nav
        menuList.style.display = 'none';
      }
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    const appearingImage = document.getElementById('appearingImage');
  
    // Wait for a short delay before starting the fade-in effect
    setTimeout(function() {
      appearingImage.style.opacity = '1';
    }, 1000); // 1000 milliseconds (adjust as needed)
  });
  

