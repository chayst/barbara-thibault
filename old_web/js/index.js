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


// INFOS
// Table of Content
if (currentNav.includes('info')) {
    const h1Titles = document.getElementsByTagName('h1');

    console.log(h1Titles)
    let infoTableOfContents = document.getElementById('infoTableOfContents');
    let h1TitlesHtml = "<ul>";
    for (var i = 1; i < h1Titles.length; i++) {
        h1TitlesHtml = h1TitlesHtml + "<li>" + h1Titles[i].innerText + "</li>";
    }
    h1TitlesHtml = h1TitlesHtml + "</ul>";

    infoTableOfContents.innerHTML = h1TitlesHtml;

    console.log(h1TitlesHtml)
}
