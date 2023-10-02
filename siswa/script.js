const burger = document.getElementById("burger");
const link = document.getElementById("link");
const label = document.getElementById("label");

label.addEventListener("click", () => {
  if (burger.checked) {
    link.classList.add("grid");
  } else {
    link.classList.remove("grid");
  }
});
