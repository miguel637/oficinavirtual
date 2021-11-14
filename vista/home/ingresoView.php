<div class="container p-5">
    <div class="row">
        <div id='content_sc' class="col-xl-6 offset-xl-3 col-lg-12 col-md-12 p-5 bg-white rounded">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Oficina Virtual</h2>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-white" id="addon-wrapping"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control fielduser kickerror btnActiveButton" placeholder="Usuario" aria-label="Usuario">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="g-recaptcha" data-sitekey="6LcJJzIdAAAAAFpu38JsCW3Syswuzl8zumc4sT5p"></div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-white" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control fieldpass kickerror btnActiveButton" placeholder="Contraseña" aria-label="Contraseña">
                    </div>
                </div>
            </div>
            <div class="row mt-4 text-center" id='content_sc2'>
                <div class="col-6">
                    <a class='text-custom-1' href="<?php echo site_url("restablecer");?>">¿Olvidasta la contraseña?</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-custom-1 text-white pressActive" id='btnLogValidate'>Ingresar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#cuerpo').css({"background":"url('<?php echo base_url();?>lib/img/oficina_virtual.jpg')","background-repeat":"no-repeat","background-size":"cover"});    
</script>
<script src="<?php echo base_url();?>lib/js/responsive.js?<?php echo filemtime("lib/js/responsive.js");?>"></script>
<style>
    @media (max-width: 600px)
    {
        .pl-input{
            padding-left: 0;
            white-space:nowrap;
            overflow:hidden;
        }
    }
</style>