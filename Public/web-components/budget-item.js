var budget_item = document.createElement('template');
budget_item.innerHTML = `
<style>
    li {
        list-style-type: none;
        text-align: left;
        display: flex;
        justify-content: space-between;
        padding: 1rem;
        color: var(--text-heading);
        border-bottom: 1px solid var(--text-outline-light);
    }
    .item-name {
        --color: var(--text-heading);
        font-size: 18px;
    }
    .category {
        font-size: 12px;
        color: var(--text-body);
    }
    span:not(.value), span:not(.date){
        display: block;
    }
    .left {
        display: flex;
        align-items: center;
    }
    .date {
        padding-right: 1rem;
        color: var(--text-body);
        font-size: 14px;
    }
    .no-border {
        border-bottom: none;
    }
    .value {
        color: var(--primary-dark-color);
    }
    
</style>
<li>
    <div class="left">
        <span class="date"></span>
        <div>
            <slot class="item-name"></slot>
            <span class="category"></span>
        </div>
    </div>
    <span class="value"></span>
</li>
`;

customElements.define('budget-item',
    class extends HTMLElement {
        constructor() {
            super();
            this.shadowDOM = this.attachShadow({ mode: "open" });
            this.shadowDOM.appendChild(budget_item.content.cloneNode(true));
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
                case 'category':
                    this.shadowDOM.querySelector('.category').innerText = newValue;
                    break;
                case 'value':
                    this.shadowDOM.querySelector('.value').innerText = '$' + newValue;
                    break;
                case 'date':
                    this.shadowDOM.querySelector('.date').innerText = newValue;
                    break;
                case 'no-border':
                    console.log('hello')
                    this.shadowDOM.querySelector('li').classList.add('no-border');
                    break;
            }
        }
        static get observedAttributes() {
            return ['item-name', 'no-border', 'date', 'category', 'value'];
        }
    }
);