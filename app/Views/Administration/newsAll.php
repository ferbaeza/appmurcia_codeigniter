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
                    "targets":3,
                    "render": function (data, type, row, meta) {
                        return '<button class="btn-info infoBtn"><i class="fas fa-eye"></i></button>';
                    }
                }

            ];
        $(document).ready( function(){
            let newsDatatable = $('#news_datatable').DataTable({
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
                    url: "<?= route_to('news_data') ?>",
                    type:"POST",
                    data: function() {},
                    error: function(data){
                        console.log(data);
                    }
                }
            });         
            $('#news_datatable tbody').on('click', '.infoBtn', function(){
                
                var data = newsDatatable.row($(this).parents('tr')).data();
                console.log(data);
                console.log(data.id);
                window.location.href = "/admin/news_show/"+data.id;

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
            <h1 class="h1 text-center">Noticias</h1>
            <table id="news_datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Fecha Publicacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
    
    
            </table>


        </div>
    </div>
    <!--Container Main end-->




<?= $this->endSection() ?>