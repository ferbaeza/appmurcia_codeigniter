<?= $this->extend('Administration/base_layout') ?>

<?=  $this->section('css')  ?>
<link rel="stylesheet" href="<?= base_url('assets/Administration/css/admin.css') ?>"/>
<?=  $this->endSection('css')  ?>


<?=  $this->section('javascript')  ?>

<script type="text/javascript">
</script>

<?=  $this->endSection('javascript')  ?>


<?=  $this->section('title')  ?>

<?= $title; ?>

<?=  $this->endSection('title')  ?>


<?=  $this->section('content')  ?>

    <h2 class="ini"><?= $title; ?></h2>
    

    <form class="formulario" id="formulario" method="POST" >
        <div class="col-7">
        <input style="display: none;" type="text" id="id" readonly class="form-control mb-2" name="id" value="<?= $gasolinera->id?>">
        <label class="form-label" for="name">Label</label>
        <input required type="text" id="name" class="form-control mb-2" readonly name="name" value="<?= $gasolinera->label?>">

        <label class="form-label" for="email">Dirección</label>
        <input type="email" id="email" class="form-control mb-2" readonly name="email" value="<?= $gasolinera->address?>">
        
        <label class="form-label" for="date">Latitud</label>
        <input type="text" id="date" class="form-control mb-2" readonly name="date" value="<?= $gasolinera->latitud?>">

        <label class="form-label" for="price">Longitud</label>
        <input type="text" id="price" class="form-control mb-2" readonly name="price" value="<?= $gasolinera->longitud?>">

        <label class="form-label" for="price">Ideess</label>
        <input type="text" id="price" class="form-control mb-2" readonly name="price" value="<?= $gasolinera->ideess?>">


    
        <a href="<?= route_to('gasstation') ?>"><button class="btn btn-primary" id="formulario" readonly type="button">Back</button></a>
        </div>
        </form>
<?=  $this->endSection('content')  ?>