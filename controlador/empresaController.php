<?php
require 'modelo/empresaModel.php';

class EmpresaController extends EmpresaModel
{

    public function __construct()
    {
        //$this->generarCodigoOAuthZoho();
    }

    public function addReq()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Agregar Requisición - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-add-req').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/agregarRequisicion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }



    public function verReq()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Ver Requisiciones - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-ver-req').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/verRequisicion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function addPerfil()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Agregar Perfil - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-add-perfil').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/agregarPerfil.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verEntrevistas()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Entrevistas - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-entrevistas-look').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/verEntrevistas.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function newOrden()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Generar Orden - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-add-orden').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/agregarOrden.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verOrdenes()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Ordenes Contratación - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-ver-orden').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/verOrden.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verContratosNomina()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Contratos - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-contratos-nomina').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/verContratosNomina.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verExpedientes()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Expedientes - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-emp-expedientes').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/verExpedientes.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function pqrs()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "PQRS - Oficina Virtual";
        $data["script"] = "$('#menu-empresa-pqrs').click();$('#menu-pqrs').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/nuevoPQRS.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function seguridadSolicitud()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Solicitudes de Seguridad - Oficina Virtual";
        $data["script"] = "$('#menu-empresa-seguridad').click();$('#menu-solicitud-seguridad').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/nuevaSolicitudSeguridad.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function reportarCovid()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Reportar Covid - Oficina Virtual";
        $data["script"] = "$('#menu-empresa-sst').click();$('#menu-view-sst').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/reportarCovid.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verReporteCovid()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Reporte Covid - Oficina Virtual";
        $data["script"] = "$('#menu-empresa-sst').click();$('#menu-sst-reportesCovid').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/sst/reporteCovid.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verSeguimiento()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Seguimiento - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-emp-seguimiento').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/seguimiento.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    //Gestion de Riesgo
    public function nuevoDescargo()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Nuevo Descargo - Oficina Virtual";
        $data["script"] = "$('#menu-gestionriesgo').click();$('#menu-gestionriesgo-nuevoDescargo').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/gestionriesgo/nuevoDescargo.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verDescargos()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Ver Descargos - Oficina Virtual";
        $data["script"] = "$('#menu-gestionriesgo').click();$('#menu-gestionriesgo-verDescargos').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/gestionriesgo/verDescargos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function nuevoErrorOrganizacional()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Reportar Error Organizacional - Oficina Virtual";
        $data["script"] = "$('#menu-gestionriesgo').click();$('#menu-gestionriesgo-nuevoErrorOrganizacional').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/gestionriesgo/nuevoErrorOrganizacional.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verErroresOrganizacionales()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Errores Organizacionales - Oficina Virtual";
        $data["script"] = "$('#menu-gestionriesgo').click();$('#menu-gestionriesgo-verErroresOrganizacionales').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/gestionriesgo/verErroresOrganizacionales.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    //---------------------------

    public function verContratosEnviadosFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Contratos Enviados - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-fidu-contratos-enviados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/contratosEnviados.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verAfiliacionesTitularFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Afiliaciones Titular - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-fidu-afiliacion-titular').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/afilicacionTitular.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verContratadosFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Contratados - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-fidu-contratados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/contratados.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verRequisicionesFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Requisiciones - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verRequisiciones').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verRequisiciones.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verPerfilesFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Perfiles - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verPerfiles').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verPerfiles.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function agregarConvocatoriaFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Agregar Convocatoria - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-addConvocatorias').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/agregarConvocatoria.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verConvocatoriasFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Convocatorias - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verConvocatorias').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verConvocatorias.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verPostuladosFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Postulados - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verPostulados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verPostulados.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function agregarValidacionTitulosFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Agregar Validación de Titulo - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-addValidacionTitulos').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/agregarValidacionTitulos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verValidacionesTitulosFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Validaciones de Titulos - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verValidacionTitulos').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verValidacionesTitulos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function agregarReferenciacionFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Nueva Referenciación - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-addReferenciacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/agregarReferenciacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verReferenciacionesFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Ver Referenciaciones - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verReferenciaciones').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verReferenciaciones.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function agregarHojaVidaFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Agregar Hoja de Vida - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-agregarHojaVida').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/agregarHojadeVida.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verHojasVidaFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Hojas de Vida - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-verHojasVida').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verHojadeVida.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function cargarWorkdriveCandidatos()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Candidatos - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-candidatosWorkDrive').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verCandidatosWorkDrive.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verConvocatoriasDisponiblesFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Convocatorias Disponibles - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-convocatoriasDisponibles').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verConvocatoriasDisponibles.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verConvocatoriasInternasFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Convocatorias Internas - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-fidu-convocatoriasInternas').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/seleccion/verConvocatoriasInternas.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verCarpetaContratosFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Contratos Workdrive - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-fidu-contratosfolder').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/verCarpetaContratosFidu.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verExpedientesDigitales()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Expedientes Digitales - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-contratacion-expedientes-digital').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/verExpedientesDigitales.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verExpedientesDigitales()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Expedientes Misionales - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-contratacion-expedientes-misionales').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/verExpedientesMisionales.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }
    public function verCasosEspeciales()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Casos especiales - Oficina Virtual";
        $data["script"] = "$('#menu-contratacion').click();$('#menu-contratacion-casosExpeciales').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/contratacion/verCasosExpeciales.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function programarExamenesMasivoFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Programar Exámenes Médicos - Oficina Virtual";
        $data["script"] = "$('#menu-emp-examenes').click();$('#menu-fidu-programarExamenes').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/examenes/programarExamenesMasivos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verExamenesMasivoFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Exámenes Médicos Solicitados - Oficina Virtual";
        $data["script"] = "$('#menu-emp-examenes').click();$('#menu-fidu-examenesMedicosSolicitados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/examenes/verExamenesMasivo.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verExamenesIndividualFidu()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Exámenes Médicos Programados - Oficina Virtual";
        $data["script"] = "$('#menu-emp-examenes').click();$('#menu-fidu-examenesMedicosProgramados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/examenes/verExamenesIndividual.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function reportarIncapacidad()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Reportar Incapacidad - Oficina Virtual";
        $data["script"] = "$('#menu-emp-novedades').click();$('#menu-emp-novedades-reportarIncapacidad').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/novedades/reportarIncapacidad.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }

    public function verIncapacidades()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        $data["title_app"] = "Incapacidades - Oficina Virtual";
        $data["script"] = "$('#menu-emp-novedades').click();$('#menu-emp-novedades-incapacidadesReportas').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/novedades/incapacidadesReportas.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }


    public function verHojadevidaDash()
    {
        $online = $this->checkstatus(true);
        if (!$online) $this->redirect("");

        if ($_SESSION["type_user"] != 2) die("No tienes permisos de acceso");

        $data["title_app"] = "Hoja de Vida - Oficina Virtual";
        $data["script"] = "$('#menu-seleccion').click();$('#menu-dash-hojadevida').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();

        $this->getView('layout/header.php', $data);
        $this->getView('layout/topmenu.php', $data);
        $this->getView('empresa/verHojadevidaDash.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php', $data);
    }
}

$object = new EmpresaController();
