document.addEventListener('DOMContentLoaded', () => {
    const contentArea = document.getElementById('main-content-area');
    const tabs = document.querySelectorAll('.options');

    async function loadTabContent(tabElement) {
        const tabFile = tabElement.getAttribute('data-tab');

        if (!tabFile) {
            console.error('El elemento de la pestaña no tiene el atributo data-tab.');
            return;
        }
        const path = tabFile; 

        try {
            const response = await fetch(path);
            
            if (!response.ok) {
                throw new Error(`Error al cargar la pestaña: ${response.status} ${response.statusText}`);
            }
            const htmlContent = await response.text();
            contentArea.innerHTML = htmlContent;
        } catch (error) {
            console.error('Hubo un problema cargando el contenido:', error);
            contentArea.innerHTML = `<p style="color: red; padding: 20px;">Error al cargar: ${tabFile}</p>`;
        }
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            
            const activeTab = document.querySelector('.options.active');
            if (activeTab) {
                activeTab.classList.remove('active');
            }
            tab.classList.add('active');
            loadTabContent(tab);
        });
    });
    if (tabs.length > 0) {
        tabs[0].classList.add('active');
        loadTabContent(tabs[0]);
    }
});