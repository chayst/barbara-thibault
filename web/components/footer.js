// Variable declaration for the header template
// already declared in header: let currentNav = document.getElementsByTagName('meta')[0].getAttribute('name');

// initialization of language variables in French
let contact = "Contactez-nous";
let music = "Écoutez notre playlist";

// BR - Conditions of attributions when on portuguese pages
//general rule
if (currentNav.includes("_br")) {
    //rename footer items
    contact = "Entre em contato conosco";
    music = "Escute nossa playlist";
}

const footerTemplate = document.createElement("template");

footerTemplate.innerHTML =
    `
    <style>
        footer
        {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: var(--light);
            box-shadow: 0px 0px 10px 0px #111;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
        }

        p
        {
            text-align: center;
        }
            
        a
        {
            text-decoration: none;
            color: var(--dark);
        }
        
        a:hover
        {
            opacity: 0.8;
        }

    </style>


    <footer>
        <div>
            <p><a href="https://www.instagram.com/thibault_chays/">Thibault</a></p>
            <p>Monsieur et Madame André Chays<br/>Les Alizés - Bat. A<br/>51, traverse Pourrière<br/>13008 - Marseille, France</p>
        </div>
        <div>
            <p><a href="https://www.instagram.com/barbaramendesn/">Bárbara</a></p>
            <p>Francisco José Nunes Ferreira e Ana Niedja Mendes Nunes<br/>Ed Espaço Veredas II<br/>Avenida das Araucarias, Rua 12 Sul, Lote 10, AP 704<br/>71.939-000 - Aguas Claras, Brasilia DF, Brasil</p>
        </div>
        <div>
            <a href="mailto:contact@barbara-thibault.fr"><p>` +
    contact +
    `</p>
            <p>contact@barbara-thibault.fr</p></a>
        </div>
        <div>
            <p>` +
    music +
    `</p>
            <p><iframe src="https://open.spotify.com/embed?uri=spotify%3Aplaylist%3A5TYrt1ew8AH6baS2IgsR9E" width="80%" height="80" frameborder="0" style="border-radius: 12px;"allowtransparency="true" allow="encrypted-media"></iframe></p>
        </div>
    </footer>
`;

class Footer extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: "open" });
        shadowRoot.appendChild(footerTemplate.content);
    }
}

customElements.define("footer-component", Footer);