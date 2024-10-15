const userMenuButton = document.getElementById('user-menu-button');
const userMenu = document.getElementById('user-menu');

userMenuButton.addEventListener('click', function() {
  userMenu.classList.toggle('hidden');
});

document.addEventListener('click', function(event) {
  const isClickInside = userMenuButton.contains(event.target) || userMenu.contains(event.target);
  if (!isClickInside) {
    userMenu.classList.add('hidden');
  }
});

