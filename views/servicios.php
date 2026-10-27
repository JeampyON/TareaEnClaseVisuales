<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UTA ESTUDIANTES</title>
    <link rel="stylesheet" type="text/css" href="jquery/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="jquery/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="jquery/themes/color.css">
    <link rel="stylesheet" type="text/css" href="jquery/demo/demo.css">
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>UTA ESTUDIANTES</h2>
    
    <table id="dg" title="Ingreso de estudiantes" class="easyui-datagrid" style="width:700px;height:250px"
            url="models/select.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="estcedula" width="50">Cedula</th>
                <th field="estnombre" width="50">Nombre</th>
                <th field="estapellido" width="50">Apellido</th>
                <th field="estdireccion" width="50">Direccion</th>
                <th field="esttelefono" width="50">Telefono</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Estudiante</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Estudiante</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar Estudiante</a>
        
        <span style="margin-left:20px;">Cédula:</span>
        <input id="txtBuscarCedula" class="easyui-textbox" style="width:120px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="buscarUser()">Buscar</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>User Information</h3>
            <div style="margin-bottom:10px">
                <input name="txtcedula" id="txtcedula" class="easyui-textbox" required="true" label="Cedula:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="txtnombre" id="txtnombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="txtapellido" id="txtapellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="txtdireccion" id="txtdireccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="txttelefono" id="txttelefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <script type="text/javascript">
        var url;

        function buscarUser(){
            $('#dg').datagrid('load', {
                estcedula: $('#txtBuscarCedula').val()
            });
        }

        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo estudiante');
            $('#fm').form('clear');
            $('#txtcedula').textbox('readonly', false);
            url = 'models/insert.php';
        }

        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Estudiante');
                $('#fm').form('load', {
                    txtcedula: row.estcedula,
                    txtnombre: row.estnombre,
                    txtapellido: row.estapellido,
                    txtdireccion: row.estdireccion,
                    txttelefono: row.esttelefono
                });
                $('#txtcedula').textbox('readonly', true);
                url = 'models/update.php';
            }
        }

        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.error){
                        $.messager.show({
                            title: 'Error',
                            msg: result.error
                        });
                    } else {
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            });
        }

        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirma','Estas seguro de que quieres eliminar este estudiante?',function(r){
                    if (r){
                        $.post('models/delete.php',{estcedula:row.estcedula},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');
                            } else {
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.error
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
</body>
</html>