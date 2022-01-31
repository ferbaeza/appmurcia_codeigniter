<?= $this->extend('Administration/base_layout') ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script type="text/javascript">
        $(document).ready(function(){
            console.log('READY!');
            $('#form_review').on("submit", function(event){
                    event.preventDefault();
                    let data = new FormData(this);
                    $.ajax({
                        url: "<?= route_to('save_review') ?>",
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
<?= $this->section('title')?>
 <?= $title?>
<?= $this->endSection() ?>



<?= $this->section('content')  ?>




    <h1 class="h1 text-center"><?= $title ?></h1>



    <form class="formulario" id="form_review" method="POST" >
        <input style="display: none;" type="text" id="id" class="form-control" name="id" value="<?= $review->id?>">
        <label class="form-label" for="name">Descripcion</label>
        <input type="text" id="description" class="form-control" name="description" value="<?= $review->description?>">

        <label class="form-label" for="email">Puntuacion</label>
        <input type="text" id="puntuation" class="form-control" name="puntuation" value="<?= $review->puntuation?>">

        <label class="form-label" for="address">E-mail</label>
        <input type="text" id="email" class="form-control" name="email" value="<?= $review->email?>">

        <label class="form-label" for="category_id">Restaurante</label>
        <select class="form-select" name="category_id">
            <?php foreach($restaurante as $rest): ?>
                    <option value="<?=$rest->id?>"<?php if($rest->id == $review->restaurant_id):?> selected <?php endif ?>>
                        <?=$rest->name?>
                    </option>
                <?php endforeach ?>
        </select>
        <button class="btn btn-primary mt-3" id="formulario" type="submit">Guardar</button>
    </form>
      
    <!--Container Main end-->

<?= $this->endSection() ?>