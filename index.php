<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENIEC PERÚ</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <center>
        <br>
        <h3>CONSULTA DE DNI</h3>
        <div class="btn-group">
            <input type="text" id="documento" class="form-control" placeholder="Ingrese el DNI">
            <button type="button" class="btn btn-dark" id="buscar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </div>
        <br><br>
        <div class="row" id="resultados" style="display: none;">
            <div class="col-sm-12">
                <h5>Resultados:</h5>
            </div>
            <div class="col-sm-12">
                <p><strong>Nombre(s):</strong> <span id="nombre"></span></p>
                <p><strong>Apellidos:</strong> <span id="apellido"></span></p>
            </div>
        </div>
    </center>

    <script>
        $(document).ready(function() {
            // Obtener los elementos del DOM
            const resultadosDiv = document.getElementById("resultados");
            const nombreSpan = document.getElementById("nombre");
            const apellidoSpan = document.getElementById("apellido");

            // Función para mostrar los resultados
            function mostrarResultados(nombre, apellido) {
                nombreSpan.textContent = nombre;
                apellidoSpan.textContent = apellido;
                resultadosDiv.style.display = "block";
            }

            // Manejar el evento de clic en el botón buscar
            $("#buscar").click(function() {
                // Obtener el valor del DNI ingresado
                const dni = $("#documento").val();

                // Realizar la solicitud AJAX al archivo PHP
                $.ajax({
                    url: "controlador/consultaDNI.php",
                    type: "POST",
                    data: { dni: dni },
                    success: function(response) {
                        // Mostrar los resultados obtenidos del archivo PHP
                        const data = JSON.parse(response);
                        mostrarResultados(data.nombres, data.apellidoPaterno + ' ' + data.apellidoMaterno);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
