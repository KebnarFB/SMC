const imageInput = document.getElementById('profile_image_input');
const previewImg = document.getElementById('preview-img');
const placeholderText = document.getElementById('placeholder_text');

function activateFileInput() {
    imageInput.click();
}

function submitCombinedForms(event) {
    //descripcion
    const descriptionField = document.getElementById('description_field');
    const hiddenDescription = document.getElementById('hidden_descripcion');
    // empresa
    const field_idEmpresa = document.getElementById('empresa');
    const hidden_idEmpresa = document.getElementById('hidden_idEmpresa');
    const profileForm = document.getElementById('profileForm');

    hiddenDescription.value = descriptionField.value;
    hidden_idEmpresa.value = field_idEmpresa.value;

    console.log('Valor del select:', document.getElementById('empresa').value);
    console.log('Valor del hidden:', document.getElementById('hidden_idEmpresa').value)
    profileForm.submit();
}

imageInput.addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();

        reader.onload = function(event) {
            // Carga la imagen seleccionada para previsualizar
            previewImg.src = event.target.result;
            
            // Oculta el texto de placeholder (si no se maneja solo con CSS)
            placeholderText.style.display = 'none'; 
        }

        reader.readAsDataURL(e.target.files[0]); 
    }
});