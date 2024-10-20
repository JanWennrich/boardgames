(() => {
    'use strict';

    const tabSwitches = document.querySelectorAll('.tab-switch > input[type=radio]');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabSwitches.forEach((tabSwitch, tabSwitchIndex) => {
        tabSwitch.addEventListener('change', () => {
            tabPanels.forEach((tabPanel, tabPanelIndex) => {
                if (tabSwitchIndex === tabPanelIndex) {
                    tabPanel.style.display = 'block';
                } else {
                    tabPanel.style.display = 'none';
                }
            });
        });
    });
})();