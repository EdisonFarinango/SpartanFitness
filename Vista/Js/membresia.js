$(document).ready(function () {
    // Cargar tipos de membresía desde el servidor
    $.ajax({
        url: "../Ajax/membresia.php?op=tipos_membresia",
        type: "GET",
        dataType: "json",
        success: function (data) {
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    $("#tipo_membresia").append(
                        `<option value="${value.id}" data-precio="${value.precio}">
                            ${value.nombre} - $${value.precio}
                        </option>`
                    );
                });
            }
        },
        error: function () {
            Swal.fire("Error", "No se pudieron cargar los tipos de membresía.", "error");
        }
    });

    // Actualizar campos dinámicos cuando cambia tipo de membresía o cantidad de meses
    $("#tipo_membresia, #cantidad_meses, #fecha_inicio").on("change keyup", function () {
        const selected = $("#tipo_membresia option:selected");
        const precio = parseFloat(selected.data("precio")) || 0;
        const cantidadMeses = parseInt($("#cantidad_meses").val()) || 1;

        const totalPagar = precio * cantidadMeses;
        $("#precio_membresia").val(precio.toFixed(2));
        $("#total_pagar").val(totalPagar.toFixed(2));

        // Calcular fecha fin si hay fecha inicio
        const fechaInicio = $("#fecha_inicio").val();
        if (fechaInicio && cantidadMeses) {
            let duracionDias = 30;
            let fechaIni = new Date(fechaInicio);
            fechaIni.setDate(fechaIni.getDate() + duracionDias * cantidadMeses);
            let fechaFin = fechaIni.toISOString().split("T")[0];
            $("#fecha_fin").val(fechaFin);
        }
    });

    // Validar y enviar formulario
    $("#formRegistrarMembresia").on("submit", function (e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            this.classList.add("was-validated");
            return;
        }

        // Mostrar carga
        Swal.fire({
            title: "Registrando...",
            text: "Espere un momento por favor.",
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading(),
        });

        const formData = new FormData(this);

        $.ajax({
            url: "../Ajax/membresia.php?op=registrar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                try {
                    const res = JSON.parse(response);
                    if (res.status === "success") {
                        Swal.fire("Éxito", res.message, "success").then(() => {
                            window.location.reload(); // O redirigir a otra página
                        });
                    } else {
                        Swal.fire("Error", res.message, "error");
                    }
                } catch (e) {
                    console.error("Respuesta no válida:", response);
                    Swal.fire("Error", "Ocurrió un problema al procesar la respuesta.", "error");
                }
            },
            error: function (xhr, status, error) {
                Swal.fire("Error", "Hubo un fallo al registrar la membresía: " + error, "error");
            }
        });
    });
});