<?= $this->extend('Administration/base_layout') ?>

<?=  $this->section('css')  ?>
<link rel="stylesheet" href="<?= base_url('assets/Administration/css/admin.css') ?>"/>
<?=  $this->endSection('css')  ?>


<?= $this->section('javascript') ?>
    <script type="text/javascript">
        $(document).ready(function(){
            console.log('READY!');
            $('#formulario_restaurante').on("submit", function(event){
                    event.preventDefault();
                    let data = new FormData(this);
                    $.ajax({
                        url: "<?= route_to('save_restaurante') ?>",
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        async: true,
                        timeout: 5000,
                        beforeSend:(xhr) =>{

                        },
                        success: (response) =>{
                            window.history.back();
                        },
                        error: (xhr, status, error) =>{
                            console.log(error);
                            alert("Se ha producido un error");
                        },
                        complete: () =>{

                        }
                    });
                });





        });
    </script>
<?= $this->endSection() ?>


<?=  $this->section('title')  ?>

<?= $title; ?>

<?=  $this->endSection('title')  ?>


<?=  $this->section('content')  ?>

    <p class="ini"><?= $title; ?></p>
    

    <form class="formulario" id="formulario_restaurante" method="POST" >
        <input style="display: none;" type="text" id="id" class="form-control" name="id" value="<?=$restaurante->id ?>">
        <label class="form-label" for="name">Nombre</label>
        <input required type="text" id="name" class="form-control" name="name" value="<?= $restaurante->name?>">

        <label class="form-label" for="email">Descripcion</label>
        <input type="text" id="description" class="form-control" name="description" value="<?= $restaurante->description?>">
        
        <label class="form-label" for="date">Direccion</label>
        <input type="text" id="address" class="form-control" name="address" value="<?= $restaurante->address?>">

        <label class="form-label" for="price">Latitud</label>
        <input type="text" id="latitud" class="form-control" name="latitud" value="<?= $restaurante->latitud?>">

        <label class="form-label" for="address">Longitud</label>
        <input type="text" id="longitud" class="form-control" name="longitud" value="<?= $restaurante->longitud?>">

        <label class="form-label" for="image_url">Media Puntuaciones</label>
        <input type="text" id="reviewAverage" class="form-control" name="reviewAverage" value="<?= $restaurante->reviewAverage?>">

        <label class="form-label" for="image_url">Numero de reviews</label>
        <input type="text" id="numReviews" class="form-control" name="numReviews" value="<?= $restaurante->numReviews?>">
 
        <button class="btn btn-primary" id="formulario" type="submit">Guardar</button>
    </form>
<?=  $this->endSection('content')  ?>