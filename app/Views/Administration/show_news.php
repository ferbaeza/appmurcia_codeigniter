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
        <input style="display: none;" type="text" id="id" readonly class="form-control mb-2" name="id" value="<?= $noticias->id?>">
        <label class="form-label" for="name">Titulo</label>
        <input required type="text" id="name" class="form-control mb-2" readonly name="name" value="<?= $noticias->title?>">

        <label class="form-label" for="email">Fecha Publicación</label>
        <input type="email" id="email" class="form-control mb-2" readonly name="email" value="<?= $noticias->pubDate?>">
        
        <label class="form-label" for="date">Url Noticia</label>
        <input type="text" id="date" class="form-control mb-2" readonly name="date" value="<?= $noticias->url?>">

        <label class="form-label" for="price">Guid</label>
        <input type="text" id="price" class="form-control mb-2" readonly name="price" value="<?= $noticias->guid?>">

        <label class="form-label" for="address">Descripcion</label>
        <textarea readonly cols="50" class="form-control mb-2" rows="3"><?= $noticias->description?></textarea>
      

    
        <a href="<?= route_to('news') ?>"><button class="btn btn-primary" id="formulario" readonly type="button">Back</button></a>
        </div>
        </form>
<?=  $this->endSection('content')  ?>