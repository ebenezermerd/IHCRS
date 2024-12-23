const patientManagementMenu = document.querySelector(".patient-management");
const subMenus = patientManagementMenu.querySelectorAll("ul");

patientManagementMenu.addEventListener("click", function () {
  subMenus.forEach(function (subMenu) {
    subMenu.classList.toggle("hidden");
  });
});
const searchPatientMenu = document.querySelector(".search-patient");
const searchBar = document.querySelector(".search-bar");

searchPatientMenu.addEventListener("click", function () {
  searchBar.classList.toggle("hidden");
});