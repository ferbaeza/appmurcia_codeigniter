<?= $this->extend('PublicSection/base_layout') ?>

<?=  $this->section('css')  ?>
    <link rel="stylesheet" href="<?= base_url('assets/PublicSection/css/login.css') ?>"/>
<?=  $this->endSection('css')  ?>


<?=  $this->section('javascript')  ?>

<script type="text/javascript">
    $( document ).ready(function() {

        $('#formulario_login').on('submit', function(event){

            event.preventDefault();

            let data = new FormData(this);

            console.log(data);
           
            $.ajax({
                url: "<?= route_to('verify_login') ?>",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                async: true,
                timeout: 10000,
                beforeSend: (xhr) =>{},
                success: (response) => {
                    console.log(response);
                    
                    respuesta = JSON.parse(response);

                    if(respuesta.status=="OK"){
                        console.log("La petición ha ido correctamente");
                        if(respuesta.data.rol=='admin'){
                           console.log("Logueado correctamente!");
                           window.location.replace('<?= route_to('home_admin') ?>');
                        }else{
                            console.log("Logueado correctamente a home public!");
                        }
                        
                    }else{
                        console.log("La petición no ha ido bien");
                    }

                    
                },
                error: (xhr, status, error) => {
                    alert("se ha producido un error");
                },
                complete: () => {}
            });
        });
            
    });
</script>

<?=  $this->endSection('javascript')  ?>

<?=  $this->section('title')  ?>

<?=  $title; ?>

<?=  $this->endSection('title')  ?>

<?=  $this->section('content')  ?>

<center>
<img src="<?= base_url('assets/PublicSection/img/logoMurcia.png') ?>" class="foto"> 
    <fieldset>
        <form method="POST" id="formulario_login">
        <div class="col-8 celda">
            <label for="exampleInputEmail1" class="form-label pal">Please Sign in</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Email">
        </div>
        <div class="col-8 celda">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" id="password">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button> <br><br>
        </form>

        <div class="copy"><i class="far fa-copyright"></i> Turismo Murcia Daw 2022</div><br>

    </fieldset>

    

</center>



<?=  $this->endSection('content')  ?>