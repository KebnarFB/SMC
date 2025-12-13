document.addEventListener('DOMContentLoaded', () => {

    const contentArea = document.getElementById('main-content-area');
    const tabs = document.querySelectorAll('.options');

    // CONTROL PARA EVITAR DUPLICADOS
    const loadedScripts = new Set();

    function loadScriptOnce(path) {

        // Convertir siempre a ruta ABSOLUTA
        const fullPath = "/" + path.replace(/^\/+/, ""); 

        if (loadedScripts.has(fullPath)) {
            console.log("Script ya cargado →", fullPath);
            return;
        }

        const s = document.createElement("script");
        s.src = fullPath;
        s.defer = true;

        document.body.appendChild(s);

        loadedScripts.add(fullPath);
        console.log("Script cargado →", fullPath);
    }

    // CARGA DE TABS
    async function loadTabContent(tabElement) {
        const tabFile = tabElement.getAttribute('data-tab');

        if (!tabFile) {
            console.error('El elemento de la pestaña no tiene data-tab.');
            return;
        }

        const fullTabPath = "/" + tabFile.replace(/^\/+/, "");

        try {
            const response = await fetch(fullTabPath);

            if (!response.ok) {
                throw new Error(`Error al cargar la pestaña: ${response.status}`);
            }

            const htmlContent = await response.text();
            contentArea.innerHTML = htmlContent;

            // CARGA DINÁMICA DE JS PARA CADA TAB

            if (tabFile.includes("Tab1.php")) {
                loadScriptOnce("views/Scripts/Tab1.js");
            }

            if (tabFile.includes("Tab2.php")) {
                window.tab2_iniciado = false;
                loadScriptOnce("views/Scripts/Tab2.js");
                loadScriptOnce("views/Scripts/modal_Tab2.js");
            }

            if (tabFile.includes("Tab4.php")) {
                loadScriptOnce("views/Scripts/Tab4.js");
            }

            if (tabFile.includes("Tab5.php")) {
                loadScriptOnce("views/Scripts/Tab5.js");
            }

        } catch (error) {
            console.error('Hubo un problema cargando el contenido:', error);
            contentArea.innerHTML =
                `<p style="color: red; padding: 20px;">Error al cargar: ${tabFile}</p>`;
        }
    }

    // EVENTOS DE PESTAÑAS
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();

            const activeTab = document.querySelector('.options.active');
            if (activeTab) activeTab.classList.remove('active');

            tab.classList.add('active');
            loadTabContent(tab);
        });
    });

    // CARGAR EL PRIMER TAB AL INICIAR
    if (tabs.length > 0) {
        tabs[0].classList.add('active');
        loadTabContent(tabs[0]);
    }
});
