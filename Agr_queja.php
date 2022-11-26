<?php
require ('conexion.php');
$query = "SELECT id_depart, nb_depart FROM departamentos ORDER BY nb_depart";
$resultado=$conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poner una queja</title>
    <script language="javascript" src="Libreria/jquery-3.1.1.min.js"></script>
    <script language="javascript">
        $(document).ready(function(){
			$("#cbx_departamento").change(function () {
				$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
				$("#cbx_departamento option:selected").each(function () {
					id_depart = $(this).val();
					$.post("Asset/getCiudad.php", { id_depart: id_depart }, function(data){
							$("#cbx_ciudad").html(data);
                	});
				});
			})
		});
    </script>
	<link rel="stylesheet" href="Asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">
	
</head>
<body>
    <main class="queja">
		<section class="main queja">
			<h2 class="form__title">Crea una Queja</h2>
			<div class="form__container">
				<form class="form"  name="combo" action="" method="POST">
					<div>
						<textarea class="textarea" name="txtqueja" id="txtqueja" placeholder="Ingrese su queja" maxlength="150" minlength="30"></textarea>
					</div>
					<select  class="form__select" name="cbx_departamento" id="cbx_departamento">
						<option value="0">Departamento</option>
						<?php while($row = $resultado->fetch_assoc()) { ?>
						<option value="<?php echo $row['id_depart']; ?>"><?php echo $row['nb_depart']; ?></option>
						<?php } ?>
					</select>
					
					<select class="form__select" name="cbx_ciudad" id="cbx_ciudad">
						<option value="0">Ciudad</option>
					</select>
					
					<button name="Crear">Crear Queja</button>
					<button name="Listar" class="lista">Listar</button>
					<button name="Inicio" class="">Inicio</button>
					<?php
						if(isset($_POST['Crear']) && !empty($_POST['txtqueja'])){
							if ($conexion->connect_errno) {
									echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
								}else{
									$queja = $_POST['txtqueja'];
									$departamento = $_POST['cbx_departamento'];
									$ciudad = $_POST['cbx_ciudad'];
									$sql = "INSERT INTO quejas (queja, id_depart, id_ciudad) VALUES ('$queja', '$departamento', '$ciudad')";
									$result = $conexion->query($sql);
									if($result==true){
										echo"<p class='exito'>Queja Creada Exitosamente.</p>";
									}else{
										echo"<p class='falla'>Error al crear la queja. </p>".$conexion->error;
									}
								}
							mysqli_close($conexion);
						}
					?>			
				</form>
			</div>
		</section>
		
		<?php
			if(isset($_POST["Listar"])){
				$sql  = "SELECT * FROM quejas q INNER JOIN departamentos d ON q.id_depart = d.id_depart INNER JOIN ciudades c ON q.id_ciudad = c.id_ciudad";
				$result   = $conexion->query($sql);
				while ($fil = $result->fetch_array()){?>
					<section class="quejas">
						<form action="" class="form">
							<h2 class="form__title">Queja</h2>
							<div class="form__container">
								
								<div class="form__group">
									<input type="text" name="departamento" placeholder=" " class="form__input" id="departamento" value="<?php echo $fil['nb_depart']; ?>"readonly>
									<label for="departamento" class="form__label">Departamento</label>
									<span class="form__line"></span>
								</div>
								<div class="form__group">
									<input type="text" name="ciudad" placeholder=" " class="form__input" id="ciudad" value="<?php echo $fil['nb_ciudad']; ?>"readonly>
									<label for="ciudad" class="form__label">Ciudad</label>
									<span class="form__line"></span>
								</div>
								<textarea class="textareaq" readonly><?php echo $fil['queja']; ?> </textarea>
							</div>
						</form>
					</section>
		<?php
				}
					if (mysqli_num_rows($result) == 0) {
						echo"<center><p class='falla'>No data found</p></center>".$conexion->error;
					}
					mysqli_close($conexion);
			}

			if(isset($_POST['Inicio'])){
				echo '<script>window.location="index.php"</script>';
			}
		?>
	</main>
</body>
</html>

