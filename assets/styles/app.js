/**
 * Page HOME
 */
let create_ad = document.getElementById("createAd");
let add_ad = document.getElementById("addAd");
let annuler = document.getElementById("annuler");

add_ad.addEventListener("click", function (e) {
  //toggle ajoute ou enlève la classe active
  create_ad.classList.toggle("active");
  if (create_ad.className == "active") {
    create_ad.style.height = "auto";
  } else {
    create_ad.style.height = "40px";
  }
});

annuler.addEventListener("click", function (e) {
  //toggle ajoute ou enlève la classe active
  create_ad.classList.toggle("active");
  if (create_ad.className == "active") {
    create_ad.style.height = "auto";
  } else {
    create_ad.style.height = "40px";
  }
});
