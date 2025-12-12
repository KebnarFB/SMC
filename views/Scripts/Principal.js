document.addEventListener('DOMContentLoaded', () => {
    const contentArea = document.getElementById('main-content-area');
    const tabs = document.querySelectorAll('.options');

    //   CONTROL PARA EVITAR DUPLOS
    const loadedScripts = new Set();

    function loadScriptOnce(path) {
        if (loadedScripts.has(path)) {
            console.log("Script ya cargado →", path);
            return;
        }

        const s = document.createElement("script");
        s.src = path;
        s.defer = true;
        document.body.appendChild(s);

        loadedScripts.add(path);
        console.log("Script cargado →", path);
    }

    //   CARGA DE TABS
    async function loadTabContent(tabElement) {
        const tabFile = tabElement.getAttribute('data-tab');

        if (!tabFile) {
            console.error('El elemento de la pestaña no tiene el atributo data-tab.');
            return;
        }

        try {
            const response = await fetch(tabFile);

            if (!response.ok) {
                throw new Error(`Error al cargar la pestaña: ${response.status} ${response.statusText}`);
            }

            const htmlContent = await response.text();
            contentArea.innerHTML = htmlContent;

            //   CARGA DINÁMICA DE SCRIPTS SEGÚN EL TAB

            if (tabFile.includes("Tab1.php")) {
                loadScriptOnce("/SMC/views/Scripts/Tab1.js");
            }

            if (tabFile.includes("Tab2.php")) {
                window.tab2_iniciado = false; 
                loadScriptOnce("/SMC/views/Scripts/Tab2.js");
            }

            if (tabFile.includes("Tab4.php")) {
                loadScriptOnce("/SMC/views/Scripts/Tab4.js");
            }

            if (tabFile.includes("Tab5.php")) {
                loadScriptOnce("/SMC/views/Scripts/Tab5.js");
            }

        } catch (error) {
            console.error('Hubo un problema cargando el contenido:', error);
            contentArea.innerHTML =
                `<p style="color: red; padding: 20px;">Error al cargar: ${tabFile}</p>`;
        }
    }

    //   EVENTOS DE PESTAÑAS
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();

            const activeTab = document.querySelector('.options.active');
            if (activeTab) activeTab.classList.remove('active');

            tab.classList.add('active');
            loadTabContent(tab);
        });
    });

    // CARGAR EL PRIMER TAB AL ABRIR
    if (tabs.length > 0) {
        tabs[0].classList.add('active');
        loadTabContent(tabs[0]);
    }
});
