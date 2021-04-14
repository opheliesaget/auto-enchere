/**
 * Page PROFIL
 */
let modifBtn = document.getElementById("modifBtn");
let modification = document.getElementById("modification");
let annulermodif = document.getElementById("annulermodif");

modifBtn.addEventListener("click", function (e) {
  //toggle ajoute ou enlève la classe active
  //modification.classList.toggle("active");
  if (modification.style.display == "none") {
    console.log("ok");
    modification.style.display = "block";
  } else {
    modification.style.display = "none";
    console.log("nok");
  }
});

annulermodif.addEventListener("click", function (e) {
  //toggle ajoute ou enlève la classe active
  //modification.classList.toggle("active");
  console.log("test");
  if (modification.style.display == "none") {
    console.log("ok");
    modification.style.display = "block";
  } else {
    modification.style.display = "none";
  }
});
