<?php

$this->title = 'Booking Now';
use yii\helpers\Url;
use yii\helpers\Html;

?>


<style>
/* estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}v

header {
    background-color: #333;
    color: #fff;
    padding: 1em;
    text-align: center;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2em;
}

.match-container {
    background-color: #f7f7f7;
    padding: 1em;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.match {
    display: flex;
    align-items: center;
    margin-bottom: 1em;
}

.date {
    font-size: 1.2em;
    font-weight: bold;
    margin-right: 1em;
}

.teams {
    display: flex;
    align-items: center;
}

.teams img {
    width: 100px;
    height: 100px;
    margin: 0 1em;
}

.teams span {
    font-size: 1.5em;
    font-weight: bold;
}
</style>

<!-- index.html -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligas Barriales Ecuador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <!-- navegación -->
        </nav>
    </header>
    <main>
        <!-- contenido dinámico -->
        <section class="match-container">
            <h2>Partidos</h2>
            <ul>
                <!-- lista de partidos -->
                <li>
                    <div class="match">
                        <span class="date">Fecha: <span>2023-02-15</span></span>
                        <div class="teams">
                            <img src="https://www.futbox.com/img/v1/5b1/ecb/e69/e45/09b75491e5ae71f116e9.png" alt="Equipo 1">
                            <span>vs</span>
                            <img src="https://i.pinimg.com/474x/1c/a9/e6/1ca9e6137507ff5cb1f7d11201ad3726.jpg" alt="Equipo 2">
                        </div>
                    </div>
                </li>
                <!-- más partidos -->
            </ul>
        </section>
    </main>
    <footer>
        <!-- pie de página -->
    </footer>
    <script src="script.js"></script>
</body>
</html>