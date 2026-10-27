<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-4">
    <h3>UTA ESTUDIANTES</h3>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-success" onclick="newUser()">Nuevo Estudiante</button>
        
        <div class="d-flex gap-2">
            <input type="text" id="txtBuscarCedula" class="form-control" placeholder="Buscar por cédula..." style="width: 200px;">
            <button type="button" class="btn btn-primary" onclick="buscarUser()">Buscar</button>
            <button type="button" class="btn btn-secondary" onclick="limpiarBusqueda()">Mostrar Todos</button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody id="dg"></tbody>
    </table>
</div>

<div class="modal fade" id="dlg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dlg-title">Nuevo estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="fm" method="post">
                    <h5>User Information</h5>
                    <div class="mb-2">
                        <label class="form-label">Cedula:</label>
                        <input type="text" name="txtcedula" id="txtcedula" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Nombre:</label>
                        <input type="text" name="txtnombre" id="txtnombre" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Apellido:</label>
                        <input type="text" name="txtapellido" id="txtapellido" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Direccion:</label>
                        <input type="text" name="txtdireccion" id="txtdireccion" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Telefono:</label>
                        <input type="text" name="txttelefono" id="txttelefono" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var url;
    var rows = [];
    var modalBootstrap = new bootstrap.Modal(document.getElementById('dlg'));

    function reloadData(cedula = '') {
        $.getJSON('models/select.php', { estcedula: cedula }, function(data) {
            rows = Array.isArray(data) ? data : [];
            var html = '';
            rows.forEach(function(row, index) {
                html += '<tr>' +
                    '<td>' + row.estcedula + '</td>' +
                    '<td>' + row.estnombre + '</td>' +
                    '<td>' + row.estapellido + '</td>' +
                    '<td>' + row.estdireccion + '</td>' +
                    '<td>' + row.esttelefono + '</td>' +
                    '<td class="text-center">' +
                        '<button class="btn btn-warning btn-sm me-1" onclick="editUser(' + index + ')">Editar Estudiante</button>' +
                        '<button class="btn btn-danger btn-sm" onclick="destroyUser(\'' + row.estcedula + '\')">Eliminar Estudiante</button>' +
                    '</td>' +
                '</tr>';
            });
            $('#dg').html(html);
        });
    }

    function buscarUser() {
        var cedula = $('#txtBuscarCedula').val().trim();
        reloadData(cedula);
    }

    function limpiarBusqueda() {
        $('#txtBuscarCedula').val('');
        reloadData('');
    }

    function newUser() {
        $('#dlg-title').text('Nuevo estudiante');
        $('#fm')[0].reset();
        $('#txtcedula').prop('readonly', false);
        modalBootstrap.show();
        url = 'models/insert.php';
    }

    function editUser(index) {
        var row = rows[index];
        if (row) {
            $('#dlg-title').text('Editar Estudiante');
            $('#txtcedula').val(row.estcedula).prop('readonly', true);
            $('#txtnombre').val(row.estnombre);
            $('#txtapellido').val(row.estapellido);
            $('#txtdireccion').val(row.estdireccion);
            $('#txttelefono').val(row.esttelefono);
            
            modalBootstrap.show();
            url = 'models/update.php';
        }
    }

    function saveUser() {
        if (!$('#fm')[0].reportValidity()) return;

        $.post(url, $('#fm').serialize(), function(result) {
            if (result.error) {
                alert('Error: ' + result.error);
            } else {
                modalBootstrap.hide();
                reloadData($('#txtBuscarCedula').val().trim());
            }
        }, 'json');
    }

    function destroyUser(cedula) {
        if (confirm('¿Estás seguro de que quieres eliminar este estudiante?')) {
            $.post('models/delete.php', { estcedula: cedula }, function(result) {
                if (result.success) {
                    reloadData($('#txtBuscarCedula').val().trim());
                } else {
                    alert('Error: ' + (result.error || result.errorMsg));
                }
            }, 'json');
        }
    }

    reloadData();
</script>