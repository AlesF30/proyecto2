<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH .'includes/header.php');
include(ROOT_PATH .'includes/nav.php');
include(ROOT_PATH .'config/database/functions/cursos.php');
include(ROOT_PATH .'config/db_functions.php');

$cursos = selectall('cursos');
$grupos = selectall('grupo');
$dias = selectall('dias');

$error = isset($_GET['error']) ? $_GET['error'] : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de 3 Pasos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b2b2b;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .boton-volver {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background-color: gold;
            color: #1c1c1c;
            text-decoration: none;
            border-radius: 5px;
        }

        .step-navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            padding: 10px 20px;
            background-color: #f1f1f1;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .step.active {
            background-color: #1c1c1c;
            color: white;
            font-weight: bold;
            border: 1.5px solid #fbfbfb;
        }

        .form-step {
            display: none;
            background-color: #fafafa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-step.active {
            display: block;
        }

        .error {
            color: red;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            margin-bottom: 20px;
        }

        select, input[type="time"], input[type="submit"], input[type="button"] {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="button"] {
            width: auto;
            background-color:#333;
            color: #fafafa;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #6a737b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #1c1c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="cursos/listadoCursos.php" class="boton-volver">Volver</a>

        <div class="step-navigation">
            <div class="step active" onclick="showStep(1)">Paso 1</div>
            <div class="step" onclick="showStep(2)">Paso 2</div>
            <div class="step" onclick="showStep(3)">Paso 3</div>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if ($error == 'missing_data'): ?>
            <p class="error">Por favor, complete todos los campos requeridos.</p>
        <?php endif; ?>

        <?php if ($success == '1'): ?>
            <p class="success">Los datos se guardaron exitosamente.</p>
        <?php endif; ?>

        <form id="formulario" action="procesarGruposDias.php" method="POST" onsubmit="return validateStep3();">

            <!-- Paso 1 -->
            <div class="form-step active" id="step1">
                <h2>Paso 1: Seleccione un curso</h2>
                <select id="cursos" name="cursos" required>
                    <option value="0"> - Seleccione un curso -</option>
                    <?php foreach ($cursos as $curso): ?>
                        <option value="<?php echo $curso['id_cursos']; ?>">
                            <?php echo $curso['cursos_nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="button" value="Siguiente" onclick="showStep(2)">
            </div>

            <!-- Paso 2 -->
            <div class="form-step" id="step2">
                <h2>Paso 2: Asignar días a grupos</h2>
                <table>
                    <tr>
                        <th>Grupo/Día</th>
                        <?php foreach ($dias as $dia): ?>
                            <th><?php echo $dia['descripcion']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php foreach ($grupos as $grupo): ?>
                        <tr>
                            <td><?php echo $grupo['descripcion']; ?></td>
                            <?php foreach ($dias as $dia): ?>
                                <td>
                                    <input type="checkbox" name="grupo_dias[<?php echo $grupo['id_grupo']; ?>][<?php echo $dia['id_dias']; ?>]" value="1">
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <input type="button" value="Anterior" onclick="showStep(1)">
                <input type="button" value="Siguiente" onclick="showStep(3)">
            </div>

            <!-- Paso 3 -->
            <div class="form-step" id="step3">
                <h2>Paso 3: Confirmación y Horarios</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Día</th>
                            <th>Horario de inicio</th>
                            <th>Horario de fin</th>
                        </tr>
                    </thead>
                    <tbody id="horariosSeleccionados">
                        <!-- Aquí se agregarán las filas dinámicamente mediante JavaScript -->
                    </tbody>
                </table>
                <input type="hidden" name="confirmar" value="1">
                <input type="button" value="Anterior" onclick="showStep(2)">
                <input type="submit" value="Confirmar y Guardar">
            </div>
        </form>
    </div>

    <script>
        function showStep(stepNumber) {
            const steps = document.querySelectorAll('.step');
            const formSteps = document.querySelectorAll('.form-step');

            steps.forEach(step => step.classList.remove('active'));
            formSteps.forEach(formStep => formStep.classList.remove('active'));

            steps[stepNumber - 1].classList.add('active');
            formSteps[stepNumber - 1].classList.add('active');

            if (stepNumber === 3) {
                mostrarHorariosSeleccionados();
            }
        }

        function mostrarHorariosSeleccionados() {
            const selectedGroupsDays = document.querySelectorAll('input[type="checkbox"]:checked');
            const horariosSeleccionados = document.getElementById('horariosSeleccionados');
            horariosSeleccionados.innerHTML = '';

            selectedGroupsDays.forEach(checkbox => {
                const [groupId, dayId] = checkbox.name.match(/\d+/g);
                const groupDescription = checkbox.closest('tr').querySelector('td').innerText;
                const dayDescription = checkbox.closest('table').querySelector(`th:nth-child(${parseInt(dayId) + 1})`).innerText;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${groupDescription}</td>
                    <td>${dayDescription}</td>
                    <td><input type="time" name="inicio_${groupId}_${dayId}" required></td>
                    <td><input type="time" name="fin_${groupId}_${dayId}" required></td>
                `;
                horariosSeleccionados.appendChild(row);
            });
        }

        function validateStep3() {
            const horariosSeleccionados = document.getElementById('horariosSeleccionados').children;
            if (horariosSeleccionados.length === 0) {
                alert('Debe seleccionar al menos un grupo y día en el paso 2.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
