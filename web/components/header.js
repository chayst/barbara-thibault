// Variable declaration for the header template
let currentNav = document.getElementsByTagName('meta')[0].getAttribute('name');
console.log(currentNav)

let root = 'barbara-thibault.herokuapp.com/';
let languageNav = '';

let homeTitle = 'Accueil';
let historyTitle = 'Notre Histoire';
let witnessesTitle = 'Nos Témoins';
let organisationTitle = 'Organisation';
let infoTitle = "Informations Pratiques";
let programTitle = 'Programme';
let tripsTitle = 'Voyages';
let presentsTitle = 'Liste de Cadeaux';
let presenceTitle = 'Confirmez votre présence';
let commentTitle = 'Laissez nous un mot';


let homeStatus = '';
let historyStatus = '';
let witnessesStatus = '';
let organisationStatus = '';
let presentsStatus = '';
let presenceStatus = '';
let commentStatus = '';

let redirectFR = '';
let redirectBR = '';


// FR - Conditions of attributions when on french pages
//general rule
if (currentNav.includes('_fr')) {
    redirectFR = root + currentNav.slice(0, -3);
    redirectBR = root + 'br/' + currentNav.slice(0, -3);
}

//menus
if (currentNav.includes('home')) {
    homeStatus = "id='currentNav'";
} else if (currentNav.includes('history')) {
    historyStatus = "id='currentNav'";
} else if (currentNav.includes('witnesses')) {
    witnessesStatus = "id='currentNav'";
} else if (currentNav.includes('presents')) {
    presentsStatus = "id='currentNav'";
} else if (currentNav.includes('presence')) {
    presenceStatus = "id='currentNav'";
} else if (currentNav.includes('organisation') || currentNav.includes('org/')) {
    organisationStatus = "id='currentNav'";
} else if (currentNav.includes('comment')) {
    commentStatus = "id='currentNav'";
}



// BR - Conditions of attributions when on portuguese pages
//general rule
if (currentNav.includes('_br')) {
    //rename nav items
    homeTitle = 'Entrada';
    historyTitle = 'Nossa Historia';
    witnessesTitle = 'Nossas Testemunhas';
    organisationTitle = 'Organização';
    infoTitle = 'Informações práticas';
    programTitle = 'Programma';
    tripsTitle = 'Viagems';
    presentsTitle = 'Lista de Presentes';
    presenceTitle = 'Confirme sua Presencia';
    commentTitle = 'Deixa uma palavra';

    redirectBR = root + currentNav.slice(0, -3);
    redirectFR = root + '../' + currentNav.slice(0, -3);
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
            <div><a href="` + root + languageNav + `home"><img src="../images/logo_names_heart.png" alt="Noms Barbara et Thibault" /></a></div>
            <div id="languageMenu"><a href="` + redirectFR + `"><img src="../icons/france.png" alt="Logo France" /></a><span style="visibility:hidden;">-</span><span>|</span><span style="visibility:hidden;">-</span><a href="` + redirectBR + `"><img src="../icons/brazil.png" alt="Logo Brésil" /></a></div>
        </div>

        <!-- Navigation menu of the website -->
        <nav>
            <ul>
                <li><a ` + homeStatus + `href="` + root + languageNav + `home">` + homeTitle + `</a></li>
                <li><a ` + historyStatus + `href="` + root + languageNav + `history">` + historyTitle + `</a></li>
                <li><a ` + witnessesStatus + `href="` + root + languageNav + `witnesses">` + witnessesTitle + `</a></li>
                <li class="navParentOff"><a ` + organisationStatus + `href="` + root + languageNav + `organisation">` + organisationTitle + `</a>
                    <ul class="navChildOff">
                    <li><a href="` + root + languageNav + `org/info">` + infoTitle + `</a></li>
                    <li><a href="` + root + languageNav + `org/program">` + programTitle + `</a></li>
                        <li><a href="` + root + languageNav + `org/trips">` + tripsTitle + `</a></li>
                    </ul>
                </li>
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