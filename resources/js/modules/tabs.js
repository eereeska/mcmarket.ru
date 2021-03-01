import mcm from "../mcm";

mcm.each('.tabs > .tabs__tab', function(tab) {
    // if (tab.classList.contains('tabs__tab_active')) {
    //     mcm.ie(tab.getAttribute('href'), function() {
    //         this.classList.add('tabs__tab_active');
    //     });
    // }

    mcm.on('click', tab, function(e) {
        e.preventDefault();

        if (this.classList.contains('tabs__tab_active')) {
            return;
        }
        
        tab.parentNode.querySelectorAll('.tabs__tab_active').forEach(function(activeTab) {
            activeTab.classList.remove('tabs__tab_active');
        });

        this.classList.add('tabs__tab_active');

        Array.from(tab.parentNode.parentNode.querySelector('div.tabs__content').children).forEach(function(item) {
            if (item.getAttribute('id') == tab.getAttribute('href').replace('#', '')) {
                item.classList.add('active-tab');
            } else {
                item.classList.remove('active-tab');
            }
        });
    });
});