import mcm from "../mcm";

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

    mcm.on('focus', this.search, function() {
        if (root.querySelectorAll('.select__option').length > 0) {
            root.classList.add('select_active');
        }
    });

    mcm.on('blur', this.search, function() {
        root.classList.remove('select_active');
    });

    mcm.on('keyup', this.search, this.filter.bind(self));

    if (this.search.hasAttribute('data-url')) {
        mcm.on('keydown', this.search, function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                if (this.hasAttribute('minlength') && this.value.trim().length < this.getAttribute('minlength')) {
                    return;
                }

                mcm.request('post', this.getAttribute('data-url'), {
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

    mcm.on('input', this.search, function() {
        if (this.value.length < 1) {
            self.selected.innerHTML = self.defaultSelected;
            self.updateValue('', false);
        }
    });
}

Select.prototype.initSelected = function() {
    var root = this.root;

    mcm.on('click', this.selected, function(e) {
        e.preventDefault();
        root.classList.toggle('select_active');
    });
}

Select.prototype.initOptions = function() {
    var self = this;
    var root = this.root;

    mcm.on('click', root.querySelector('.select__options'), function(e) {
        e.preventDefault();

        root.classList.remove('select_active');

        root.querySelectorAll('.select__option').forEach(function(option) {
            option.classList.remove('select__option_selected');

            if (option.contains(e.target)) {
                option.classList.add('select__option_selected');
                self.updateSelected(option.nodeType != 3 ? option.innerHTML : option.textContent);
                self.updateValue(option.dataset.value, true);
            }
        });
    });
}

Select.prototype.filter = function() {
    var self = this;

    this.root.querySelectorAll('.select__option').forEach(function(option) {
        if (option.textContent.trim().toLowerCase().indexOf(self.search.value.trim().toLowerCase()) > -1) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
}

Select.prototype.updateSelected = function(value) {
    this.selected.innerHTML = value.trim();
}

Select.prototype.updateValue = function(value, trigger) {
    var old = this.value.value;

    this.value.value = value.trim();

    if (this.value != old && trigger) {
        this.value.dispatchEvent(new Event('change'));
    }
}

mcm.qsa('.select').forEach(function(select) {
    new Select(select);
});

mcm.on('click', window, function(e) {
    mcm.qsa('.select.select_active').forEach(function(select) {
        if (!select.contains(e.target)) {
            select.classList.remove('select_active');
        }
    });
});