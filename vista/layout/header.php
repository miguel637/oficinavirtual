<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $title_app; ?></title>
		<link rel="icon" type="image/png" href="<?php echo base_url();?>lib/img/favicon_hq5.png" sizes="48x48">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css?<?php echo filemtime("lib/css/general.css");?>">		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.13.0/css/pro.min.css">
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>	

		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
		<?php if(isset($js_extra_path)) echo $js_extra_path;?>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
		<script>var global_url = "<?php echo LINK_URL;?>";</script>
		<script src="<?php echo base_url();?>lib/js/template.js?<?php echo filemtime("lib/js/template.js");?>"></script>
		<script src="<?php echo base_url();?>lib/js/functions.js?<?php echo filemtime("lib/js/functions.js");?>"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
<div id='cuerpo' class='d-block'>
	<div class="loadingOFV d-none">
		<div class="loaderOFV"></div>
		<div id="textLoaderOFV" class="text-center" style="margin-top:10%"></div>
	</div>

	<style>
		.loadingOFV {
			position: fixed;
			top: 0; right: 0;
			bottom: 0; left: 0;
			background: #fff;
			z-index:999999999;
		}
		.loaderOFV {
			left: 50%;
			margin-left: -4em;
			font-size: 10px;
			border: .8em solid rgba(218, 219, 223, 1);
			border-left: .8em solid rgba(58, 166, 165, 1);
			animation: spin 1.1s infinite linear;
		}
		.loaderOFV, .loaderOFV:after {
			border-radius: 50%;
			width: 8em;
			height: 8em;
			display: block;
			position: absolute;
			top: 50%;
			margin-top: -4.05em;
		}

		@keyframes spin {
		0% {
			transform: rotate(360deg);
		}
		100% {
			transform: rotate(0deg);
		}
		}
	</style>