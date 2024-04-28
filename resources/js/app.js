import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

class App {
    constructor () {
        this.getElements();
        this.setEventListeners();

        this.submitButton.remove();
        this.tags = [];
    }

    getElements() {
        this.submitButton = document.querySelector('.filters__submit');
        this.searchInput = document.getElementById('search');
        this.form = document.querySelector('.filters__form');
        this.dropdown = document.querySelector('.dropdown');
        this.bookmarks = document.querySelector('.bookmarks');
        this.toggle = document.querySelector('[for="checkbox-toggle"]');
        this.checkboxToggle = document.querySelector('[name="checkbox-toggle"]');
    }

    setEventListeners() {
        this.searchInput.addEventListener('input', this.debounce(
            this.handleSearch.bind(this),
            200
        ).bind(this));

        this.dropdown.addEventListener('click', (e) => {
            if(e.target.tagName.toLowerCase() === 'input') {
                this.handleTags(e);
            }
        });

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleRequest();
        });

        this.toggle.addEventListener('click', (e) => {
            if (e.target.matches('.tag')) {
                e.preventDefault();
                e.target.remove();
                this.handleTags(e);
            }
        });

        document.body.addEventListener('click', (e) => {
            if (
                e.target !== this.toggle &&
                ! e.target.classList.contains('tag--close') &&
                ! this.dropdown.contains(e.target) &&
                e.target !== this.dropdown &&
                e.target.name !== 'checkbox-toggle'
            ) {
                this.checkboxToggle.checked = false;
            }
        })
    }

    handleSearch(e) {
        this.searchValue = e.target.value;
        this.handleRequest();
    }

    handleTags(e) {
        const value = e.target.value ?? e.target.innerText;
        const index = this.tags.indexOf(value);

        if (index > -1) {
            this.tags.splice(index, 1);
            document.querySelector(`[value="${value}"]`).checked = false;
        } else {
            this.tags.push(value);
        }

        this.handleSelect();
        this.handleRequest();
    }

    handleSelect() {
        if (!this.tags.length) {
            this.toggle.innerText = 'Choose one or more tags'
            this.toggle.style.paddingLeft = '1rem';
        } else {
            let tagsElements = '';
            this.tags.forEach(tag => {
                let el = `<span class="tag tag--close">${tag}</span>`;
                tagsElements += el;
            });

            this.toggle.innerHTML = tagsElements;
            this.toggle.style.paddingLeft = '.25rem';
        }
    }

    handleRequest() {
        axios.get('/', {
            params: {
                search: this.searchValue,
                tags: this.tags,
            }
        })
        .then((res) => {
            this.bookmarks.innerHTML = res.data;
        });
    }

    debounce(callback, wait) {
        let timeoutId = null;
        return (...args) => {
            window.clearTimeout(timeoutId);
            timeoutId = window.setTimeout(() => {
                callback.apply(null, args);
            }, wait);
        };
    }
}

addEventListener('load', (e) => new App());
