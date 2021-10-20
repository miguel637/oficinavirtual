<?php 
require 'modelo/practicanteModel.php';

class PracticanteController extends PracticanteModel
{
    
    public function __construct()
    {
        //$this->generarCodigoOAuthZoho();
    }

    public function verPostulados()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Candidatos en proceso - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-postulados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/postulados.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    

    public function verContratacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Contratación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-contratacion').click();$('#menu-practicantes-contratacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/contratacion/contratacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    

    public function verContratadosContracion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Contratados - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-contratacion').click();$('#menu-practicantes-verContratados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/contratacion/verContratadosContracion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    

    public function verListaBeneficiariosAfiliar()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Beneficiarios a Afiliar - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-contratacion').click();$('#menu-practicantes-listaBeneficiariosAfiliar').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/contratacion/verListaBeneficiariosAfiliar.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    

    public function verAfiliacionesTitular()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Afiliaciones Titular - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-contratacion').click();$('#menu-practicantes-contratacion-afiliacionesT').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/contratacion/afiliacionesTitular.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    

    public function verWorkdrive()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Workdrive - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-archivos').click();$('#menu-practicantes-Workdrive').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/archivos/workdrive.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarCliente()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Cliente - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-cliente').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/cliente.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verCliente()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Clientes - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-vercliente').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verCliente.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarPerfil()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Nuevo Perfil - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-addperfil').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/agregarPerfil.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verPerfiles()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Perfiles - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verperfiles').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verPerfiles.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verSeleccion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Selección - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verseleccion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verSeleccion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarCompensacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Compensación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-compensacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/compensacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    
    public function verCompensacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Compensación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verCompensacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verCompensacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    
    public function agregarFacturacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Facturación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-facturacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/facturacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    
    public function verFacturacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Facturación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verFacturacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verFacturacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function agregarDisciplinario()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Procesos Disciplinarios - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-disciplinario').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/disciplinario.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    
    public function verDisciplinario()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Procesos Disciplinarios - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verDisciplinario').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verDisciplinario.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verValidacionANS()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Validaciones ANS - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-validacionesANS').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verValidacionANS.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarSolicitudTecnologica()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Solicitud Tecnologica - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-solicitud-tecnologica').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/solicitudes/tecnologica.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function agregarSolicitudPapeleria()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Solicitud de Papeleria - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-solicitud-papeleria').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/solicitudes/papeleria.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function agregarReporteNovedadTecnica()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Reportar Novedad Tecnica - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-solicitud-reportarNovedadTecnica').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/solicitudes/reportarNovedadTecnica.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function verPendientesReferenciacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Pendientes por Referenciación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-es').click();$('#menu-practicantes-es-pendienteReferenciacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/es/pendienteReferenciacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function agregarReferenciacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Agregar Referenciación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-es').click();$('#menu-practicantes-es-agregarReferenciacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/es/agregarReferenciacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function verReferenciacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Agregar Referenciación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-es').click();$('#menu-practicantes-es-verReferenciaciones').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/es/verReferenciacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function agregarSolicitudSoporte()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Solicitud de Soporte - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ma').click();$('#menu-practicantes-ma-solicitud-soporte').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ma/solicitudSoporte.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function verSolicitudesMA()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Solicitudes - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ma').click();$('#menu-practicantes-ma-solicitudes').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ma/solicitudes.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function verDocumentosFaltantes()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Documentos Faltantes - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-archivos').click();$('#menu-practicantes-archivos-documentosFaltantes').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/archivos/documentosFaltantes.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarRequisicion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Agregar Requisiciones - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-agregarRequisicion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/agregarRequisicion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function verRequisiciones()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Requisiciones - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-verRequisiciones').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verRequisiciones.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verHojasVida()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Hojas de Vida - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-verHojasVida').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verHojasVida.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarConvocatoria()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Nueva Convocatoria - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-addConvocatoria').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/agregarConvocatoria.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verConvocatorias()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Convocatorias - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-verConvocatorias').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verConvocatorias.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verCandidatosPendientes()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Candidatos Pendientes - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-cantidadosPendientes').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verCandidatosPendientes.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verConvocatoriasDisponibles()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Convocatorias Disponibles - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-convocatoriasDisponibles').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verConvocatoriasDisponibles.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verConvocatoriasInternas()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Convocatorias Internas - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-convocatoriasInternas').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verConvocatoriasInternas.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verDevoluciones()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Devoluciones - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-devoluciones').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verDevoluciones.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarHojadeVida()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Nueva Hoja de Vida - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-addHojaVida').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/agregarHojadeVida.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }    

    public function verCargaDocumentos()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Carga de Documentos - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-verCargaDocumentos').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/verCargaDocumentos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verExpedientesValidar()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Expedientes a Validar - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-gd').click();$('#menu-practicante-gd-expedientesValidar').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/gd/verExpedientesValidar.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function expedientes_validados()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Expedientes validados GDO - Oficina Virtual";
        $data["script"] = "$('practicante-gd').click();$('#menu-practicantes-expedientes_validados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/gd/expendientesValidados.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function candidatosRechazados()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Candidatos rechazados - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-candidatosRechazados').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/seleccion/candidatosRechazados.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function expedientesIncompletos()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Expedientes incompletos GDO - Oficina Virtual";
        $data["script"] = "$('practicante-gd').click();$('#menu-practicantes-expedientesIncompletos').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/gd/expedientesIncompletos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function reportarIncapacidadNovedad()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Reportar Incapacidad - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-novedades').click();$('#menu-practicantes-novedades-reportarIncapacidad').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/novedades/reportarIncapacidad.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function incapacidadesReportadasNovedad()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Incapacidades Reportadas - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-novedades').click();$('#menu-practicantes-novedades-incapacidadesReportas').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/novedades/incapacidadesReportadas.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }


    public function agregarContratacion()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Contratación - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-contratacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/contratacion.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  

    public function agregarServicio()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Servicio - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-servicio').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/servicio.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  


    public function verContratacionAns()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Contratacion - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verContratacion').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verContratacionAns.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  

    public function verServicio()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Servicio - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-verServicio').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/verServicio.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  

    public function verSst()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Ver Sst - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-ans').click();$('#menu-practicantes-ans-VerSst').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/ans/sst.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  

    //Gestion de Riesgo
    public function VerErroresOrganizacionales()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Errores Organizacionales - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-gestionriesgo').click();$('#menu-practicantes-gestionriesgo-VerErroresOrganizacionales').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/gestionriesgo/VerErroresOrganizacionales.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  

    public function VerDescargos()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Descargos - Oficina Virtual";
        $data["script"] = "$('#menu-practicante-gestionriesgo').click();$('#menu-practicantes-gestionriesgo-VerDescargos').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/gestionriesgo/VerDescargos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }  

    public function solicitudPuesto()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Solicitud Puesto de Trabajo";
        $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-solicitud-puesto').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('funcionario/solicitudes/solicitudPuesto.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    } 



