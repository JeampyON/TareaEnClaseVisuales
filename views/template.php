<html>
	<head>

	<title> Cuarto B </title>
	<link rel="stylesheet" href="css/estilo.css">
	<meta charset="UTF-8">

	</head>
	<body>
		<header>
			<img src="image/bannerUta.png" width="100%" height="150"></img>
		</header>
		<nav>
			<ul>
				<li><a href="index.php?action=inicio">Inicio</a></li>
				<li><a href="index.php?action=nosotros">Nosotros</a></li>
				<li><a href="index.php?action=contactanos">Contactanos</a></li>
				<li><a href="index.php?action=servicios">Servicios</a></li>
			</ul>
		</nav>
		<section>
			

		</section>
        <?php
		require_once "controllers/controller.php";
        $mvc = new controllerMvc();
		$mvc->enlacesPaginasController();
		?>
		<footer>
			Derechos reservados @Cuartob SW
		</footer>

		<script>
			function sumar(){
				var num1 = parseInt(document.getElementById("txtNumero1").value);
				var num2 = parseInt(document.getElementById("txtNumero2").value);
				var res=num1+num2;
				alert(res);
			}
		</script>
	</body>
</html>