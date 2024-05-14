import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

class App {
    constructor () {
        this.getElements();
        this.setEventListeners();
        this.setDefaults();
    }

    getElements() {
        this.submitButton = document.querySelector('.filters__submit');
        this.searchInput = document.getElementById('search');
        this.form = document.querySelector('.filters__form');
        this.dropdown = document.querySelector('.dropdown');
        this.bookmarks = document.querySelector('.bookmarks');
        this.toggle = document.querySelector('[for="checkbox-toggle"]');
        this.toggleText = this.toggle.querySelector('.filters__input--placeholder');
        this.checkboxToggle = document.querySelector('[name="checkbox-toggle"]');
    }

    setEventListeners() {
        this.searchInput.addEventListener('input', this.debounce(
            this.handleSearch.bind(this),
            200
        ).bind(this));

        this.dropdown.addEventListener('click', (e) => {
            // Checking if the target is an input to avoid double event firing
            if (e.target.tagName.toLowerCase() === 'input') {
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

    setDefaults() {
        this.submitButton.remove();
        this.tags = [];
    }

    handleSearch(e) {
        this.searchValue = e.target.value;
        this.handleRequest();
    }

    handleTags(e) {
        const value = e.target.value ?? e.target.dataset.name;
        const index = this.tags.indexOf(value);

        if (index > -1) {
            this.tags.splice(index, 1);
            document.querySelector(`[value="${value}"]`).checked = false;
            document.getElementById(value+'-close').style.display = 'none';
        } else {
            this.tags.push(value);
        }

        this.handleSelect();
        this.handleRequest();
    }

    handleSelect() {
        if (!this.tags.length) {
            this.toggleText.style.display = 'block';
            this.toggle.style.paddingTop = '1.25rem';
            this.toggle.style.paddingBottom = '1.25rem';
        } else {
            this.tags.forEach(tag => {
                document.getElementById(tag+'-close').style.display = 'inline-flex';
            });

            this.toggleText.style.display = 'none';
            this.toggle.style.paddingTop = '1rem';
            this.toggle.style.paddingBottom = '1rem';
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
