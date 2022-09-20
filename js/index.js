// GENERAL
// Navigation
let navParents = document.getElementsByClassName('navParentOff');

var displayNavChild = function() {
    this.classList.replace("navParentOff", "navParentOn");
    this.children[1].classList.replace("navChildOff", "navChildOn");
}

var undisplayNavChild = function() {
    this.classList.replace("navParentOn", "navParentOff");
    this.children[1].classList.replace("navChildOn", "navChildOff");
}

for (var i = 0; i < navParents.length; i++) {
    navParents[i].addEventListener('mouseenter', displayNavChild);
}

for (var i = 0; i < navParents.length; i++) {
    navParents[i].addEventListener('mouseleave', undisplayNavChild);
}

// HOME PAGE
// Jours Restants
const weddingDate = new Date(2023, 5, 20);
const today = new Date();
const elapsedTime = weddingDate.getTime() - today.getTime();
const daysLeft = Math.floor(elapsedTime/(1000*3600*24));

document
.getElementById("daysLeft")
.innerText = daysLeft;