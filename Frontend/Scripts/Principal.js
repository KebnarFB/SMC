document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.options');

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            
            const activeTab = document.querySelector('.options.active');
            if (activeTab) {
                activeTab.classList.remove('active');
            }

            tab.classList.add('active');
        });
    });
    if (tabs.length > 0) {
        tabs[0].classList.add('active');
    }
});

