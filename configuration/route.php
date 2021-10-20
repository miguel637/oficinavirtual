<?php

$routes = [
    "" => "home/ingreso",
    "proceso/cargarDocumentos" => "home/cargarDocumentos",
    "restablecer" => "home/restablecer",
    "pqrs" => "empresa/pqrs",
    "solicitudSeguridad" => "empresa/seguridadSolicitud",
    "authLoginRequest" => "home/validarLogin",
    "authLogout" => "home/cerrarSesion",
    "authChangePswRequest" => "home/cambiarClave",

    "apiZoho/gd_enviar_validacion" => "zoho/gd_enviar_validacion",
    "api/updateUserPassword" => "admin/cambiarClaveUsuarioMisional",
    "api/afiliarTitular" => "home/afiliarTitular",
    "api/postuladoExecuteContratado" => "home/btnContratadoPostulados",
    "api/postuladoExecuteActualizarSign" => "home/btnActualizarSignPostulados",

    "panel" => "home/verPanel",    
    "calendar" => "home/verCalendario", 
    "agregarRequisicion" => "empresa/addReq",
    "verRequisicion" => "empresa/verReq",
    "agregarPerfil" => "empresa/addPerfil",
    "verInterview" => "empresa/verEntrevistas",
    "nuevaOrden" => "empresa/newOrden",
    "verOrden" => "empresa/verOrdenes",
    "verSeguimiento" => "empresa/verSeguimiento",
    "verContratos" => "empresa/verContratosNomina",
    "verExpedientes" => "empresa/verExpedientes",
    "emp/reportarIncapacidad" => "empresa/reportarIncapacidad",
    "emp/verIncapacidades" => "empresa/verIncapacidades",
    "emp/expedientesDigital" => "empresa/verExpedientesDigitales",
    "sst/reportCovid" => "empresa/reportarCovid",
    "sst/reportesCovid" => "empresa/verReporteCovid",
    "emp/gestionriesgo/nuevoDescargo" => "empresa/nuevoDescargo",
    "emp/gestionriesgo/verDescargos" => "empresa/verDescargos",
    "emp/gestionriesgo/reportarErrorOrganizacion" => "empresa/nuevoErrorOrganizacional",
    "emp/gestionriesgo/erroresOrganizacionalesReportados" => "empresa/verErroresOrganizacionales",
    "fidu/contratosEnviados" => "empresa/verContratosEnviadosFidu",
    "fidu/afiliacionesTitular" => "empresa/verAfiliacionesTitularFidu",
    "fidu/contratados" => "empresa/verContratadosFidu",
    "fidu/requisiciones" => "empresa/verRequisicionesFidu",
    "fidu/verPerfiles" => "empresa/verPerfilesFidu",
    "fidu/agregarConvocatoria" => "empresa/agregarConvocatoriaFidu",
    "fidu/convocatorias" => "empresa/verConvocatoriasFidu",
    "fidu/postulados" => "empresa/verPostuladosFidu",
    "fidu/agregarValidacionTitulos" => "empresa/agregarValidacionTitulosFidu",
    "fidu/validacionesTitulos" => "empresa/verValidacionesTitulosFidu",
    "fidu/newReferenciacion" => "empresa/agregarReferenciacionFidu",
    "fidu/verReferenciaciones" => "empresa/verReferenciacionesFidu",
    "fidu/agregarHojaVida" => "empresa/agregarHojaVidaFidu",
    "fidu/verHojasVida" => "empresa/verHojasVidaFidu",
    "fidu/candidatosDrive" => "empresa/cargarWorkdriveCandidatos",
    "fidu/verConvocatoriasDisponibles" => "empresa/verConvocatoriasDisponiblesFidu",
    "fidu/verConvocatoriasInternas" => "empresa/verConvocatoriasInternasFidu",
    "fidu/folderContratos" => "empresa/verCarpetaContratosFidu",
    "fidu/programarExamenesMedicos" => "empresa/programarExamenesMasivoFidu",
    "fidu/examenesMedicosSolicitados" => "empresa/verExamenesMasivoFidu",
    "fidu/examenesMedicosProgramados" => "empresa/verExamenesIndividualFidu",
    "verHojadevidaDash" => "empresa/verHojadevidaDash",

    "dashboard" => "admin/verDashboard",
    "misDocumentos" => "empleado/verDocumentos",
    "sst/reportarCovid" => "empleado/reportarCovid",
    "miHojaVida" => "empleado/hojadevida",
    "misBeneficiarios" => "empleado/verBeneficiarios",
    "addBeneficiario" => "empleado/agregarBeneficiario",
    "seguridad/cambiarPassword" => "empleado/cambiarPassword",
    "generarIncapacidad" => "empleado/crearIncapacidad",
    "incapacidadesGeneradas" => "empleado/verIncapacidades",

    "practic/postulados" => "practicante/verPostulados",
    "practic/contratacion" => "practicante/verContratacion",
    "practic/contratacion_AfiliacionTitular" => "practicante/verAfiliacionesTitular",
    "practic/contratacionContratados" => "practicante/verContratadosContracion",
    "practic/contratacionlistaBeneficiariosAfiliar" => "practicante/verListaBeneficiariosAfiliar",
    "practic/workdrive/candidatos" => "practicante/verWorkdrive",
    "practic/workdrive/documentosFaltantes" => "practicante/verDocumentosFaltantes",
    "practic/ans_cliente" => "practicante/agregarCliente",
    "practic/ans_verCliente" => "practicante/verCliente",
    "practic/ans_agregarPerfil" => "practicante/agregarPerfil",
    "practic/ans_perfiles" => "practicante/verPerfiles",
    "practic/ans_verSeleccion" => "practicante/verSeleccion",
    "practic/ans_compensacion" => "practicante/agregarCompensacion",
    "practic/ans_verCompensacion" => "practicante/verCompensacion",
    "practic/ans_facturacion" => "practicante/agregarFacturacion",
    "practic/ans_verFacturacion" => "practicante/verFacturacion",
    "practic/ans_disciplinario" => "practicante/agregarDisciplinario",
    "practic/ans_verDisciplinario" => "practicante/verDisciplinario",
    "practic/ans_validacionANS" => "practicante/verValidacionANS",
     // View
    "practic/ans_contratacion" => "practicante/agregarContratacion",
    "practic/ans_servicio" => "practicante/agregarServicio",
    // Report
    "practic/ans_verContratacion" => "practicante/verContratacionAns",
    "practic/ans_verServicio" => "practicante/verServicio",
    "practic/ans_verSst" => "practicante/verSst",

    "practic/gestionriesgo_VerErroresOrganizacionales" => "practicante/VerErroresOrganizacionales",
    "practic/gestionriesgo_VerDescargos" => "practicante/VerDescargos",
      
    "practic/solicitud_tecnologica" => "practicante/agregarSolicitudTecnologica",
    "practic/solicitud_papeleria" => "practicante/agregarSolicitudPapeleria",
    "practic/solicitud_reportarNovedadTecnica" => "practicante/agregarReporteNovedadTecnica",
    "practic/es_pendienteReferenciacion" => "practicante/verPendientesReferenciacion",
    "practic/es_referenciacion" => "practicante/agregarReferenciacion",
    "practic/es_verReferenciacion" => "practicante/verReferenciacion",
    "practic/ma_solicitudSoporte" => "practicante/agregarSolicitudSoporte",
    "practic/ma_solicitudes" => "practicante/verSolicitudesMA",
    "practic/agregarRequisicion" => "practicante/agregarRequisicion",
    "practic/verRequisiciones" => "practicante/verRequisiciones",
    "practic/verHojasVida" => "practicante/verHojasVida",
    "practic/newConvocatoria" => "practicante/agregarConvocatoria",
    "practic/verConvocatorias" => "practicante/verConvocatorias",
    "practic/candidatosPendientes" => "practicante/verCandidatosPendientes",
    "practic/convocatoriasDisponibles" => "practicante/verConvocatoriasDisponibles",
    "practic/convocatoriasInternas" => "practicante/verConvocatoriasInternas",
    "practic/devoluciones" => "practicante/verDevoluciones",
    "practic/nuevaHojaVida" => "practicante/agregarHojadeVida",
    "practic/verCargaDocumentos" => "practicante/verCargaDocumentos",
    "practic/verExpedientesValidar" => "practicante/verExpedientesValidar",
    "practic/expedientes_validados" => "practicante/expedientes_validados",
    "practic/candidatosRechazados" => "practicante/candidatosRechazados",
    "practic/expedientesIncompletos" => "practicante/expedientesIncompletos",
    "practic/NovReportarIncapacidad" => "practicante/reportarIncapacidadNovedad",
    "practic/NovIncapacidadesReportadas" => "practicante/incapacidadesReportadasNovedad",
    "practic/solicitud_puesto" => "practicante/solicitudPuesto",
    "practic/solicitudes_tecnologicas" => "practicante/solicitudesTecnologicas",
    "practic/casos_soporte" => "practicante/casosReportados",
    "practic/solicitudesPapeleria" => "practicante/solicitudesPapeleria",
    "practic/hojadevidaBasica" => "practicante/hojadevidaBasica",
    "practic/retroalimentacion_hv" => "practicante/retroalimentacion_hv",
    "practic/postulacionMasiva" => "practicante/postulacionMasiva",

    "control/ingresoStaff" => "control/ingresoPersonal",
    "control/salidaStaff" => "control/salidaPersonal",
    "control/reporteSintomas" => "control/reporteSintomas",
    "control/status" => "control/doStatus",
    "control/actualizarHV" => "control/actualizarHojaVida",

    "admon/users" => "admin/administrarUsers",
    "admon/syncusers" => "admin/sincronizarUsers",
    "admon/syncmisionales" => "admin/sincronizarMisionales",
    "admon/syncpracticantes" => "admin/sincronizarPracticantes",
    "admon/adduser" => "admin/agregarUsers",
    "admon/addmisions" => "admin/agregarMisionales",
    "admon/addpracticante" => "admin/agregarPracticante",
    "closePage" => "home/closePage",
    "error" => "error",

    "generateToken/refZoho" => "zoho/generateToken"
];