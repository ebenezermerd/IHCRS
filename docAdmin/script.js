function slideButtons() {
  var leftButton = document.querySelector('.left-button');
  var rightButton = document.querySelector('.right-button');
  
  leftButton.style.left = '0';
  rightButton.style.right = '0';
}

// Call the slideButtons function after a delay
setTimeout(slideButtons, 500);
