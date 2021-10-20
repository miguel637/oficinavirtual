<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/css/style.css?<?php echo filemtime("lib/css/style.css"); ?>">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


    <style>
    .comunicado {cursor: pointer; 
        position: absolute;
        right: 20px;
        top:5px;
        text-align: center;  
    }
    .color{ font-size: 13px; color:red; display: inline;}
    .color:hover{ color:#1A63A7; }
    .btn-close{font-size: 18px; border: none;}
    </style>


<?php if ($_SESSION["type_user"] == 2) {
?>

<a class="comunicado" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <span id="color" class="far fa-bell mr-2 fa-2x">
</span><p class="color">Comunicado<p></a>

<?php } ?>



<!-- Modal Clients -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div style="text-align:center;" class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Comunicado Informativo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
      <img width="100%" id="imgfloat" src="<?php echo base_url(); ?>lib/img/Comunicado.png">
      </div>
    </div>
  </div>
</div>



<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse_bk" class="btn btn-primary"></button>
        </div>
        <div class="img bg-wrap text-center py-4">
            <div class="user-logo">
                <div class="img" style="background-image: url(<?php echo base_url() . 'lib/img/mano.png'; ?>);background-color:white;background-size:80%"></div>
                <h4 class='mb-0'><?php echo $_SESSION["persona_user"]; ?></h4>
                <h5><?php echo $_SESSION["nombre_user"]; ?></h5>

                <?php if ($_SESSION["type_user"] == 2) {
?>

    <div align='center' >
        <a  class="instructivo" href="<?php echo site_url("lib/pdf/MANUAL_OFICINA_VIRTUAL_PARA_EMPRESAS_USUARIAS_2021.pdf"); ?>" title="Descarga el instructivo de la oficina virtual para clientes." download><img width="8%" id="imgfloat" src="<?php echo base_url(); ?>lib/img/descarga.png" title="Descarga el instructivo de la oficina virtual para clientes."> Descargar instructivo oficina virtual</a>
    </div>

<?php

}

?>

            </div>
        </div>

        <ul class="list-unstyled components mb-5">
            <li id='menu-home-panel'>
                <a href="<?php echo site_url("panel"); ?>"><span class="fas fa-home mr-3"></span> Home</a>
            </li>


            
            <?php

            // Panel de condición banco de registros 

            if ($_SESSION["type_user"] == 2) {
            ?>
                <ul class="list-unstyled components mb-5">
                    <li id='menu-home-panel'>
                        <a href="<?php echo site_url("calendar"); ?>"><span class="far fa-calendar-alt  mr-3"></span> Calendario</a>
                    </li>
                <?php } ?>


                <?php

                // Administrador 
                if ($_SESSION["type_user"] == 1) {
                ?>
                    <li id='menu-admin-users'>
                        <a href="<?php echo site_url("admon/users"); ?>"><span class="fas fa-user-friends mr-3"></span> Usuarios</a>
                    </li>
                <?php

                }


                //Empresa
                if ($_SESSION["type_user"] == 2) {
                ?>

                    <?php
                    $actived_seleccion = false;
                    $actived_contratacion = false;
                    $actived_novedades = false;
                    $actived_sst = false;
                    $actived_pqrs = false;
                    $actived_seguridad = false;
                    $actived_examenes = false;
                    $actived_gestionriesgo = false;

                    foreach ($modulos as $modulo) {
                        if ($modulo["section"] == "Seleccion" && $actived_seleccion == false) {
                            $actived_seleccion = true;
                    ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-seleccion"><span class="fas fa-people-arrows mr-3"></span> Selección <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Contratacion" && $actived_contratacion == false) {
                            $actived_contratacion = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-contratacion"><span class="fas fa-id-card mr-3"></span> Contratación <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Novedades" && $actived_novedades == false) {
                            $actived_novedades = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-emp-novedades"><span class="fas fa-folder mr-3"></span> Novedades <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "gestionriesgo" && $actived_gestionriesgo == false) {
                            $actived_gestionriesgo = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-gestionriesgo"><span class="fas fa-file-contract mr-3"></span> Gestión Riesgo <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "SST" && $actived_sst == false) {
                            $actived_sst = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-empresa-sst"><span class="fas fa-user-md mr-3"></span> SST <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "PQRS" && $actived_pqrs == false) {
                            $actived_pqrs = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-empresa-pqrs"><span class="fab fa-wpforms mr-3"></span> PQRS <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Seguridad" && $actived_seguridad == false) {
                            $actived_seguridad = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-empresa-seguridad"><span class="fas fa-user-lock mr-3"></span> Seguridad <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Examenes Medicos" && $actived_examenes == false) {
                            $actived_examenes = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-emp-examenes"><span class="fas fa-clinic-medical mr-3"></span> Exámenes Médicos <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        ?>

                        <li class='<?php echo $modulo["tag_li_class"]; ?>' id='<?php echo $modulo["tag_li_id"]; ?>'>
                            <a href="<?php echo ($modulo["tag_a_href"] != '#') ? site_url($modulo["tag_a_href"]) : '#'; ?>" class='d-flex <?php echo $modulo["tag_a_class"]; ?>' id='<?php echo $modulo["tag_a_id"]; ?>'><span class="<?php echo $modulo["tag_icon_class"]; ?>"></span>
                                <div><?php echo $modulo["html_name"]; ?></div> <?php echo $modulo["html_icon_end"]; ?>
                            </a>
                        </li>

                    <?php
                    }
                    ?>


                <?php
                }
                //misional
                if ($_SESSION["type_user"] == 3) {
                ?>
                    <li id='menu-emp-hojaVida'>
                        <a href="<?php echo site_url("miHojaVida"); ?>"><span class="fas fa-clipboard-list mr-3"></span> Hoja de Vida</a>
                    </li>
                    <li id='menu-emp-files'>
                        <a href="<?php echo site_url("misDocumentos"); ?>"><span class="fas fa-clipboard-list mr-3"></span> Certificados</a>
                    </li>
                    <li>
                        <a href="#" class="changeStatusDropdown" id="menu-mis-beneficiarios"><span class="fas fa-users mr-3"></span> Beneficiarios <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                    </li>
                    <li class='dropdown-function d-none menu-mis-beneficiarios' id='menu-mis-addBenef'>
                        <a href="<?php echo site_url("addBeneficiario"); ?>"><span class="fas fa-plus mr-3"></span> Agregar Beneficiario</a>
                    </li>
                    <li class='dropdown-function d-none menu-mis-beneficiarios' id='menu-mis-verBenef'>
                        <a href="<?php echo site_url("misBeneficiarios"); ?>"><span class="fas fa-clipboard-list mr-3"></span> Mis Beneficiarios</a>
                    </li>

                    <li id='menu-emp-reporteCovid'>
                        <a href="<?php echo site_url("sst/reportarCovid"); ?>"><span class="fas fa-shield-virus mr-3"></span> Reportar Covid</a>
                    </li>
                    <?php if ($_SESSION["codigoEmpresa_user"] != "2") {
                    ?>
                        <li>
                            <a href="#" class="changeStatusDropdown" id="menu-mis-incapacidades"><span class="fas fa-medkit mr-3"></span> Incapacidades <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                        </li>
                        <li class='dropdown-function d-none menu-mis-incapacidades' id='menu-mis-incapacidades_new'>
                            <a href="<?php echo site_url("generarIncapacidad"); ?>" class="cr-href d-flex"><span class="fas fa-bell mr-3"></span>
                                <div>Reportar Incapacidad</div>
                            </a>
                        </li>
                        <li class='dropdown-function d-none menu-mis-incapacidades' id='menu-mis-incapacidades_ver'>
                            <a href="<?php echo site_url("incapacidadesGeneradas"); ?>" class="cr-href d-flex"><span class="fas fa-list mr-3"></span>
                                <div>Incapacidades Generadas</div>
                            </a>
                        </li>

                    <?php
                    }
                    ?>


                    <li>
                        <a href="#" class="changeStatusDropdown" id="menu-mis-cambiarPassword"><span class="fas fa-lock mr-3"></span> Seguridad <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                    </li>
                    <li class='dropdown-function d-none menu-mis-cambiarPassword' id='menu-mis-cambiarClave'>
                        <a href="<?php echo site_url("seguridad/cambiarPassword"); ?>"><span class="fas fa-user-lock mr-3"></span> Cambiar Clave</a>
                    </li>



                    <?php
                }
                //funcionario
                if ($_SESSION["type_user"] == 4) {

                    $actived_seleccion = false;
                    $actived_contratacion = false;
                    $actived_archivos = false;
                    $actived_novedades = false;
                    $actived_ANS = false;
                    $actived_Solicitud_Recursos = false;
                    $actived_ES = false;
                    $actived_MA = false;
                    $actived_GD = false;
                    $actived_gestionriesgo = false;

                    foreach ($modulos as $modulo) {
                        if ($modulo["section"] == "Seleccion" && $actived_seleccion == false) {
                            $actived_seleccion = true;
                    ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-seleccion"><span class="fas fa-people-arrows mr-3"></span> Selección <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Contratacion" && $actived_contratacion == false) {
                            $actived_contratacion = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-contratacion"><span class="fas fa-id-card mr-3"></span> Contratación <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Archivos" && $actived_archivos == false) {
                            $actived_archivos = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-archivos"><span class="fas fa-folder mr-3"></span> Archivos <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Novedades" && $actived_novedades == false) {
                            $actived_novedades = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-novedades"><span class="fas fa-folder mr-3"></span> Novedades <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "ANS" && $actived_ANS == false) {
                            $actived_ANS = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-ans"><span class="fas fa-copyright mr-3"></span> ANS <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        if ($modulo["section"] == "Solicitud de Recursos" && $actived_Solicitud_Recursos == false) {
                            $actived_Solicitud_Recursos = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-solicitudes"><span class="fas fa-satellite-dish mr-3"></span> Solicitud de Recursos <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }
                        if ($modulo["section"] == "ES" && $actived_ES == false) {
                            $actived_ES = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-es"><span class="fas fa-exclamation-circle mr-3"></span> Estudios de Seguridad <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }
                        if ($modulo["section"] == "MA" && $actived_MA == false) {
                            $actived_MA = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-ma"><span class="fas fa-exclamation-circle mr-3"></span> Mesa de Ayuda <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }
                        if ($modulo["section"] == "GD" && $actived_GD == false) {
                            $actived_GD = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-gd"><span class="far fa-file-alt mr-3"></span> Gestión Documental <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>

                            </li>

                        <?php
                        }

                        if ($modulo["section"] == "gestionriesgo" && $actived_gestionriesgo == false) {
                            $actived_gestionriesgo = true;
                        ?>
                            <li class="" id="">
                                <a href="#" class="changeStatusDropdown" id="menu-practicante-gestionriesgo"><span class="fas fa-file-contract mr-3"></span> Gestión Riesgo <i class="fas pull-right fa-chevron-down" style="margin-top:6px;"></i></a>
                            </li>
                        <?php
                        }

                        ?>

                        <li class='<?php echo $modulo["tag_li_class"]; ?>' id='<?php echo $modulo["tag_li_id"]; ?>'>
                            <a href="<?php echo ($modulo["tag_a_href"] != '#') ? site_url($modulo["tag_a_href"]) : '#'; ?>" class='<?php echo $modulo["tag_a_class"]; ?>' id='<?php echo $modulo["tag_a_id"]; ?>' style="display:flex"><span style="margin: auto 0" class="<?php echo $modulo["tag_icon_class"]; ?>"></span> <?php echo $modulo["html_name"]; ?> <?php echo $modulo["html_icon_end"]; ?></a>
                        </li>

                    <?php
                    }
                    ?>
                <?php
                }
                ?>


                <li>
                    <a href="<?php echo site_url("authLogout"); ?>" style='color:#EF9494'><span class="fa fa-sign-out mr-3"></span> Cerrar Sesión</a>
                </li>
                </ul>
    </nav>
    <!-- Page Content  -->
    <div style="position:absolute"><button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fas fa-bars"></i></button></div>
    <div id="content" class="p-4 p-md-5 pt-5">

        <script>
            $(document).ready(function() {
                $('.changeStatusDropdown').click(function() {
                    var target = $(this).attr('id');
                    $('.' + target).toggleClass('d-none');
                    if ($('.' + target).hasClass('d-none')) {
                        $(this).children('.pull-right').removeClass('fa-chevron-up');
                        $(this).children('.pull-right').addClass('fa-chevron-down');
                    } else {
                        $(this).children('.pull-right').removeClass('fa-chevron-down');
                        $(this).children('.pull-right').addClass('fa-chevron-up');
                    }
                });
                <?php if (isset($script)) echo $script; ?>
            });
        </script>
        <style>
            .dropdown-function {
                background: #575757;
                border-left: 5px solid #ccc;
            }

            #content {
                max-height: 100vh !important;
                overflow: auto;
            }
        </style>