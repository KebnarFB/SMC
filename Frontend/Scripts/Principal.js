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

function animateOptions() {
    const options = document.querySelectorAll('.options');
    options.forEach(option => {
        option.addEventListener('mouseover', () => {
            option.style.transform = 'scale(1.05)';
            option.style.transition = 'transform 0.3s ease';
        });
        option.addEventListener('mouseout', () => {
            option.style.transform = 'scale(1)';
            option.style.transition = 'transform 0.3s ease';
        });
    });
}
window.onload = animateOptions;
