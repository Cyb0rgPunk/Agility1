<?= $this->extend('templates/session');?>
<?= $this->section('content');?>
<div class="container-fluid ">
    
    <div class="row text-center align-self-center">
        <div class="col-md-6" style="margin-left: auto; margin-right: auto; padding-top: 200px;">
            <h1>Bienvenido! <?= session('user')?></h1>
            <br>
            <img src="<?=base_url('/public/dist/img/agility.ico');?>" alt="Agility Logo" class="brand-image  ">
        </div>
    </div>
</div>
<?= $this->endSection();?>