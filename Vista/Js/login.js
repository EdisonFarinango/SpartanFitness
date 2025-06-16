$(document).ready(function () {
    $('#formularioLogin').on('submit', function (e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            $(this).addClass('was-validated');
            return;
        }

        const formData = new FormData(this);

        Swal.fire({
            title: 'Iniciando sesión...',
            text: 'Por favor espere.',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: "../Ajax/usuario.ajax.php?op=login",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response === "0") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Acceso denegado',
                        text: 'Correo o contraseña incorrectos.'
                    });
                } else {
                    let destino = "";
                    switch (response.trim().toLowerCase()) {
                        case "encargado":
                            destino = "index.php";
                            break;
                        case "administrador":
                            destino = "Vista/membresias/registrar-membresia.php";
                            break;
                        default:
                            Swal.fire({
                                icon: 'warning',
                                title: 'Rol no permitido',
                                text: 'Contacte al administrador.'
                            });
                            return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        text: 'Redirigiendo...',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = destino;
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud: ' + error
                });
            }
        });
    });
});
