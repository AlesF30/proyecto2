<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config\db_functions.php');

$cursos = selectall('cursos');
$grupos = selectall('grupo');
$dias = selectall('dias');

$selectedCourse = "";
$selectedDays = [];
$selectedGroups = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cursos"])) {
    $selectedCourse = $_POST["cursos"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["grupos_dias"])) {
    $selectedDays = $_POST["grupos_dias"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirmar"])) {
    if (!empty($selectedCourse) && !empty($selectedDays)) {
        $sql = "INSERT INTO grupos_dias (rela_grupo, rela_dias, rela_cursos, horario_inicio, horario_fin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);

        foreach ($selectedDays as $diaGrupo) {
            $grupo = $diaGrupo['grupo'];
            $dia = $diaGrupo['dias'];
            $horario_inicio = $_POST["inicio_{$grupo}_{$dia}"];
            $horario_fin = $_POST["fin_{$grupo}_{$dia}"];
            
            $stmt->bind_param("iiiss", $grupo, $dia, $selectedCourse, $horario_inicio, $horario_fin);
            $stmt->execute();
        }
        
        echo '<h2>Resumen de datos ingresados</h2>';
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Grupo</th>';
        echo '<th>Dia</th>';
        echo '<th>Horario de inicio</th>';
        echo '<th>Horario de fin</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        foreach ($selectedDays as $grupo => $dias) {
            foreach ($dias as $dia => $value) {
                echo '<tr>';
                echo '<td>' . $grupo . '</td>';
                echo '<td>' . $dia . '</td>';
                echo '<td>' . $_POST["inicio_{$grupo}_{$dia}"] . '</td>';
                echo '<td>' . $_POST["fin_{$grupo}_{$dia}"] . '</td>';
                echo '</tr>';
            }
        }
        
        echo '</tbody>';
        echo '</table>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de 3 pasos</title>
</head>
<body>
    <div class="container">
        <div class="step-navigation">
            <div class="step active" onclick="showStep(1)">Paso 1</div>
            <div class="step" onclick="showStep(2)">Paso 2</div>
            <div class="step" onclick="showStep(3)">Paso 3</div>
        </div>

        <form class="form-step active" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Paso 1: Seleccione un curso</h2>
            <select id="cursos" name="cursos">
                <option value="0"> - Seleccione un curso -</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?php echo $curso['id_cursos']; ?>">
                        <?php echo $curso['cursos_nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Siguiente">
        </form>

        <form class="form-step" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Paso 2: Asignar días a grupos</h2>
            <table border="1">
                <tr>
                    <th></th>
                    <?php foreach ($dias as $dia): ?>
                        <th><?php echo $dia['descripcion']; ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($grupos as $grupo): ?>
                    <tr>
                        <td><?php echo $grupo['descripcion']; ?></td>
                        <?php foreach ($dias as $dia): ?>
                            <td><input type="checkbox" name="grupo-dias[<?php echo $grupo['id_grupo']; ?>][<?php echo $dia['id_dias']; ?>]"></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" value="Siguiente">
        </form>

        <form class="form-step" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Paso 3: Confirmación</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Día</th>
                        <th>Horario de inicio</th>
                        <th>Horario de fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($selectedDays as $grupo => $dias): ?>
                        <?php foreach ($dias as $dia => $value): ?>
                            <tr>
                                <td><?php echo $grupo; ?></td>
                                <td><?php echo $dia; ?></td>
                                <td><input type="time" name="inicio_<?php echo $grupo; ?>_<?php echo $dia; ?>"></td>
                                <td><input type="time" name="fin_<?php echo $grupo; ?>_<?php echo $dia; ?>"></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="hidden" name="confirmar" value="1">
            <input type="submit" value="Confirmar y Guardar">
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
        }
    </script>
</body>
</html>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'includes\header.php');
include(ROOT_PATH . 'includes\nav.php');
include(ROOT_PATH . 'config\db_functions.php');

$selectedStep = isset($_GET['step']) ? $_GET['step'] : 1;

// Redirecciones entre pasos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($selectedStep == 1 && isset($_POST["cursos"])) {
        $selectedCourse = $_POST["cursos"];
        header("Location: {$_SERVER['PHP_SELF']}?step=2&curso={$selectedCourse}");
        exit();
    } elseif ($selectedStep == 2 && isset($_POST["grupo-dias"])) {
        $selectedDays = $_POST["grupo-dias"];
        header("Location: {$_SERVER['PHP_SELF']}?step=3");
        exit();
    } elseif ($selectedStep == 3 && isset($_POST["confirmar"])) {
        // ... (procesamiento y guardado en la base de datos)
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- ... (código del encabezado) ... -->
</head>
<body>
    <div class="container">
        <div class="step-navigation">
            <div class="step<?php echo $selectedStep == 1 ? ' active' : ''; ?>" onclick="showStep(1)">Paso 1</div>
            <div class="step<?php echo $selectedStep == 2 ? ' active' : ''; ?>" onclick="showStep(2)">Paso 2</div>
            <div class="step<?php echo $selectedStep == 3 ? ' active' : ''; ?>" onclick="showStep(3)">Paso 3</div>
        </div>

        <?php
        switch ($selectedStep) {
            case 1:
                ?>
                <form class="form-step active" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Contenido del Paso 1 -->
                </form>
                <?php
                break;

            case 2:
                ?>
                <form class="form-step active" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Contenido del Paso 2 -->
                </form>
                <?php
                break;

            case 3:
                ?>
                <form class="form-step active" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Contenido del Paso 3 -->
                </form>
                <?php
                break;
        }
        ?>
    </div>

    <script>
        function showStep(stepNumber) {
            const steps = document.querySelectorAll('.step');
            const formSteps = document.querySelectorAll('.form-step');

            steps.forEach(step => step.classList.remove('active'));
            formSteps.forEach(formStep => formStep.classList.remove('active'));

            steps[stepNumber - 1].classList.add('active');
            formSteps[stepNumber - 1].classList.add('active');
        }
    </script>
</body>
</html>
