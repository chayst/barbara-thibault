// GENERAL
// Defined in header currentNav = document.getElementsByTagName('meta')[0].getAttribute('name');

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