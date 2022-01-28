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
                        return row["title"];
                    }
                },
                {
                    "targets": 2,
                    "render": function (data, type, row, meta) {
                        return row["pubDate"];
                    }
                },
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return row["url"];
                    }
                },
                {
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        return row["guid"];
                    }
                },
                {
                    "targets": 5,
                    "render": function (data, type, row, meta) {
                        return row["description"];
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
            let videosDatatable = $('#videos_datatable').DataTable({
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
                    url: "<?= route_to('videos_data') ?>",
                    type:"POST",
                    data: function() {},
                    error: function(data){
                        console.log(data);
                    }
                }
            });
            $('#videos_datatable').on('click', '.deleteBtn', function(){
            console.log("Delete_OK");
            //obtener datos de esa fila
            var data = videosDatatable.row($(this).parents('tr')).data();
            console.log(data);
            console.log(data.id);
                event.preventDefault();
                $json_data ={
                    "id": data.id
                }
                $.ajax({
                    url: "<?= route_to('festivals_delete') ?>",
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
                        $('#videos_datatable').DataTable().ajax.reload(null,false);
                        

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
                console.log("New Festival");
                window.location.href = "<?= route_to('festivals_add') ?>";

            });            


            $('#videos_datatable tbody').on('click', '.editBtn', function(){
                console.log("Modify_OK");
                var data = videosDatatable.row($(this).parents('tr')).data();
                console.log(data);
                console.log(data.id);
                window.location.href = "<?= route_to('festivals_add') ?>/"+data.id;

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
            <h1 class="h1 text-center">Videos</h1>
            <button type="submit" class="btn btn-primary mb-3 mx-3" id="new">New Entry</button>

            <table id="videos_datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Fecha Publicacion</th>
                    <th>Url</th>
                    <th>Guid</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
    
    
            </table>


        </div>
    </div>
    <!--Container Main end-->




<?= $this->endSection() ?>