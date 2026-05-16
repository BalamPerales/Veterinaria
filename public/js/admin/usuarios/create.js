$(document).ready(function() {
    // Manejar el cambio de rol
    $('#rol').change(function() {
        var selectedRol = $(this).val();
        var seccionVeterinario = $('#seccion_veterinario');
        
        if (selectedRol === 'veterinario') {
            seccionVeterinario.slideDown('fast');
        } else {
            seccionVeterinario.slideUp('fast');
            // Limpiar campos si se ocultan
            $('#especialidad').val('');
            $('#cedula_profesional').val('');
            $('#foto_firma').val('');
            $('.custom-file-label').text('Seleccionar imagen...');
        }
    });

    // Disparar el evento change al cargar la página por si hay un valor anterior (old)
    if ($('#rol').val() === 'veterinario') {
        $('#seccion_veterinario').show();
    }

    // Cambiar el texto del custom file input cuando se selecciona un archivo
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName || 'Seleccionar imagen...');
    });
});
