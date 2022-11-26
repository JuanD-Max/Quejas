<?php require('conexion.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir ciudad</title>
	<link rel="stylesheet" href="Asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>          
    <main class="principio">
		<section class="main">
			<form action="" method="post" class="form" autocomplete="off">
				<h2 class="form__title">Crea una ciudad</h2>
				<div class="form__container">
					<div class="form__group">
						<input type="text" name="name" placeholder=" " class="form__input" id="name" >
						<label for="name" class="form__label">Nombre Ciudad</label>
						<span class="form__line"></span>
					</div>
					<select class="form__select" name="departamento" aria-label="Default select example" required>
						<option value="0">Selecciona Departamento</option>
							<?php
								include("conexion.php");
								$departamentos = "SELECT * FROM departamentos";
								$result = mysqli_query($conexion,$departamentos);
								while ($list = mysqli_fetch_array($result)) {
								echo '<option value="'.$list['id_depart'].'">'.$list['nb_depart'].'</option>';
								}
							?>
					</select>
					<button name="Crear">Crear</button>
					<button name="Inicio">Inicio</button>
					<button name="Queja">Crear Queja</button>
				</div>
				<?php
					if(isset($_POST['Crear']) && !empty($_POST['name'])){
						if ($conexion->connect_errno) {
								echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
							}else{
								$nombre = $_POST['name'];
								$departamento = $_POST['departamento'];
								$sql = "INSERT INTO ciudades (nb_ciudad, id_depart) VALUES ('$nombre', '$departamento')";
								$result = $conexion->query($sql);
								if($result==true){
									echo"<p class='exito'>Ciudad Creada</p>";
								}else{
									echo"<p class='falla'>No se pudo crear la ciudad</p>".$conexion->error;
								}
							}
						mysqli_close($conexion);
					}

					if(isset($_POST['Inicio'])){
						echo '<script>window.location="index.php"</script>';
					}else if(isset($_POST['Queja'])){
						echo '<script>window.location="Agr_queja.php"</script>';
					}
				?>
			</form>
		</section>
	</main>

</body>
</html>