<html>
	<head>
		<script src="libs/jquery.min.js"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="libs/javascript.js"></script>
		
	</head>
	<body>
		<div class="container">
			<div class="span10 well">
				<h1> Configuration du serveur </h1>
			</div>
			<?
			$conf = file_get_contents("xbmc.ini");
			?>
			<div class="span10 well">
				<h3> Fichier de configuration </h3>
				<textarea class="span6" style="height:200px;"><?=$conf?></textarea> 
				<p><button class="btn" onClick="validerIni();"> Valider </button></p>
			</div>
			<div class="span10 well">
				<a class="btn btn-danger"> Lancer le script </a>
			</div>
		</div>
	</body>

</html>