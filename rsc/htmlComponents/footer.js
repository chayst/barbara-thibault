const footerTemplate = document.createElement('template');

footerTemplate.innerHTML = `
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
            
        a
        {
            text-decoration: none;
        }

        a:visited
        {
            color: var(--dark);
        }
        
        a:hover
        {
            color: white;
        }
        
        footer:nth-child(2)
        {
            justify-self: center;
        }
    
        table tr td
        {
            padding: 5px;
            padding-left: 30px;
            padding-right: 30px;
            text-align: center;
        }
    </style>


    <footer>
        <table>
            <tr>
                <td><a href="https://www.instagram.com/thibault_chays/">Thibault</a></td>
                <td><a href="https://www.instagram.com/barbaramendesn/">Bárbara</a></td>
            </tr>
            <tr>
                <td>Chez Monsieur et Madame André Chays<br/>Les Alizés - Bat. A<br/>51, traverse Pourrière<br/>13008 - Marseille, FRANCE</td>
                <td>Francisco José e Ana Niedja Mendes Nunes<br/>Ed Espaço Veredas II<br/>Avenida das Araucarias, Rua 12 Sul, Lote 10, AP 704<br/>71.939-000 - Aguas Claras, Brasilia DF, BRASIL</td>
            </tr>
        </table>
        <div>
            <a href="mailto:contact@barbara-thibault.fr">Contact</a>
        </div>
        <div>Music</div>
    </footer>
`;

class Footer extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: 'closed' });
        shadowRoot.appendChild(footerTemplate.content);
    }
}

customElements.define('footer-component', Footer);