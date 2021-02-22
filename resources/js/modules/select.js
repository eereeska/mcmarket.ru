import { default as mcm } from "../mcm";

var Select = function(select) {
    this.root = select;
    this.value = select.querySelector('.select__data') || null;
    this.search = select.querySelector('.select__search') || null;
    this.selected = select.querySelector('.select__selected') || null;
    this.options = select.querySelectorAll('.select__option');
    this.defaultSelected = this.selected.innerHTML.trim();

    if (!this.selected) {
        return;
    }
    
    this.initSelected();
    this.initOptions();

    if (this.search) {
        this.initSearch();
    }
}

Select.prototype.initSearch = function() {
    var self = this;
    var root = this.root;

    this.search.addEventListener('focus', function() {
        if (root.querySelectorAll('.select__option').length > 0) {
            root.classList.add('select_active');
        }
    });

    this.search.addEventListener('blur', function() {
        root.classList.remove('select_active');
    });

    this.search.addEventListener('keyup', this.filter.bind(self));

    if (this.search.hasAttribute('data-url')) {
        this.search.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                if (self.search.hasAttribute('minlength') && self.search.value.trim().length < self.search.getAttribute('minlength')) {
                    return;
                }

                mcm.request('post', self.search.getAttribute('data-url'), {
                    query: this.value.trim()
                }).then(function(response) {
                    root.querySelector('.select__options').innerHTML = response.data.result;
                    self.filter();
                }).finally(function() {
                    if (root.querySelectorAll('.select__option').length > 0) {
                        root.classList.add('select_active');
                    }
                });
            }
        });
    }
}

Select.prototype.initSelected = function() {
    var root = this.root;

    this.selected.addEventListener('click', function(e) {
        e.preventDefault();
        root.classList.toggle('select_active');
    });
}

Select.prototype.initOptions = function() {
    var self = this;
    var root = this.root;

    root.querySelector('.select__options').addEventListener('click', function(e) {
        e.preventDefault();

        root.classList.remove('select_active');

        root.querySelectorAll('.select__option').forEach(function(option) {
            option.classList.remove('select__option_selected');

            if (option.contains(e.target)) {
                option.classList.add('select__option_selected');
                self.updateSelected(option.nodeType != 3 ? option.innerHTML : option.textContent);
                self.updateValue(option.dataset.value ? option.dataset.value : null);
            }
        });
    });
}

Select.prototype.filter = function() {
    var self = this;

    self.root.querySelectorAll('.select__option').forEach(function(option) {
        if (option.textContent.trim().toLowerCase().indexOf(self.search.value.trim().toLowerCase()) > -1) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });

    if (self.value.value.trim().length < 1) {
        self.selected.innerHTML = self.defaultSelected;
    }
}

Select.prototype.updateSelected = function(value) {
    this.selected.innerHTML = value.trim();
}

Select.prototype.updateValue = function(value) {
    this.value.value = value.trim();
}

mcm.qsa('.select').forEach(function(select) {
    new Select(select);
});

mcm.on('click', function(e) {
    mcm.qsa('.select.select_active').forEach(function(select) {
        if (!select.contains(e.target)) {
            select.classList.remove('select_active');
        }
    });
});