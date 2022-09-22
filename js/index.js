// GENERAL
// Defined in header currentNav = document.getElementsByTagName('meta')[0].getAttribute('name');

// HOME PAGE
// Jours Restants
const weddingDate = new Date(2023, 5, 20);
const today = new Date();
const elapsedTime = weddingDate.getTime() - today.getTime();
const daysLeft = Math.floor(elapsedTime/(1000*3600*24));

console.log(document.getElementById("daysLeft"))

if (currentNav == 'home_br' || currentNav == 'index') {
    document
    .getElementById("daysLeft")
    .innerText = daysLeft;
}



// ORGANISATION PAGE
// Trips images
if (currentNav.includes('trips')) {
    let tripImages = document.getElementsByClassName('smallTripImage');

    let changeTripImage = function() {
       if (this.classList.contains("smallTripImage")) {
            this.classList.replace("smallTripImage", "largeTripImage");
        } else if (this.classList.contains("largeTripImage")) {
            this.classList.replace("largeTripImage", "smallTripImage");
        }
    }

    for (var i = 0; i < tripImages.length; i++) {
        tripImages[i].addEventListener('click', changeTripImage);
    }
}