document
  .getElementById("notificationIcon")
  .addEventListener("click", function () {
    var dropdown = document.getElementById("notificationDropdown");
    if (dropdown.classList.contains("hidden")) {
      dropdown.classList.remove("hidden");
    } else {
      dropdown.classList.add("hidden");
    }
  });

// Optionally, close the dropdown if clicked outside
document.addEventListener("click", function (event) {
  var notificationIcon = document.getElementById("notificationIcon");
  var dropdown = document.getElementById("notificationDropdown");
  if (
    !notificationIcon.contains(event.target) &&
    !dropdown.contains(event.target)
  ) {
    dropdown.classList.add("hidden");
  }
});
