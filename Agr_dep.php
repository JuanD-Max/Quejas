<?php require('Conexion.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir departamento</title>
	<link rel="stylesheet" href="Asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
	<main class="principio">
		<section class="main">
			<form action="" method="post" class="form" autocomplete="off">
				<h2 class="form__title">Crear departamento</h2>
				<div class="form__container">
					<div class="form__group">
						<input type="text" id="name"class="form__input"name="name" placeholder=" ">
						<label for="name" class="form__label">Nombre Departamento</label>
						<span class="form__line"></span>
					</div>
					<button name="Crear">Crear</button>
					<button name="ciudad">Crear Ciudad</button>
					<?php
						if(isset($_POST['Crear']) && !empty($_POST['name'])){
							if ($conexion->connect_errno) {
								echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
							}else{
								$nombre = $_POST['name'];
								$sql = "INSERT INTO departamentos (nb_depart) VALUES ('$nombre')";
								$result = $conexion->query($sql);
								if($result==true){
									echo"<p class='exito'>Departamento Creado Exitosamente.</p>";
								}else{
									echo"<p class='falla'>Error al crear el Departamento. </p>".$conexion->error;
								}
							}
							mysqli_close($conexion);
						}

						if(isset($_POST['ciudad'])){
							echo '<script>window.location="Agr_ciudad.php"</script>';
						}
					?>
				</div>
				
			</form>
		</section>
	</main>
</body>
</html>

