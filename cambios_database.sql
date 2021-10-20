
/** En este espacio se copian las consultas que se requieren en las actualizaciones ***/


INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES (NULL, 'Lista de Beneficiarios Afiliar', 'Modulo_Practicante_Lista_de_Beneficiarios_Afiliar', 'Contratacion', '4', '1', '13.12', '4', NOW());

INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES (NULL, '92', 'dropdown-function d-none menu-practicante-contratacion', 'menu-practicantes-listaBeneficiariosAfiliar', 'practic/contratacionlistaBeneficiariosAfiliar', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Lista Beneficiarios a Afiliar', '', NOW());

/* COMMIT: updateViewRepoert fecha: 26/05/2021 en el modulo funcionarios, Solicitud de Recursos */

/* Se realiza la actualización del orden de las solicitudes de recursos... Nota: Aplicarlos unicamente a los ambientes de pruebas. Ya está en producción */

update modulos set orden=18 where id=24;
update modulos set orden=22 where id=25;
update modulos set orden=20 where id=26;

/* Se realiza inserción de 3 reportes */

INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES
(92, 87, 'dropdown-function d-none menu-practicante-solicitudes', 'menu-practicantes-solicitudes-tecnologica', 'practic/solicitudes_tecnologicas', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Solicitudes Tecnológicas', '', '2020-09-26 00:01:20'),
(93, 88, 'dropdown-function d-none menu-practicante-solicitudes', 'menu-practicantes-solicitud-casosSoporte', 'practic/casos_soporte', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Casos Reportados', '', '2020-09-26 00:01:20'),
(94, 89, 'dropdown-function d-none menu-practicante-solicitudes', 'menu-practicantes-solicitud-solicitudesPapeleria', 'practic/solicitudesPapeleria', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Solicitudes de Papelería', '', '2020-09-26 00:01:20');

/* Se realiza inserción de 3 reportes Nota: Aplicarlos unicamente a los ambientes de pruebas. Ya está en producción*/

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(92, 'solicitudes tecnológicas', 'Modulo_Practicante_Solicitudes_Tecnologicas', 'Solicitud de Recursos', 7, 1, 19, 4, '2020-09-25 23:33:39'),
(93, 'Casos reportados', 'Modulo_Practicante_Recursos_Casos_Reportados', 'Solicitud de Recursos', 7, 1, 21, 4, '2020-09-25 23:33:39'),
(94, 'solicitudes de papelería', 'Modulo_Practicante_Solicitudes_Papeleria', 'Solicitud de Recursos', 7, 1, 23, 4, '2020-09-25 23:33:39');

/** COMMIT: update 10-05-21 - Gestión de Riesgo Descargos Nota: Aplicarlos unicamente a los ambientes de pruebas. Ya está en producción**/
/** Fecha: 10-05-21 **/

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(89, 'Ver Errores Organizacionales', 'Modulo_GestionRiesgo_4', 'gestionriesgo', 8, 1, 4, 2, '2021-05-10 13:56:39'),
(88, 'Nuevo Error Organizacional', 'Modulo_GestionRiesgo_3', 'gestionriesgo', 8, 1, 3, 2, '2021-05-10 13:56:39'),
(87, 'Ver Descargos', 'Modulo_GestionRiesgo_2', 'gestionriesgo', 8, 1, 2, 2, '2021-05-10 13:56:39'),
(86, 'Nuevo Descargo', 'Modulo_GestionRiesgo_1', 'gestionriesgo', 8, 1, 1, 2, '2021-05-10 13:56:39');

INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES
(93, 89, 'dropdown-function d-none menu-gestionriesgo', 'menu-gestionriesgo-verErroresOrganizacionales', 'emp/gestionriesgo/erroresOrganizacionalesReportados', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Errores Organizacionales', '', '2021-05-10 13:59:17'),
(92, 88, 'dropdown-function d-none menu-gestionriesgo', 'menu-gestionriesgo-nuevoErrorOrganizacional', 'emp/gestionriesgo/reportarErrorOrganizacion', 'cr-href', '', 'fas fa-plus mr-3 ml-1', 'Reportar Error Organizacional', '', '2021-05-10 13:59:17'),
(91, 87, 'dropdown-function d-none menu-gestionriesgo', 'menu-gestionriesgo-verDescargos', 'emp/gestionriesgo/verDescargos', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Ver Descargos', '', '2021-05-10 13:59:17'),
(90, 86, 'dropdown-function d-none menu-gestionriesgo', 'menu-gestionriesgo-nuevoDescargo', 'emp/gestionriesgo/nuevoDescargo', 'cr-href', '', 'fas fa-plus mr-3 ml-1', 'Nuevo Descargo', '', '2021-05-10 13:59:17');

--Funcionarios

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(91, 'Errores Organizacionales', 'Modulo_Practicante_GestionRiesgo_VerErroresOrganizacionales', 'gestionriesgo', 10, 1, 2, 4, '2021-05-10 16:17:16'),
(90, 'Descargos', 'Modulo_Practicante_GestionRiesgo_VerDescargos', 'gestionriesgo', 10, 1, 1, 4, '2021-05-10 16:17:16');


INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES
(95, 91, 'dropdown-function d-none menu-practicante-gestionriesgo', 'menu-practicantes-gestionriesgo-VerErroresOrganizacionales', 'practic/gestionriesgo_VerErroresOrganizacionales', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Errores Organizacionales', '', '2021-05-10 16:18:29'),
(94, 90, 'dropdown-function d-none menu-practicante-gestionriesgo', 'menu-practicantes-gestionriesgo-VerDescargos', 'practic/gestionriesgo_VerDescargos', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Descargos', '', '2021-05-10 16:18:29');

--

/** COMMIT: update 15-04-21 - Update oreder view Officials**/ 
/** Fecha: 15-04-21 **/


update modulos set orden=3 where nombre='Contratacion';
update modulos set orden=4 where nombre='Acuerdos de Contratacion';
update modulos set orden=5 where nombre='Acuerdos Sst';
update modulos set orden=6 where nombre='Compensación';
update modulos set orden=7 where nombre='Ver Compensación';
update modulos set orden=8 where nombre='Ver Compensación';
update modulos set orden=9 where nombre='Facturación';
update modulos set orden=10 where nombre='Ver Facturación';
update modulos set orden=11 where nombre='Procesos Disciplinarios';
update modulos set orden=12 where nombre='Ver Procesos Disciplinarios';
update modulos set orden=13 where nombre='Servicio';
update modulos set orden=14 where nombre='Acuerdos de Servicio';
update modulos set orden=15 where nombre='VALIDACION DE ANS';

update modulos set nombre='Devoluciones' where orden=9.9;
update modulos set nombre='Postulados' where orden=9.5;
update modulos set nombre='Candidatos rechazados' where orden=10;
update modulos set nombre='Carga de Documentos' where orden=11;

/** COMMIT: update Cambios Req, Expediente,Contratados and more...**/ 
/** Fecha: 14-04-21 **/


UPDATE `modulos_estructura` SET `html_name` = 'Candidatos en Proceso' WHERE `modulos_estructura`.`id` = 17;
UPDATE `modulos_estructura` SET `html_name` = 'Candidatos en Proceso' WHERE `modulos_estructura`.`id` = 44;


/** COMMIT: update 14-04-21 - Update view Officials**/ 
/** Fecha: 14-04-21 **/


INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES(85, 'Acuerdos Sst', 'Modulo_Practicante_Sst', 'ANS', 1, 1, 13, 4, '2020-09-26 04:33:23');

INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES (89, 85, 'dropdown-function d-none menu-practicante-ans', 'menu-practicantes-ans-VerSst', 'practic/ans_verSst', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Ver Sst', '', '2020-09-26 04:45:36');

/* COMIT 14/04/2021- Candidatos rechazados tenia el signo de + */

update modulos_estructura set tag_icon_class='fas fa-list mr-3 ml-1' where id_modulo=75;



/** COMIT: update 18/03/2021 - ANS cambio de Seguimiento encima de Entrevistas **/ 

update modulos set orden=2 where nombre='Seguimiento';

-- Actualiza el icono Agregar perfil, anteriormente estaba con otro.

update modulos_estructura set tag_icon_class='fas fa-plus mr-3 ml-1' where tag_a_href='agregarPerfil';

/** COMMIT: update 19-02-21 - Incapacidades Funcionarios **/ 
/** Fecha: 19/02/2021 **/

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(78, 'Incapacidades Reportadas', 'Modulo_Practicante_Novedad_IncapacidadesReportadas', 'Novedades', 6, 1, 2, 4, '2021-02-19 14:14:11'),
(77, 'Reportar Incapacidad', 'Modulo_Practicante_Novedad_ReportarIncapacidad', 'Novedades', 6, 1, 1, 4, '2021-02-19 14:11:45');


INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES
(82, 78, 'dropdown-function d-none menu-practicante-novedades', 'menu-practicantes-novedades-incapacidadesReportas', 'practic/NovIncapacidadesReportadas', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Incapacidades Reportadas', '', '2021-02-19 14:14:52'),
(81, 77, 'dropdown-function d-none menu-practicante-novedades', 'menu-practicantes-novedades-reportarIncapacidad', 'practic/NovReportarIncapacidad', 'cr-href', '', 'fas fa-bell mr-3 ml-1', 'Reportar Incapacidad', '', '2021-02-19 14:13:42');

/** COMMIT: Update view expedientes_v and candidatosR **/ 
/** Fecha: 08/02/2021 **/

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(72, 'Expendientes Validados GDO', 'Modulo_Practicante_expedientesValidados', 'GD', 9, 1, 2, 4, '2021-02-05 18:05:41'),
(73, 'Candidatos rechazados', 'Modulo_Practicante_Candidato_Rechazado', 'Seleccion', 2, 1, 11, 4, '2021-02-05 18:05:51');

(76, 73, 'dropdown-function d-none menu-practicante-gd', 'menu-practicantes-expedientes_validados', 'practic/expedientes_validados', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Expendientes validados GDO', '', '2020-09-25 19:01:20'),
(77, 74, 'dropdown-function d-none menu-practicante-seleccion', 'menu-practicante-candidatosRechazados', 'practic/candidatosRechazados\r\n', 'cr-href', '', 'fas fa-plus mr-3 ml-1', 'Candidatos Rechazados', '', '2020-06-30 19:27:29');




/** COMMIT: Nueva vista de expedientes incompletos*/
/** Fecha: 12/02/2021 ** modelo/ **/

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(74, 'Expedientes Incompletos - GDO', 'Modulo_Expedientes_Incompletos_Gdo', 'GD', 9, 1, 3, 4, '2021-02-05 18:05:51');



INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES
(78, 75, 'dropdown-function d-none menu-practicante-gd', 'menu-practicantes-expedientesIncompletos', 'practic/expedientesIncompletos', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Expedientes incompletos GDO', '', '2020-09-25 19:01:20');



/** COMMIT: View Contratacion y Servicio del ANS - report Ver Servicio y Ver Contratacion*/
/** Fecha: 02/03/2021 ** modelo/ **/


--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `field_zoho`, `section`, `orden_section`, `activo`, `orden`, `tipo_usuario`, `fecha`) VALUES
(76, 'Contratacion', 'Modulo_Practicante_ANS_Contratacion', 'ANS', 1, 1, 9, 4, '2020-09-25 18:33:23'),
(77, 'Acuerdos de Contratacion', 'Modulo_Practicante_ANS_Acuerdos_Contratacion', 'ANS', 1, 1, 10, 4, '2020-09-25 18:33:23'),
(78, 'Servicio', 'Modulo_Practicante_ANS_Servicio', 'ANS', 1, 1, 11, 4, '2020-09-25 18:33:23'),
(79, 'Acuerdos de Servicio', 'Modulo_Practicante_ANS_Acuerdos_Servicio', 'ANS', 1, 1, 12, 4, '2020-09-25 18:33:23');


--
-- Volcado de datos para la tabla `modulos_estructura`
--

INSERT INTO `modulos_estructura` (`id`, `id_modulo`, `tag_li_class`, `tag_li_id`, `tag_a_href`, `tag_a_class`, `tag_a_id`, `tag_icon_class`, `html_name`, `html_icon_end`, `fecha`) VALUES

(79, 76, 'dropdown-function d-none menu-practicante-ans', 'menu-practicantes-ans-contratacion', 'practic/ans_contratacion', 'cr-href', '', 'fas fa-plus mr-3 ml-1', 'Contratación', '', '2020-09-25 18:45:36'),
(80, 77, 'dropdown-function d-none menu-practicante-ans', 'menu-practicantes-ans-verContratacion', 'practic/ans_verContratacion', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Ver Contratación', '', '2020-09-25 18:45:36'),
(81, 78, 'dropdown-function d-none menu-practicante-ans', 'menu-practicantes-ans-servicio', 'practic/ans_servicio', 'cr-href', '', 'fas fa-plus mr-3 ml-1', 'Servicio', '', '2020-09-25 18:45:36'),
(82, 79, 'dropdown-function d-none menu-practicante-ans', 'menu-practicantes-ans-verServicio', 'practic/ans_verServicio', 'cr-href', '', 'fas fa-list mr-3 ml-1', 'Ver Servicio', '', '2020-09-25 18:45:36');