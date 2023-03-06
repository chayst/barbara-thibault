// Variable declaration for the header template
let currentNav = document.getElementsByTagName('meta')[0].getAttribute('name');

let root = '/';
let languageNav = '';
let redirectFR = '';
let redirectBR = '';

//name titles to default french
let homeTitle = 'Accueil';
let historyTitle = 'Les Mariés';
let relativesTitle = 'Nos Proches';
let witnessesTitle = 'Nos Témoins';
let parentsTitle = 'Nos Parents';
let childrenTitle = 'Nos Enfants d\'Honneur';
let specialsTitle = 'Personnes Spéciales';
let organisationTitle = 'Organisation';
let infoTitle = "Informations Pratiques";
let programTitle = 'Cérémonie';
let tripsTitle = 'Voyages';
let dresscodeTitle = 'Dress Code';
let presentsTitle = 'Liste de Cadeaux';
let presenceTitle = 'Confirmez votre présence';
let commentTitle = 'Livre d\'Or';




//MENU MANAGEMENT
//initialize values
let homeStatus = '';
let historyStatus = '';
let relativesStatus = '';
let organisationStatus = '';
let dresscodeStatus = '';
let presentsStatus = '';
let presenceStatus = '';
let commentStatus = '';
//decision of which menu is on focus
if (currentNav.includes('home')) {
    homeStatus = "id='currentNav'";
} else if (currentNav.includes('history')) {
    historyStatus = "id='currentNav'";
} else if (currentNav.includes('relatives') || currentNav.includes('rel/')) {
    relativesStatus = "id='currentNav'";
} else if (currentNav.includes('dresscode')) {
    dresscodeStatus = "id='currentNav'";
} else if (currentNav.includes('presents')) {
    presentsStatus = "id='currentNav'";
} else if (currentNav.includes('presence')) {
    presenceStatus = "id='currentNav'";
} else if (currentNav.includes('organisation') || currentNav.includes('org/')) {
    organisationStatus = "id='currentNav'";
} else if (currentNav.includes('comment')) {
    commentStatus = "id='currentNav'";
}




// IF ON FRENCH WEBSITE - Conditions of attributions when on french pages
if (currentNav.includes('_fr')) {
    redirectFR = root + currentNav.slice(0, -3);
    redirectBR = root + 'br/' + currentNav.slice(0, -3);
}

// IF ON BRAZILIAN WEBSITE - Conditions of attributions when on portuguese pages
if (currentNav.includes('_br')) {
    //rename nav items
    homeTitle = 'Home';
    historyTitle = 'Os Noivos';
    relativesTitle = 'Nossos pais e padrinhos';
    witnessesTitle = 'Nossos Padrinhos';
    parentsTitle = 'Nossos Pais';
    childrenTitle = 'Nossas Daminhas e nossos Pajens';
    specialsTitle = 'Pessoas Especiais';
    organisationTitle = 'Programação';
    infoTitle = 'Informações gerais';
    programTitle = 'Cerimônia';
    tripsTitle = 'Roteiros';
    dresscodeTitle = 'Dress Code';
    presentsTitle = 'Lista de presentes';
    presenceTitle = 'Confirme sua presença';
    commentTitle = 'Mensagem aos noivos';

    //have the right redirections
    redirectBR = root + currentNav.slice(0, -3);
    redirectFR = root + '../' + currentNav.slice(0, -3);

    //add language localisation to stay on br pages
    languageNav = 'br/';
}






// TEMPLATE CREATION
const headerTemplate = document.createElement('template');

