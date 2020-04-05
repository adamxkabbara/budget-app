const template = document.createElement('template');
template.innerHTML = `
  <style>
    :host {
      position: relative;
      display: inline-block;
    }

    i.add-icon {
      display: inline-block;
      width: 40px;
      height: 40px;
      background: url(../media/add.svg) no-repeat center;
    }

    button {
      width: 55px;
      height: 55px;
      border: none;
      border-radius: 30px;
      background-color: #76dea5;
      cursor: pointer;
      outline:none;
    }

    div#ceFabContainer{
      position: absolute;
      right: 0px;
      top: 0px;
      margin-right: 60px;
      color: #fff;
    }

    .hidden {
      display: none;
    }

  </style>
  
  <button><i class="add-icon"></i></button>
  <div id="ceFabContainer" class="hidden">
    <slot></slot>
  </div>
`;

class FABButton extends HTMLElement {

  constructor() {
    
    super();


    this.attachShadow({mode: 'open'});
    this.shadowRoot.appendChild(template.content.cloneNode(true));

  }

  connectedCallback() {

    if (!this.hasAttribute('role')) {
      this.setAttribute('role', 'button')
    }

    this.addEventListener('click', this._onClick);

    Promise.all([
      customElements.whenDefined('fab-item')
    ])
    .then(() => {
      let items = this._allItems();


    })
  }

  disconnectedCallback() {
    this.removeEventListener(this._onClick);
  }

  _allItems() {
    return Array.from(this.querySelectorAll('fab-item'));
  }

  _onClick(e) {

    if (this.disabled) {
      return;
    }
    this.toggleDrawer();
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
    //this.toggleDrawer();
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

  attributeChangedCallback(name, oldValue, newValue) {
    if (this.disabled) {
      this.setAttribute('tabindex', '-1');
      this.setAttribute('aria-disabled', 'true');
    } 
    else {
      this.setAttribute('tabindex', '0');
      this.setAttribute('aria-disabled', 'false');
    }
  }

  toggleDrawer() {

    let container = this.shadowRoot.getElementById('ceFabContainer');

    this.open = !this.open;

    if (this.open) {
      container.classList.remove('hidden');
    }
    else {
      container.classList.add('hidden');
    }
  }
}

customElements.define('fab-button', FABButton);

//
// budget-drawerItem
//

const template1 = document.createElement('template');
template1.innerHTML = `
  <style>

    :host {
      display: block;
      padding: 20px;
      cursor: pointer;
    }
   
  </style>
  <slot id="ceFabItemName"></slot>
`;
let FABItemCount = 0;

class FABItem extends HTMLElement {

  static get observedAttributes() {
    return ['href'];
  }

  constructor() {

    super();

    this.attachShadow({mode: 'open'});
    this.shadowRoot.appendChild(template1.content.cloneNode(true));
  }

  connectedCallback() {

    if (!this.hasAttribute('role')) {
      this.setAttribute('role', 'menuitem');
    }
    if (!this.id) {
      this.id = 'fab-item-generated-'+FABItemCount++;
    }

    this.addEventListener('click', this._onClick);
  }

  _onClick(e) {
    if (this.href == null) return;
    window.location.href = this.href;
  }

  get href() {
    return this.getAttribute('href');
  }

  set href(href) {
    this.href = href;
  }

  attributeChangedCallback(name, oldValue, newValue) {
  }
}

customElements.define('fab-item', FABItem);