public function solicitudesTecnologicas()
{
    $online = $this->checkstatus(true);
    if(!$online) $this->redirect("");

    $data["title_app"] = "Solicitud Puesto de Trabajo";
    $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-solicitudes-tecnologica').addClass('active');";
    $data["modulos"] = $this->getModulosHabilitados();
    
    $this->getView('layout/header.php',$data);
    $this->getView('layout/topmenu.php',$data);
    $this->getView('funcionario/solicitudes/solicitudesTecnologicas.php');
    $this->getView('layout/bottommenu.php');
    $this->getView('layout/footer.php',$data);
} 



public function casosReportados()
{
    $online = $this->checkstatus(true);
    if(!$online) $this->redirect("");

    $data["title_app"] = "Soliciutdes de soporte";
    $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-casosSoporte').addClass('active');";
    $data["modulos"] = $this->getModulosHabilitados();
    
    $this->getView('layout/header.php',$data);
    $this->getView('layout/topmenu.php',$data);
    $this->getView('funcionario/solicitudes/casosReportados.php');
    $this->getView('layout/bottommenu.php');
    $this->getView('layout/footer.php',$data);
} 

public function solicitudesPapeleria()
{
    $online = $this->checkstatus(true);
    if(!$online) $this->redirect("");

    $data["title_app"] = "Solicitudes Papeleria";
    $data["script"] = "$('#menu-practicante-solicitudes').click();$('#menu-practicantes-solicitud-solicutdesPapeleria').addClass('active');";
    $data["modulos"] = $this->getModulosHabilitados();
    
    $this->getView('layout/header.php',$data);
    $this->getView('layout/topmenu.php',$data);
    $this->getView('funcionario/solicitudes/solicitudesPapeleria.php');
    $this->getView('layout/bottommenu.php');
    $this->getView('layout/footer.php',$data);
} 


public function hojadevidaBasica()
{
    $online = $this->checkstatus(true);
    if(!$online) $this->redirect("");

    $data["title_app"] = "Hoja de Vida Basica";
    $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicantes-solicitud-solicutdesPapeleria').addClass('active');";
    $data["modulos"] = $this->getModulosHabilitados();
    
    $this->getView('layout/header.php',$data);
    $this->getView('layout/topmenu.php',$data);
    $this->getView('funcionario/seleccion/hojadevidaBasica.php');
    $this->getView('layout/bottommenu.php');
    $this->getView('layout/footer.php',$data);
}


public function retroalimentacion_hv()
{
    $online = $this->checkstatus(true);
    if(!$online) $this->redirect("");

    $data["title_app"] = "Retroalimentación Hv";
    $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-retroalimentacion_hv').addClass('active');";
    $data["modulos"] = $this->getModulosHabilitados();
    
    $this->getView('layout/header.php',$data);
    $this->getView('layout/topmenu.php',$data);
    $this->getView('funcionario/seleccion/retroalientacionHv.php');
    $this->getView('layout/bottommenu.php');
    $this->getView('layout/footer.php',$data);
}

public function postulacionMasiva()
{
    $online = $this->checkstatus(true);
    if(!$online) $this->redirect("");

    $data["title_app"] = "Postulación Masiva";
    $data["script"] = "$('#menu-practicante-seleccion').click();$('#menu-practicante-postulacion_masiva').addClass('active');";
    $data["modulos"] = $this->getModulosHabilitados();
    
    $this->getView('layout/header.php',$data);
    $this->getView('layout/topmenu.php',$data);
    $this->getView('funcionario/seleccion/postulacionMasiva.php');
    $this->getView('layout/bottommenu.php');
    $this->getView('layout/footer.php',$data);
}




}




$object = new PracticanteController();