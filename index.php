<?php
	header("Content-Type: text/html;charset=utf-8");
	session_start();
	$ses = $_SESSION['logged'];
	if ($ses != "ok") {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Correspondencia Interna | Universidad del Cauca</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<table class="automargin margin-top">
				<tr>
					<td><img src="imgs/unicauca.png" class="padding"></td>
					<td class="text-center">
						<div id="red-container">
							<div id="darkRed-container">
								<h1 class="white-font title-font">Facultad de Ciencias de la Salud</h1>
								<h2 class="white-font title-font">Control de correspondencia</h2>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="white-container">
							<h2 class="text-center title-font blue-font">DOCUMENTOS RECIENTES</h2>
							<hr>
							<div class="text-right">
								<a id="btn-circle" href="nuevo.php" class="btn btn-default">
									<img src="imgs/add.png">
								</a>
								<a id="btn-circle" href="buscar.php" class="btn btn-default">
									<img src="imgs/search.png">
								</a>
								<a id="btn-circle" href="print.php" class="btn btn-default">
									<img src="imgs/printer.png">
								</a>
								<a id="btn-circle" href="login.php" class="btn btn-default">
									<img src="imgs/logout.png">
								</a>
							</div>
							<div>
								<?php
									include ("conexion.php");
									$con = mysqli_connect($host, $user, $pw, $db);
									$con->set_charset("utf8");
									$documents = mysqli_query($con, "SELECT * FROM documents ORDER BY id DESC LIMIT 15") or die ("prob_query: ".mysql_error());
								?>
								<form method="POST" action="documento.php">
								<table>
									<th class="text-center padding-sm">Fecha</th>
									<th class="text-center padding-sm">Remitente</th>
									<th class="text-center padding-sm">Asunto</th>
									<th class="text-center padding-sm">Accion</th>
									<?php
									while ($doc = mysqli_fetch_array($documents)) {
									?>
										<tr id="doc">
											<td class="padding-left-sm">
												<?php echo $doc['fechaIngreso']; ?>
											</td>
											<td class="padding-left-sm">
												<?php
													if (strlen($doc['nombreRemitente']) > 25) {
														echo substr($doc['nombreRemitente'],0,25)."...";
													} else {
														echo substr($doc['nombreRemitente'],0,25);
													}
												?>
											</td>
											<td class="padding-sm">
												<?php
													if (strlen($doc['asunto']) > 50) {
														echo substr($doc['asunto'],0,50)."<BR>".substr($doc['asunto'],50,50)."...";
													} else {
														echo substr($doc['asunto'],0,50);
													}
												?>
											</td>
											<td class="text-center">
												<button id="btn-circle" class="btn btn-default blue-font" name="ver" value=<?php echo $doc['id'];?> >Ver</button>
											</td>
										</tr>
									<?php } ?>
								</table>
								</form>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
		
	
</body>
</html>