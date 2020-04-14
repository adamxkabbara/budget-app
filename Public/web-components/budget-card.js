const budget_card = document.createElement('template');
budget_card.innerHTML = `
<style>
    .header {
        font-size: 18px;
        text-align: left;
        display: block;
        color: var(--text-heading);
        font-weight: bold;
        border-bottom: 1px solid var(--text-outline-light);
        padding: 10px;
    }
    .card {
        background-color: white;
        border: var(--text-outline-light) 1px solid;
        border-radius: 5px;
        margin: 0px 1rem;
        transition: box-shadow .3s ease-in-out;
        box-shadow: 4px 4px 17px 1px rgba(33, 33, 33, 0.2);
    }
    .card:hover {
        box-shadow: 0 0 11px rgba(33,33,33,.2); 
    }
            
   .card a {
        border-top: var(--text-outline-light) 1px solid;
        color: var(--primary-color);
        background-color: transparent;
        text-align: center;
        cursor: pointer;
        padding: .5rem;
    }

    ::slotted(*) {
        min-height: 50px;
    }

    a {
       -webkit-appearance: button;
       -moz-appearance: button;
        appearance: button;
        text-decoration: none;
        color: initial;
        display: block;
    }
</style>
    <div class="card">
    <span class="header"></span>
    <slot name="body"></slot>
    <a></a>
    </div>
`;

customElements.define('budget-card',
    class extends HTMLElement {
        constructor() {
            super();
            this.shadowDOM = this.attachShadow({ mode: "open" });
            this.shadowDOM.appendChild(budget_card.content.cloneNode(true));
            if (this.constructor.observedAttributes && this.constructor.observedAttributes.length) {
                this.constructor.observedAttributes.forEach(attribute => {
                    Object.defineProperty(this, attribute, {
                        get() { return this.getAttribute(attribute); },
                        set(attrValue) {
                            if (attrValue) {
                                this.setAttribute(attribute, attrValue);
                            } else {
                                this.removeAttribute(attribute);
                            }
                        }
                    })
                })
            }
        }
        connectedCallback() { }
        disconnectedCallback() { }
        attributeChangedCallback(attr, oldValue, newValue) {
            switch (attr) {
                case 'href':
                    this.shadowDOM.querySelector('a').setAttribute('href', newValue);
                    break;
                case 'type':
                    this.shadowDOM.querySelector('a').innerText = newValue;
                    break;
                case 'card':
                    this.shadowDOM.querySelector('.card').innerHTML = `<span class="header"></span><slot name="body"></slot>`;
                    break;
                case 'header':
                    this.shadowDOM.querySelector('.header').innerText = newValue;
                    break;
            }
        }
        static get observedAttributes() {
            return ['header', 'card', 'href', 'type'];
        }
    }
);