headerTemplate.innerHTML = `
        <style>
        *
        {
            color: var(--dark);
        }

        /* --- HEADER */
        header
        {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding-top: 20px;
            padding-bottom: 20px;
            box-shadow: 0px 0px 10px 0px #111;
            background-color: var(--light);
        }

        /* - Top */
        #topHeader
        {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        #languageMenu
        {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        #languageMenu:nth-child(2)
        {
            margin-left: 2px;
            margin-right: 2px;
        }



        /* - Navigation */
        nav ul
        {
            display: flex;
            flex-direction: row;
            list-style-type: none;
            justify-content: center;
        }
        
        nav li
        {
            display: inline-block;
            text-transform: uppercase;
            text-align: center;
            padding-right: 5px;
            padding-left: 5px;
        }
        
        nav a
        {
            display: block;
            padding: 3px 5px;
            text-decoration: none;
        }
        
        nav a:hover, nav a:active
        {
            background-color: var(--dark);
            color: var(--light);
        }
        
        nav ul > li + li
        {
            border-left: 1px solid;
        }
        
        #currentNav
        {
            background-color: var(--dark);
            color: var(--light);
        }
        
        li.navParentOff
        {
            position: relative;
        }
        
        .navChildOff
        {
            display: none;
        }
        
        .navChildOn
        {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: absolute;
            margin-left: -40px;
            z-index: 1;
        }
        
        .navChildOn li
        {
            padding-right: 0px;
            padding-left: 0px;
            padding-top: 3px;
            padding-bottom: 3px;
            margin-top: 3px;
            margin-bottom: -3px;
            border-left: none;
            text-align: left;
        }
        
        .navChildOn li + li
        {
            border-top: 1px solid;
        }
        
        .navChildOn a
        {
            background-color: var(--dark);
            color: var(--light);
        }
        
        .navChildOn a:hover, .navChildOn a:active
        {
            opacity: 0.8;
        }
        
        .navParentOn a
        {
            background-color: var(--dark);
            color: var(--light);
        }
        </style>


    <header>
        <div id="topHeader">
            <!-- first div is here to center easily but exactly the second div with flex -->
            <div style="visibility:hidden;">FR | BR</div>
            <div><a href="` + root + languageNav + `home"><img src="/images/logo_names_heart.png" alt="Noms Barbara et Thibault" /></a></div>
            <div id="languageMenu"><a href="` + redirectFR + `"><img src="/icons/france.png" alt="Logo France" /></a><span style="visibility:hidden;">-</span><span>|</span><span style="visibility:hidden;">-</span><a href="` + redirectBR + `"><img src="/icons/brazil.png" alt="Logo Brésil" /></a></div>
        </div>

        <!-- Navigation menu of the website -->
        <nav>
            <ul>
                <li><a ` + homeStatus + `href="` + root + languageNav + `home">` + homeTitle + `</a></li>
                <li><a ` + historyStatus + `href="` + root + languageNav + `history">` + historyTitle + `</a></li>
                <li class="navParentOff"><a ` + relativesStatus + `href="` + root + languageNav + `relatives">` + relativesTitle + `</a>
                    <ul class="navChildOff">
                        <li><a href="` + root + languageNav + `rel/witnesses">` + witnessesTitle + `</a></li>
                        <li><a href="` + root + languageNav + `rel/parents">` + parentsTitle + `</a></li>
                        <li><a href="` + root + languageNav + `rel/children">` + childrenTitle + `</a></li>
                        <li><a href="` + root + languageNav + `rel/specials">` + specialsTitle + `</a></li>
                    </ul>
                </li>
                <li class="navParentOff"><a ` + organisationStatus + `href="` + root + languageNav + `organisation">` + organisationTitle + `</a>
                    <ul class="navChildOff">
                        <li><a href="` + root + languageNav + `org/info">` + infoTitle + `</a></li>
                        <li><a href="` + root + languageNav + `org/program">` + programTitle + `</a></li>
                        <li><a href="` + root + languageNav + `org/trips">` + tripsTitle + `</a></li>
                    </ul>
                </li>
                <li><a ` + dresscodeStatus + `href="` + root + languageNav + `dresscode">` + dresscodeTitle + `</a></li>
                <li><a ` + presentsStatus + `href="` + root + languageNav + `presents">` + presentsTitle + `</a></li>
                <li><a ` + presenceStatus + `href="` + root + languageNav + `presence">` + presenceTitle + `</a></li>
                <li><a ` + commentStatus + `href="` + root + languageNav + `comment">` + commentTitle + `</a></li>
            </ul>
                
        </nav>
    </header>
`;


// CREATION OF HTML ELEMENT + IMPORT
class Header extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: 'open' });
        shadowRoot.appendChild(headerTemplate.content);

        // Navigation hover logic
        let navParents = this.shadowRoot.querySelectorAll('.navParentOff');

        let displayNavChild = function() {
            this.classList.replace("navParentOff", "navParentOn");
            this.children[1].classList.replace("navChildOff", "navChildOn");
        }

        let undisplayNavChild = function() {
            this.classList.replace("navParentOn", "navParentOff");
            this.children[1].classList.replace("navChildOn", "navChildOff");
        }

        for (var i = 0; i < navParents.length; i++) {
            navParents[i].addEventListener('mouseenter', displayNavChild);
        }
        for (var i = 0; i < navParents.length; i++) {
            navParents[i].addEventListener('focusin', displayNavChild);
        }

        for (var i = 0; i < navParents.length; i++) {
            navParents[i].addEventListener('mouseleave', undisplayNavChild);
        }

        for (var i = 0; i < navParents.length; i++) {
            navParents[i].addEventListener('focusout', undisplayNavChild);
        }
    }
}

customElements.define('header-component', Header);