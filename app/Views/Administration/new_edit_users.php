<?= $this->extend('Administration/base_layout') ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script type="text/javascript">
        $(document).ready(function(){
            console.log('READY!');
            $('#form_users').on("submit", function(event){
                    event.preventDefault();
                    let data = new FormData(this);
                    $.ajax({
                        url: "<?= route_to('save_users') ?>",
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



    <form class="formulario" id="form_users" method="POST" >
        <input style="display: none;" type="text" id="id" class="form-control" name="id" value="<?= $user->id?>">
        <label class="form-label" for="name">Usuario</label>
        <input type="text" id="username" class="form-control" name="username" value="<?= $user->username?>">

        <label class="form-label" for="email">E-mail</label>
        <input type="text" id="email" class="form-control" name="email" value="<?= $user->email?>">

        <label class="form-label" for="address">Comtraseña</label>
        <input type="password" id="password" class="form-control" name="password" value="<?= $user->password?>">

        <label class="form-label" for="address">Nombre</label>
        <input type="text" id="name" class="form-control" name="name" value="<?= $user->name?>">

        <label class="form-label" for="address">Apellidos</label>
        <input type="text" id="surname" class="form-control" name="surname" value="<?= $user->surname?>">

        <label class="form-label" for="category_id">Rol</label>
        <select class="form-select" name="category_id">
            <?php foreach($roles as $rol): ?>
                    <option value="<?=$rol->id?>"<?php if($rol->id == $user->rol_id):?> selected <?php endif ?>>
                        <?=$rol->name?>
                    </option>
                <?php endforeach ?>
        </select>
        <button class="btn btn-primary mt-3" id="formulario" type="submit">Guardar</button>
    </form>
      
    <!--Container Main end-->

<?= $this->endSection() ?>