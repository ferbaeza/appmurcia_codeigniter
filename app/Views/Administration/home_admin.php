<?= $this->extend('Administration/base_layout') ?>

<?=  $this->section('css')  ?>
<link rel="stylesheet" href="<?= base_url('assets/Administration/css/admin.css') ?>"/>
<?=  $this->endSection('css')  ?>


<?=  $this->section('javascript')  ?>



<?=  $this->endSection('javascript')  ?>


<?=  $this->section('title')  ?>

<?= $title; ?>

<?=  $this->endSection('title')  ?>


<?=  $this->section('content')  ?>

    <h2 class="ini">Panel admin del Departamento de Turismo de Murcia</h2>

    
    <p>
        En el panel admin podras ver la información que aparecerá en nuestra aplicación <br> <br>
        Algunos campos no los podras modificar ya que provienen de API's públicas <br><br>
        Esos campos son: 
        <ul>
            <li>Gasolineras</li>
            <li>Videos</li>
            <li>Noticias</li>
            <li>Tiempo</li>
            <li>Roles (Habrán dos Público y Admin)</li>
        </ul>
    
        <br>
        Los campos que si que podras modificar y deberán llevar un mantenimiento son: <br>
        <ul>
            <li>Usuarios</li>
            <li>Reviews</li>
            <li>Restaurantes</li>
        </ul>

        <br>

    </p>



<?=  $this->endSection('content')  ?>

