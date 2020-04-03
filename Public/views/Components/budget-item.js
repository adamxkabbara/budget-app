customElements.define('budget-item',
    class extends HTMLElement {
        constructor() {
            super();
            this.shadowDOM = this.attachShadow({ mode: "open" });
            this.shadowRoot.innerHTML = `
            <style>
                li {
                    list-style-type: none;
                    text-align: left;
                    display: flex;
                    justify-content: space-between;
                    padding: 1rem;
                    color: var(--text-heading);
                    border-bottom: 1px solid var(--text-body-light);
                }
                .item-name {
                    --color: var(--text-heading);
                    font-size: 18px;
                }
                .category {
                    font-size: 12px;
                    color: var(--text-body)
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
                    --padding: 0px;
                }
                
            </style>
            <li>
                <div class="left">
                    <span class="date"></span>
                    <div>
                        <span class="item-name"><</span>
                        <span class="category"></span>
                    </div>
                </div>
                <span class="value"></span>
            </li>
            `;
        }
        connectedCallback() { }
        disconnectedCallback() { }
        attributeChangedCallback(attr, oldValue, newValue) {
            switch (attr) {
                case 'item-name':
                    this.shadowDOM.querySelector('.item-name').innerText = newValue;
                    break;
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