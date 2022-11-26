<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCQ</title>
    <link rel="stylesheet" href="Asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <main class="principio">
        <section class="main">
            <form action="" method="post">
                <h2>Sistema de Creación de Quejas</h2>
                <p class="indication_procedure">Crear Departamentos y Ciudades</p>
                <button name="iniciar">Iniciar</button>
                <p class="indication_procedure">Agregar queja</p>
                <button name="queja">Queja</button>
            </form>
        </section>
    </main>
</body>
</html>

<?php
    if(isset($_POST['queja'])){
        echo '<script>window.location="Agr_queja.php"</script>';
    }else if(isset($_POST['iniciar'])){
        echo '<script>window.location="Agr_dep.php"</script>';
    }
?>