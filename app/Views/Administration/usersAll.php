<?= $this->extend('Administration/base_layout') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="<?= base_url('assets/Administration/css/homeAdmin.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script type="text/javascript">
            var columsDefinition = [
                    {
                    "targets": 0,
                    "render": function (data, type, row, meta) {
                        return row["id"];
                    }
                },
                {
                    "targets": 1,
                    "render": function (data, type, row, meta) {
                        return row["username"];
                    }
                },
                {
                    "targets": 2,
                    "render": function (data, type, row, meta) {
                        return row["email"];
                    }
                },
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return row["name"];
                    }
                },
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        return row["surname"];
                    }
                },
                {
                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        return row["rol_id"];
                    }
                },
                {
                    "targets":6,
                    "render": function (data, type, row, meta) {
                        return '<button class="btn-danger deleteBtn"><i class="fa fa-trash"></i></button> <button class="btn-success editBtn"><i class="fa fa-edit"></i></button>';
                    }
                }

            ];
        $(document).ready( function(){
            let usersDatatable = $('#users_datatable').DataTable({
                "processing":true, //Muestra el 'cargando' de la pagina
                "responsive":true, //Permitirá que la tabla se ajuste automaticamente
                "serverSide":true, //Activar Ajax
                "searching":false, //Por si queremos que aparezca la barra buscador
                "columnDefs":columsDefinition, //Array de columnas
                "fnDrawCallback": function (oSettings) {
                    //Controlar la paginación
                    if(oSettings.iDisplayLength >= oSettings.fnRecordsTotal())
                        $(oSettings.nTableWrapper).find('dataTables_paginate').hide();
                    else
                    $(oSettings.nTableWrapper).find('dataTables_paginate').show();
                },
                "ajax" : { //Petición Ajax que obtendrá los datos del datatable
                    url: "<?= route_to('users_data') ?>",
                    type:"POST",
                    data: function() {},
                    error: function(data){
                        console.log(data);
                    }
                }
            });
            $('#users_datatable').on('click', '.deleteBtn', function(){
            console.log("Delete_OK");
            //obtener datos de esa fila
            var data = usersDatatable.row($(this).parents('tr')).data();
            console.log(data);
            console.log(data.id);
                event.preventDefault();
                $json_data ={
                    "id": data.id
                }
                $.ajax({
                    url: "<?= route_to('users_delete') ?>",
                    type: "DELETE",
                    data: JSON.stringify($json_data),
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    async: true,
                    timeout: 5000,
                    beforeSend:(xhr) =>{

                    },
                    success: (response) =>{
                        console.log(response);
                        $('#users_datatable').DataTable().ajax.reload(null,false);
                        

                    },
                    error: (xhr, status, error) =>{
                        console.log(data);
                        console.log("Se ha producido un error");
                    },
                    complete: () =>{

                    }
                });
            });
            $('#new').on('click',  function(){
                console.log("New User");
                window.location.href = "<?= route_to('users_form') ?>";

            });            


            $('#users_datatable tbody').on('click', '.editBtn', function(){
                console.log("Modify_OK");
                var data = usersDatatable.row($(this).parents('tr')).data();
                console.log(data);
                console.log(data.id);
                window.location.href = "<?= route_to('users_form') ?>/"+data.id;

            });            

        });


   
    </script>
<?= $this->endSection() ?>
<?= $this->section('title')?>
 <?= $title?>
<?= $this->endSection() ?>



<?= $this->section('content')  ?>
<?php $session=session(); ?>
    
    <!--Container Main start-->
    <div class="container">
        <div class="height-100 bg-light m-auto ">
            <h1 class="h1 text-center">Usuarios</h1>
            <button type="submit" class="btn btn-primary mb-3 mx-3" id="new">Nuevo Usuario</button>

            <table id="users_datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>E-mail</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Id Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            </table>
        </div>
    </div>
    <!--Container Main end-->

<?= $this->endSection() ?>