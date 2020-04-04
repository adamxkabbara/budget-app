const template = document.createElement('template');
template.innerHTML = `
  <style>
    :host {
      font-size: xx-large;
    }
  </style>
  <slot name="tab"></slot>
;`

class BudgetDrawer extends HTMLElement {

    constructor() {

        super();

        this.attachShadow({ mode: 'open' });
        this.shadowRoot.appendChild(template.content.cloneNode(true));

        this.addEventListener('click', () => {

            if (this.disabled) {
                return;
            }
            this.toggleDrawer();
        });
    }

    static get observedAttributes() {
        return ['open', 'disabled']
    }

    get open() {
        return this.hasAttribute('open');
    }

    set open(val) {

        if (val) {
            this.setAttribute('open', '');
        }
        else {
            this.removeAttribute('open');
        }
        this.toggleDrawer();
    }

    get disabled() {
        return this.hasAttribute('disabled');
    }

    set disabled(val) {

        if (val) {
            this.setAttribute('disabled', '')
        }
        else {
            this.removeAttribute('disabled');
        }
    }

    attributeChangedCallback() {

        if (this.disabled) {
            this.setAttribute('tabindex', '-1');
            this.setAttribute('aria-disabled', 'true');
        } else {
            this.setAttribute('tabindex', '0');
            this.setAttribute('aria-disabled', 'false');
        }
    }

    toggleDrawer() {

        if (open()) {
            open(false);
        }
        else {
            open(true);
        }
    }
}

customElements.define('budget-drawer', BudgetDrawer);