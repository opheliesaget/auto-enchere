/**
 * Page AFFICHAGE DES ANNONCES
 */
let btnInfoSeller = document.getElementById("btnInfoSeller");
let infoSellerHide = document.getElementById("infoSellerHide");

btnInfoSeller.addEventListener("click", function (e) {
  //toggle ajoute ou enlève la classe active
  //modification.classList.toggle("active");
  if (infoSellerHide.style.display == "none") {
    console.log("ok");
    infoSellerHide.style.display = "block";
  } else {
    infoSellerHide.style.display = "none";
    console.log("nok");
  }
});
