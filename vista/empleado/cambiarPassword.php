<div class="container">
    <div class="row">
        <div id='content_sc' class="col-xl-6 offset-xl-3 col-lg-12 col-md-12 p-5 border rounded">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Cambiar Clave</h2>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <label class="label-form" for="clave_actual">Clave Actual</label>
                    <div class="input-group flex-nowrap">                        
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-white" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="clave_actual" class="form-control fieldactual kickerror btnActiveButton" placeholder="Clave Actual" aria-label="Clave Actual" autocomplete=off>
                    </div>
                </div>
            </div>
            <div class="row mt-3">                
                <div class="col-12">
                    <label class="label-form" for="clave_new">Nueva Clave</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-info text-white" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="clave_new" class="form-control fieldnew kickerror btnActiveButton" placeholder="Nueva Clave" aria-label="Nuevo Clave">
                    </div>
                </div>
            </div>
            <div class="row mt-3">                
                <div class="col-12">
                    <label class="label-form" for="clave_new_confirm">Confirmar Clave</label>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-info text-white" id="addon-wrapping"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" name="clave_new_confirm" class="form-control fieldconfirm kickerror btnActiveButton" placeholder="Confirmar Clave" aria-label="Confirmar Clave">
                    </div>
                </div>
            </div>
            <div class="row mt-4 text-center" id='content_sc2'>
                <div class="col-12">
                    <button class="btn btn-danger text-white pressActive" id='btnLogChangePsw'><i class="fas fa-warning mr-1"></i> Cambiar</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
<style>
    .form-control{
        border:1px solid #ccc!important;
    }
</style>
