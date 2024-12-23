const HospitalManagementMenu = document.querySelector(".Hospital-management");
const subMenus = HospitalManagementMenu.querySelectorAll("ul");

HospitalManagementMenu.addEventListener("click", function () {
  subMenus.forEach(function (subMenu) {
    subMenu.classList.toggle("hidden");
  });
});
const searchHospitalMenu = document.querySelector(".search-Hospital");
const searchBar = document.querySelector(".search-bar");

searchHospitalMenu.addEventListener("click", function () {
  searchBar.classList.toggle("hidden");
});
