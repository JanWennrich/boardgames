(() => {
    'use strict';

    const tabSwitches = document.querySelectorAll('.tab-switch > input[type=radio]');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabSwitches.forEach((tabSwitch) => {
        tabSwitch.addEventListener('change', () => {
            const controlledTabPanel = document.getElementById(tabSwitch.getAttribute('aria-controls'));

            tabPanels.forEach((tabPanel) => {
                tabPanel.style.display = 'none';
            });

            controlledTabPanel.style.display = 'block';
        });
    });
})();