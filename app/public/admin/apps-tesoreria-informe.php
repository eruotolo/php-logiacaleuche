<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'layouts/session.php';
include 'layouts/head-main.php';
include ('layouts/config.php');

$titulo = "Generar Informe de Tesorería";

// Función para determinar la cuota mensual según el usuario
function getCuotaMensual($username) {
    $bajocosto = array(50020428, 79153427, 37509698, 85088971, 37558249, 45127850, 82731156, 133582142);
    $mediocosto = array(55348030);

    if (in_array($username, $bajocosto)) {
        return 15000;
    } elseif (in_array($username, $mediocosto)) {
        return 30000;
    } else {
        return 45000;
    }
}

// Función para formatear meses con número adelante
function formatearMesConNumero($mes) {
    $meses_map = [
        'Enero' => '01 - Enero',
        'Febrero' => '02 - Febrero',
        'Marzo' => '03 - Marzo',
        'Abril' => '04 - Abril',
        'Mayo' => '05 - Mayo',
        'Junio' => '06 - Junio',
        'Julio' => '07 - Julio',
        'Agosto' => '08 - Agosto',
        'Septiembre' => '09 - Septiembre',
        'Octubre' => '10 - Octubre',
        'Noviembre' => '11 - Noviembre',
        'Diciembre' => '12 - Diciembre'
    ];
    return isset($meses_map[$mes]) ? $meses_map[$mes] : $mes;
}
?>

<head>
    <title><?php echo $titulo ?> | Logia Caleuche</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Generar Informe de Tesorería</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tesorería</a></li>
                                    <li class="breadcrumb-item active">Informe</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <?php
                $informe_html = '';
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $tipo_informe = $_POST['tipo_informe'] ?? 'anual';
                    $mes = $_POST['mes'] ?? date('m');
                    $ano = $_POST['ano'] ?? date('Y');
                    $fecha_desde = $_POST['fecha_desde'] ?? null;
                    $fecha_hasta = $_POST['fecha_hasta'] ?? date('Y-m-d');

                    // Si es informe personalizado, extraer el año de la fecha_hasta para el estado de cuotas
                    if ($tipo_informe == 'personalizado' && !empty($fecha_hasta)) {
                        $ano = date('Y', strtotime($fecha_hasta));
                    }

                    $titulo_informe = '';
                    $periodo = '';
                    $where_ingresos = '';
                    $where_egresos = '';

                    switch ($tipo_informe) {
                        case 'mensual':
                            $titulo_informe = 'INFORME MENSUAL DE TESORERÍA';
                            $meses = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];
                            $periodo = $meses[$mes] . ' ' . $ano;
                            $where_ingresos = "WHERE MONTH(entrada_MovimientoFecha) = '$mes' AND YEAR(entrada_MovimientoFecha) = '$ano'";
                            $where_egresos = "WHERE MONTH(salida_MovimientoFecha) = '$mes' AND YEAR(salida_MovimientoFecha) = '$ano'";
                            break;
                        case 'anual':
                            $titulo_informe = 'INFORME ANUAL DE TESORERÍA';
                            $periodo = 'Año ' . $ano;
                            $where_ingresos = "WHERE YEAR(entrada_MovimientoFecha) = '$ano'";
                            $where_egresos = "WHERE YEAR(salida_MovimientoFecha) = '$ano'";
                            break;
                        case 'personalizado':
                            $titulo_informe = 'INFORME DE TESORERÍA';
                            $periodo = date('d/m/Y', strtotime($fecha_desde)) . ' - ' . date('d/m/Y', strtotime($fecha_hasta));
                            $where_ingresos = "WHERE DATE(entrada_MovimientoFecha) BETWEEN '$fecha_desde' AND '$fecha_hasta'";
                            $where_egresos = "WHERE DATE(salida_MovimientoFecha) BETWEEN '$fecha_desde' AND '$fecha_hasta'";
                            break;
                    }

                    // Total Ingresos - Excluir cuotas del usuario 270396356
                    $exclusion_270396356 = "NOT (id_User = (SELECT id FROM users WHERE username = '270396356') AND entrada_Motivo = 1)";
                    if (!empty($where_ingresos)) {
                        $query_total_ingresos = "SELECT COALESCE(SUM(entrada_Monto), 0) AS total FROM entradadinero $where_ingresos AND $exclusion_270396356";
                    } else {
                        $query_total_ingresos = "SELECT COALESCE(SUM(entrada_Monto), 0) AS total FROM entradadinero WHERE $exclusion_270396356";
                    }
                    $result_total_ingresos = mysqli_query($link, $query_total_ingresos);
                    $row_total_ingresos = mysqli_fetch_assoc($result_total_ingresos);
                    $total_ingresos = $row_total_ingresos['total'];

                    $query_total_egresos = "SELECT COALESCE(SUM(salida_Monto), 0) AS total FROM salidadinero $where_egresos";
                    $result_total_egresos = mysqli_query($link, $query_total_egresos);
                    $row_total_egresos = mysqli_fetch_assoc($result_total_egresos);
                    $total_egresos = $row_total_egresos['total'];

                    // Total en Caja (Ingresos - Egresos)
                    $saldo = $total_ingresos - $total_egresos;

                    $caja_where_conditions = "entrada_Motivo = 6";
                    if (!empty($where_ingresos)) {
                        $date_conditions = substr($where_ingresos, 6); // Remove "WHERE "
                        $caja_where_conditions .= " AND ($date_conditions)";
                    }
                    $query_caja = "SELECT COALESCE(SUM(entrada_Monto), 0) AS Total FROM entradadinero WHERE $caja_where_conditions";
                    $result_caja = mysqli_query($link, $query_caja);
                    $row_caja = mysqli_fetch_assoc($result_caja);
                    $caja_hospitalario = $row_caja['Total'];

                    // ================================================================
                    // TOTALES HISTÓRICOS (SIN FILTROS DE FECHA) - Para RESUMEN EJECUTIVO
                    // Idénticos a los de apps-tesoreria-entrada.php
                    // ================================================================

                    // Total Ingresos Histórico - Excluir cuotas del usuario 270396356
                    $query_total_ingresos_historico = "SELECT SUM(entrada_Monto) AS total_entrada
                                                        FROM entradadinero
                                                        WHERE NOT (id_User = (SELECT id FROM users WHERE username = '270396356')
                                                                   AND entrada_Motivo = 1)";
                    $result_ingresos_historico = mysqli_query($link, $query_total_ingresos_historico);
                    $row_ingresos_historico = mysqli_fetch_assoc($result_ingresos_historico);
                    $total_ingresos_historico = $row_ingresos_historico['total_entrada'];

                    // Total Egresos Histórico
                    $query_total_egresos_historico = "SELECT SUM(salida_Monto) AS total_salida
                                                       FROM salidadinero";
                    $result_egresos_historico = mysqli_query($link, $query_total_egresos_historico);
                    $row_egresos_historico = mysqli_fetch_assoc($result_egresos_historico);
                    $total_egresos_historico = $row_egresos_historico['total_salida'];

                    // Total en Caja Histórico (Ingresos - Egresos)
                    $saldo_historico = $total_ingresos_historico - $total_egresos_historico;

                    // Caja Hospitalario Histórico
                    $query_caja_historico = "SELECT SUM(entrada_Monto) AS Total
                                             FROM entradadinero
                                             WHERE entrada_Motivo = 6";
                    $result_caja_historico = mysqli_query($link, $query_caja_historico);
                    $row_caja_historico = mysqli_fetch_assoc($result_caja_historico);
                    $caja_hospitalario_historico = $row_caja_historico['Total'];

                    // ================================================================

                    $movimientos_por_mes = [];
                    if ($tipo_informe == 'anual') {
                        $meses_nombres = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];
                        for ($m = 1; $m <= 12; $m++) {
                            $mes_num = str_pad($m, 2, '0', STR_PAD_LEFT);
                            $query_ingresos_mes = "SELECT COALESCE(SUM(entrada_Monto), 0) AS total FROM entradadinero WHERE MONTH(entrada_MovimientoFecha) = '$mes_num' AND YEAR(entrada_MovimientoFecha) = '$ano'";
                            $result_ingresos_mes = mysqli_query($link, $query_ingresos_mes);
                            $row_ingresos_mes = mysqli_fetch_assoc($result_ingresos_mes);
                            $ingresos_mes = $row_ingresos_mes['total'];

                            $query_egresos_mes = "SELECT COALESCE(SUM(salida_Monto), 0) AS total FROM salidadinero WHERE MONTH(salida_MovimientoFecha) = '$mes_num' AND YEAR(salida_MovimientoFecha) = '$ano'";
                            $result_egresos_mes = mysqli_query($link, $query_egresos_mes);
                            $row_egresos_mes = mysqli_fetch_assoc($result_egresos_mes);
                            $egresos_mes = $row_egresos_mes['total'];

                            if ($ingresos_mes > 0 || $egresos_mes > 0) {
                                $movimientos_por_mes[] = ['index' => count($movimientos_por_mes), 'mes' => $meses_nombres[$mes_num], 'ingresos' => $ingresos_mes, 'egresos' => $egresos_mes, 'saldo' => $ingresos_mes - $egresos_mes];
                            }
                        }
                    }

                    $query_top_ingresos = "SELECT name_Motivo as nombre, COALESCE(SUM(entrada_Monto), 0) as total FROM entradadinero JOIN entradamotivo ON entrada_Motivo = id_Motivo $where_ingresos GROUP BY name_Motivo ORDER BY total DESC LIMIT 5";
                    $result_top_ingresos = mysqli_query($link, $query_top_ingresos);
                    $top_ingresos = [];
                    while ($row = mysqli_fetch_assoc($result_top_ingresos)) { $top_ingresos[] = $row; }

                    $query_top_egresos = "SELECT name_SalidaMotivo as nombre, COALESCE(SUM(salida_Monto), 0) as total FROM salidadinero JOIN salidamotivo ON salida_Motivo = id_SalidaMotivo $where_egresos GROUP BY name_SalidaMotivo ORDER BY total DESC LIMIT 5";
                    $result_top_egresos = mysqli_query($link, $query_top_egresos);
                    $top_egresos = [];
                    while ($row = mysqli_fetch_assoc($result_top_egresos)) { $top_egresos[] = $row; }

                    // Consulta para estado de cuotas del año seleccionado
                    $ano_reporte = $ano; // Usar el año del formulario
                    $meses_del_ano = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                    $query_deudas = "SELECT
                        u.id,
                        u.username,
                        u.name,
                        u.lastname,
                        u.created_at,
                        GROUP_CONCAT(DISTINCT e.entrada_Mes ORDER BY FIELD(e.entrada_Mes, '01 - Enero', '02 - Febrero', '03 - Marzo', '04 - Abril', '05 - Mayo', '06 - Junio', '07 - Julio', '08 - Agosto', '09 - Septiembre', '10 - Octubre', '11 - Noviembre', '12 - Diciembre') SEPARATOR ',') as meses_pagados_texto,
                        COUNT(DISTINCT e.entrada_Mes) as cantidad_meses_pagados
                    FROM users u
                    LEFT JOIN entradadinero e ON u.id = e.id_User
                        AND e.entrada_Motivo = 1
                        AND e.entrada_Ano = '$ano_reporte'
                    WHERE u.estado = 1
                    GROUP BY u.id, u.username, u.name, u.lastname, u.created_at
                    ORDER BY u.name, u.lastname";

                    $result_deudas = mysqli_query($link, $query_deudas);
                    $deudas_data = [];

                    // DEBUG: Verificar si la consulta funcionó
                    if (!$result_deudas) {
                        echo "<!-- DEBUG ERROR: " . mysqli_error($link) . " -->";
                    }

                    while ($row = mysqli_fetch_assoc($result_deudas)) {
                        $username = intval($row['username']);
                        $cuota_mensual = getCuotaMensual($username);

                        // DEBUG: Mostrar meses pagados de cada usuario
                        // echo "<!-- DEBUG: Usuario " . $row['name'] . ": meses_pagados_texto = '" . ($row['meses_pagados_texto'] ?? 'NULL') . "' -->";

                        // Array de todos los meses del año (referencia)
                        $todos_los_meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                        // Determinar desde qué mes debe pagar este usuario
                        $meses_a_cobrar = $todos_los_meses; // Por defecto, todo el año

                        // LÓGICA: Usar created_at para determinar desde cuándo cobrar
                        // Si el usuario se registró en el año actual, cobrar desde el MES SIGUIENTE
                        if (!empty($row['created_at'])) {
                            $fecha_creacion = strtotime($row['created_at']);
                            $ano_creacion = date('Y', $fecha_creacion);

                            // Si se registró en el año actual, cobrar desde el MES SIGUIENTE
                            if ($ano_creacion == $ano_reporte) {
                                $mes_creacion = (int)date('n', $fecha_creacion); // 1-12
                                $mes_inicio = $mes_creacion + 1; // Mes siguiente al registro

                                // Si se registró en diciembre, no cobrar nada este año
                                if ($mes_inicio <= 12) {
                                    $meses_a_cobrar = array_slice($todos_los_meses, $mes_inicio - 1);
                                } else {
                                    $meses_a_cobrar = []; // Registrado en diciembre, no debe nada en este año
                                }
                            }
                            // Si se registró en años anteriores, cobrar todo el año (ya definido por defecto)
                        }

                        // Procesar meses pagados desde la base de datos
                        $meses_pagados = [];
                        if (!empty($row['meses_pagados_texto'])) {
                            $temp = explode(',', $row['meses_pagados_texto']);
                            foreach ($temp as $mes) {
                                $mes_limpio = trim($mes);

                                // Extraer solo el nombre del mes (después de " - ")
                                // Formato en BD: "08 - Agosto" → Extraer "Agosto"
                                if (strpos($mes_limpio, ' - ') !== false) {
                                    $partes = explode(' - ', $mes_limpio);
                                    $nombre_mes = trim($partes[1]); // La segunda parte es el nombre
                                } else {
                                    $nombre_mes = $mes_limpio; // Por si acaso viene sin formato
                                }

                                if (!empty($nombre_mes) && in_array($nombre_mes, $todos_los_meses)) {
                                    $meses_pagados[] = $nombre_mes;
                                }
                            }
                        }

                        // Calcular meses pendientes (solo de los meses que DEBE pagar)
                        $meses_pendientes = [];
                        foreach ($meses_a_cobrar as $mes) {
                            if (!in_array($mes, $meses_pagados)) {
                                $meses_pendientes[] = $mes;
                            }
                        }

                        // Ordenar meses pagados cronológicamente
                        if (!empty($meses_pagados)) {
                            $orden_meses = ['Enero' => 1, 'Febrero' => 2, 'Marzo' => 3, 'Abril' => 4,
                                            'Mayo' => 5, 'Junio' => 6, 'Julio' => 7, 'Agosto' => 8,
                                            'Septiembre' => 9, 'Octubre' => 10, 'Noviembre' => 11, 'Diciembre' => 12];

                            usort($meses_pagados, function($a, $b) use ($orden_meses) {
                                return $orden_meses[$a] - $orden_meses[$b];
                            });
                        }

                        // Calcular deuda total
                        $cantidad_meses_pendientes = count($meses_pendientes);
                        $deuda_total = $cantidad_meses_pendientes * $cuota_mensual;

                        // Formatear meses con número
                        $meses_pagados_formateados = array_map('formatearMesConNumero', $meses_pagados);
                        $meses_pendientes_formateados = array_map('formatearMesConNumero', $meses_pendientes);

                        // Preparar textos para mostrar
                        $meses_pagados_texto = !empty($meses_pagados_formateados) ? implode(', ', $meses_pagados_formateados) : 'Ninguno';
                        $meses_pendientes_texto = !empty($meses_pendientes_formateados) ? implode(', ', $meses_pendientes_formateados) : '✅ Todos pagados';
                        $deuda_total_texto = $deuda_total > 0 ? '$' . number_format($deuda_total, 0, ',', '.') : '✅ No presenta deuda para el año ' . $ano_reporte;

                        $deudas_data[] = [
                            'nombre' => $row['name'] . ' ' . $row['lastname'],
                            'username' => $row['username'],
                            'cuota_mensual' => $cuota_mensual,
                            'meses_pagados_texto' => $meses_pagados_texto,
                            'meses_pendientes_texto' => $meses_pendientes_texto,
                            'deuda_total' => $deuda_total,
                            'deuda_total_texto' => $deuda_total_texto,
                            'cantidad_meses_pagados' => $row['cantidad_meses_pagados'],
                            'cantidad_meses_pendientes' => $cantidad_meses_pendientes
                        ];
                    }

                    ob_start();
                    ?>
                    <div class="row" id="informe-tesoreria-contenedor">
                        <div class="col-12">
                            <div class="card">
                                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem;">
                                    <h1 style="color: #ffffff; margin: 0; font-size: 28px;"><?php echo $titulo_informe; ?></h1>
                                    <p style="color: #f0f0f0; margin: 10px 0 0 0; font-size: 16px;">Respetable Logia Caleuche 250</p>
                                    <p style="color: #ffffff; margin: 15px 0 0 0; font-size: 18px; font-weight: bold;"><?php echo $periodo; ?></p>
                                </div>
                                <div class="card-body">
                                    <div class="p-3" style="background-color: #f8f9fa;">
                                        <h2 style="color: #333; font-size: 22px; margin: 0 0 20px 0; border-bottom: 3px solid #667eea; padding-bottom: 10px;">📊 RESUMEN EJECUTIVO</h2>
                                        <div class="row">
                                            <!-- Total Ingreso -->
                                            <div class="col-lg-6 col-md-6 mb-3">
                                                <div style="padding: 20px; background-color: #d4edda; border-radius: 8px; border-left: 5px solid #28a745; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <div style="font-size: 14px; color: #155724; margin-bottom: 8px; font-weight: 600;">💰 Total Ingreso (Período)</div>
                                                    <div style="font-size: 32px; font-weight: bold; color: #28a745;">$<?php echo number_format($total_ingresos, 0, ',', '.'); ?></div>
                                                </div>
                                            </div>
                                            <!-- Total Egreso -->
                                            <div class="col-lg-6 col-md-6 mb-3">
                                                <div style="padding: 20px; background-color: #f8d7da; border-radius: 8px; border-left: 5px solid #dc3545; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <div style="font-size: 14px; color: #721c24; margin-bottom: 8px; font-weight: 600;">💸 Total Egreso (Período)</div>
                                                    <div style="font-size: 32px; font-weight: bold; color: #dc3545;">$<?php echo number_format($total_egresos, 0, ',', '.'); ?></div>
                                                </div>
                                            </div>
                                            <!-- Total en Caja -->
                                            <div class="col-lg-6 col-md-6 mb-3">
                                                <div style="padding: 20px; background-color: #cce5ff; border-radius: 8px; border-left: 5px solid #0056b3; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <div style="font-size: 14px; color: #004085; margin-bottom: 8px; font-weight: 600;">📈 Total en Caja</div>
                                                    <div style="font-size: 32px; font-weight: bold; color: #0056b3;">$<?php echo number_format($saldo_historico, 0, ',', '.'); ?></div>
                                                </div>
                                            </div>
                                            <!-- Caja Hospitalario -->
                                            <div class="col-lg-6 col-md-6 mb-3">
                                                <div style="padding: 20px; background-color: #d1ecf1; border-radius: 8px; border-left: 5px solid #17a2b8; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                    <div style="font-size: 14px; color: #0c5460; margin-bottom: 8px; font-weight: 600;">🏥 Caja Hospitalario</div>
                                                    <div style="font-size: 32px; font-weight: bold; color: #17a2b8;">$<?php echo number_format($caja_hospitalario_historico, 0, ',', '.'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (!empty($movimientos_por_mes)): ?>
                                    <div class="p-3 mt-4">
                                        <h2 style="color: #333; font-size: 22px; margin: 0 0 20px 0; border-bottom: 3px solid #667eea; padding-bottom: 10px;">📅 MOVIMIENTOS POR MES AÑO <?php echo $ano_reporte; ?></h2>
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead class="table-light" style="background-color: #667eea; color: black;"><tr><th>Mes</th><th class="text-end">Ingresos</th><th class="text-end">Egresos</th><th class="text-end">Saldo</th></tr></thead>
                                            <tbody>
                                            <?php foreach ($movimientos_por_mes as $mes_data): ?>
                                                <tr><td><?php echo $mes_data['mes']; ?></td><td class="text-end" style="color: #28a745;">$<?php echo number_format($mes_data['ingresos'], 0, ',', '.'); ?></td><td class="text-end" style="color: #dc3545;">$<?php echo number_format($mes_data['egresos'], 0, ',', '.'); ?></td><td class="text-end fw-bold">$<?php echo number_format($mes_data['saldo'], 0, ',', '.'); ?></td></tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="p-3 mt-4" style="background-color: #f8f9fa;">
                                        <h2 style="color: #333; font-size: 22px; margin: 0 0 20px 0; border-bottom: 3px solid #667eea; padding-bottom: 10px;">🏆 PRINCIPALES CONCEPTOS AÑO <?php echo $ano_reporte; ?></h2>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h3 style="color: #28a745; font-size: 18px; margin: 0 0 15px 0;">Ingresos</h3>
                                                <?php if (!empty($top_ingresos)): foreach ($top_ingresos as $ingreso): $porcentaje = $total_ingresos > 0 ? round(($ingreso['total'] / $total_ingresos) * 100, 1) : 0; ?>
                                                    <div class="mb-3"><div class="fw-bold text-dark"><?php echo $ingreso['nombre']; ?></div><div class="progress mt-1" style="height: 8px;"><div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $porcentaje; ?>%;" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div></div><div class="d-flex justify-content-between mt-1"><span class="text-success fw-bold">$<?php echo number_format($ingreso['total'], 0, ',', '.'); ?></span><span class="text-muted"><?php echo $porcentaje; ?>%</span></div></div>
                                                <?php endforeach; else: ?><p class="text-muted">No hay datos de ingresos disponibles.</p><?php endif; ?>
                                                <hr>
                                                <div class="d-flex justify-content-between mt-2">
                                                    <span class="fw-bold fs-5">Total Ingresos:</span>
                                                    <span class="fw-bold fs-5 text-success">$<?php echo number_format($total_ingresos, 0, ',', '.'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3 style="color: #dc3545; font-size: 18px; margin: 0 0 15px 0;">Egresos</h3>
                                                <?php if (!empty($top_egresos)): foreach ($top_egresos as $egreso): $porcentaje = $total_egresos > 0 ? round(($egreso['total'] / $total_egresos) * 100, 1) : 0; ?>
                                                    <div class="mb-3"><div class="fw-bold text-dark"><?php echo $egreso['nombre']; ?></div><div class="progress mt-1" style="height: 8px;"><div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $porcentaje; ?>%;" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div></div><div class="d-flex justify-content-between mt-1"><span class="text-danger fw-bold">$<?php echo number_format($egreso['total'], 0, ',', '.'); ?></span><span class="text-muted"><?php echo $porcentaje; ?>%</span></div></div>
                                                <?php endforeach; else: ?><p class="text-muted">No hay datos de egresos disponibles.</p><?php endif; ?>
                                                <hr>
                                                <div class="d-flex justify-content-between mt-2">
                                                    <span class="fw-bold fs-5">Total Egresos:</span>
                                                    <span class="fw-bold fs-5 text-danger">$<?php echo number_format($total_egresos, 0, ',', '.'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sección de Estado de Cuotas -->
                                    <div class="p-3 mt-4" style="background-color: #fff3cd; border-radius: 5px;">
                                        <!-- DEBUG: Año seleccionado = <?php echo $ano_reporte; ?>, Tipo informe = <?php echo $tipo_informe; ?> -->
                                        <h2 style="color: #333; font-size: 22px; margin: 0 0 20px 0; border-bottom: 3px solid #ffc107; padding-bottom: 10px;">💳 ESTADO DE CUOTAS <?php echo $ano_reporte; ?></h2>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead style="background-color: #ffc107; color: #000;">
                                                    <tr>
                                                        <th>Hermano</th>
                                                        <th class="text-center">Cuota Mensual</th>
                                                        <th>Meses Pagados (<?php echo $ano_reporte; ?>)</th>
                                                        <th>Meses Pendientes</th>
                                                        <th class="text-end">Total Deuda <?php echo $ano_reporte; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($deudas_data)): ?>
                                                    <?php foreach ($deudas_data as $deuda): ?>
                                                        <tr style="<?php echo $deuda['deuda_total'] > 0 ? 'background-color: #ffe6e6;' : 'background-color: #e6ffe6;'; ?>">
                                                            <td class="fw-bold"><?php echo $deuda['nombre']; ?></td>
                                                            <td class="text-center">$<?php echo number_format($deuda['cuota_mensual'], 0, ',', '.'); ?></td>
                                                            <td>
                                                                <small><?php echo $deuda['meses_pagados_texto']; ?></small>
                                                                <br>
                                                                <span class="badge bg-info"><?php echo $deuda['cantidad_meses_pagados']; ?> de 12 meses</span>
                                                            </td>
                                                            <td>
                                                                <small><?php echo $deuda['meses_pendientes_texto']; ?></small>
                                                                <?php if ($deuda['cantidad_meses_pendientes'] > 0): ?>
                                                                    <br>
                                                                    <span class="badge bg-warning text-dark"><?php echo $deuda['cantidad_meses_pendientes']; ?> meses pendientes</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-end fw-bold" style="<?php echo $deuda['deuda_total'] > 0 ? 'color: #dc3545;' : 'color: #28a745;'; ?>">
                                                                <?php echo $deuda['deuda_total_texto']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">No hay usuarios activos registrados</td>
                                                    </tr>
                                                <?php endif; ?>
                                                </tbody>
                                                <?php if (!empty($deudas_data)): ?>
                                                <tfoot style="background-color: #f8f9fa;">
                                                    <tr>
                                                        <td colspan="4" class="text-end fw-bold">Total General de Deudas:</td>
                                                        <td class="text-end fw-bold" style="color: #dc3545; font-size: 18px;">
                                                            $<?php
                                                                $total_general_deudas = array_sum(array_column($deudas_data, 'deuda_total'));
                                                                echo number_format($total_general_deudas, 0, ',', '.');
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                        <div class="mt-3 p-2" style="background-color: #f8f9fa; border-radius: 5px;">
                                            <p class="mb-1"><strong>Nota:</strong> Este reporte muestra el estado de cuotas de todos los miembros activos para el año <?php echo $ano_reporte; ?>.</p>
                                            <p class="mb-0"><small class="text-muted">
                                                • Las filas en <span style="color: #28a745;">●</span> verde indican que el hermano está al día con sus cuotas.<br>
                                                • Las filas en <span style="color: #dc3545;">●</span> rojo indican que el hermano tiene cuotas pendientes.
                                            </small></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $informe_html = ob_get_clean();
                }
                ?>

                <!-- Formulario de Generación -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Generar Informe</h4>
                                <p class="card-title-desc">Selecciona el tipo de informe y período a generar</p>
                            </div>
                            <div class="card-body p-4">
                                <form action="" method="post">
                                    <div class="row mb-4"><label for="tipo_informe" class="col-sm-3 col-form-label">Tipo de Informe</label><div class="col-sm-6"><select name="tipo_informe" id="tipo_informe" class="form-select" required><option value="mensual">Informe Mensual</option><option value="anual" selected>Informe Anual</option><option value="personalizado">Período Personalizado</option></select></div></div>
                                    <div class="row mb-4" id="div_mes"><label for="mes" class="col-sm-3 col-form-label">Mes</label><div class="col-sm-6"><select name="mes" id="mes" class="form-select"><option value="01">Enero</option><option value="02">Febrero</option><option value="03">Marzo</option><option value="04">Abril</option><option value="05">Mayo</option><option value="06">Junio</option><option value="07">Julio</option><option value="08">Agosto</option><option value="09">Septiembre</option><option value="10" <?php echo (date('m') == '10') ? 'selected' : ''; ?>>Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option></select></div></div>
                                    <div class="row mb-4" id="div_ano"><label for="ano" class="col-sm-3 col-form-label">Año</label><div class="col-sm-6"><input type="number" class="form-control" name="ano" id="ano" value="<?php echo date('Y'); ?>" min="2020" max="2099" required></div></div>
                                    <div id="div_personalizado" style="display:none;"><div class="row mb-4"><label for="fecha_desde" class="col-sm-3 col-form-label">Fecha Desde</label><div class="col-sm-6"><input type="date" class="form-control" name="fecha_desde" id="fecha_desde"></div></div><div class="row mb-4"><label for="fecha_hasta" class="col-sm-3 col-form-label">Fecha Hasta</label><div class="col-sm-6"><input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" value="<?php echo date('Y-m-d'); ?>"></div></div></div>
                                    <div class="row justify-content-end"><div class="col-sm-9"><button type="submit" name="action" value="generar" class="btn btn-primary"><i class="mdi mdi-chart-bar me-1"></i> Generar Informe</button></div></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor para el informe generado -->
                <?php if (!empty($informe_html)): ?>
                    <!-- Botones de descarga -->
                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <button id="btn-descargar-pdf" class="btn btn-danger me-2">
                                <i class="mdi mdi-file-pdf me-1"></i> Descargar como PDF
                            </button>
                            <button id="btn-descargar-informe" class="btn btn-success">
                                <i class="mdi mdi-image me-1"></i> Descargar como Imagen
                            </button>
                        </div>
                    </div>
                    <?php echo $informe_html; ?>
                <?php endif; ?>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- html2canvas para captura de pantalla -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- jsPDF para generación de PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="assets/js/app.js"></script>

<script>
    document.getElementById('tipo_informe').addEventListener('change', function() {
        const tipo = this.value;
        const divMes = document.getElementById('div_mes');
        const divAno = document.getElementById('div_ano');
        const divPersonalizado = document.getElementById('div_personalizado');

        if (tipo === 'mensual') {
            divMes.style.display = 'flex';
            divAno.style.display = 'flex';
            divPersonalizado.style.display = 'none';
            document.getElementById('mes').required = true;
            document.getElementById('fecha_desde').required = false;
            document.getElementById('fecha_hasta').required = false;
        } else if (tipo === 'anual') {
            divMes.style.display = 'none';
            divAno.style.display = 'flex';
            divPersonalizado.style.display = 'none';
            document.getElementById('mes').required = false;
            document.getElementById('fecha_desde').required = false;
            document.getElementById('fecha_hasta').required = false;
        } else { // personalizado
            divMes.style.display = 'none';
            divAno.style.display = 'none';
            divPersonalizado.style.display = 'block';
            document.getElementById('mes').required = false;
            document.getElementById('fecha_desde').required = true;
            document.getElementById('fecha_hasta').required = true;
        }
    });
    // Trigger on load to set initial state
    document.getElementById('tipo_informe').dispatchEvent(new Event('change'));
</script>

<!-- Script para descargar informe como imagen -->
<script>
    // Verificar si el botón existe antes de agregar el evento
    const btnDescargar = document.getElementById('btn-descargar-informe');
    if (btnDescargar) {
        btnDescargar.addEventListener('click', function() {
            // Mostrar indicador de carga
            const textoOriginal = this.innerHTML;
            this.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i> Generando imagen...';
            this.disabled = true;

            // Capturar el contenedor del informe
            html2canvas(document.getElementById('informe-tesoreria-contenedor'), {
                scale: 2, // Alta calidad (2x resolución)
                useCORS: true, // Permitir cargar imágenes de otros dominios
                allowTaint: true, // Permitir elementos "contaminados"
                backgroundColor: '#ffffff', // Fondo blanco
                logging: false, // Desactivar logs en consola
                windowWidth: document.getElementById('informe-tesoreria-contenedor').scrollWidth,
                windowHeight: document.getElementById('informe-tesoreria-contenedor').scrollHeight
            }).then(canvas => {
                // Crear enlace de descarga
                const link = document.createElement('a');
                const fechaHora = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
                link.download = 'informe-tesoreria-' + fechaHora + '.png';
                link.href = canvas.toDataURL('image/png', 1.0); // Máxima calidad PNG
                link.click();

                // Restaurar botón
                btnDescargar.innerHTML = textoOriginal;
                btnDescargar.disabled = false;
            }).catch(error => {
                console.error('Error al generar la imagen:', error);
                alert('Error al generar la imagen. Por favor, intente nuevamente.');

                // Restaurar botón
                btnDescargar.innerHTML = textoOriginal;
                btnDescargar.disabled = false;
            });
        });

    }

    // Verificar si el botón PDF existe antes de agregar el evento
    const btnDescargarPDF = document.getElementById('btn-descargar-pdf');
    if (btnDescargarPDF) {
        btnDescargarPDF.addEventListener('click', function() {
            // Mostrar indicador de carga
            const textoOriginal = this.innerHTML;
            this.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i> Generando PDF...';
            this.disabled = true;

            // Importar jsPDF
            const { jsPDF } = window.jspdf;

            // Capturar el contenedor del informe
            html2canvas(document.getElementById('informe-tesoreria-contenedor'), {
                scale: 2, // Alta calidad
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                
                // Dimensiones del PDF (A4)
                const pdfWidth = 210; // mm
                const pdfHeight = 297; // mm
                
                // Calcular dimensiones de la imagen en el PDF
                const imgProps = canvas.width / canvas.height;
                const pdfImgWidth = pdfWidth;
                const pdfImgHeight = pdfImgWidth / imgProps;
                
                // Crear PDF
                const pdf = new jsPDF('p', 'mm', 'a4');
                
                // Si la imagen es más alta que una página A4, necesitamos manejar múltiples páginas
                // Pero para simplificar en este caso y mantener el diseño como "imagen", 
                // ajustaremos la altura si es necesario o permitiremos que se corte si es muy largo,
                // o mejor: creamos un PDF con altura personalizada si es muy largo.
                
                // Opción: Altura dinámica si es muy largo, o A4 estándar escalado
                // Vamos a usar altura dinámica si el contenido excede A4 para que no se corte mal visualmente
                // O mejor, ajustamos al ancho y dejamos que ocupe lo que ocupe verticalmente en una sola página larga
                // para simular un reporte continuo.
                
                // Sin embargo, lo más compatible es A4 y paginar. 
                // Dado que es un reporte "como imagen", haremos que encaje en el ancho A4.
                
                // Si la altura calculada es mayor a A4 (297mm), creamos un PDF con altura personalizada
                if (pdfImgHeight > pdfHeight) {
                    const longPdf = new jsPDF('p', 'mm', [pdfWidth, pdfImgHeight]);
                    longPdf.addImage(imgData, 'PNG', 0, 0, pdfImgWidth, pdfImgHeight);
                    const fechaHora = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
                    longPdf.save('informe-tesoreria-' + fechaHora + '.pdf');
                } else {
                    pdf.addImage(imgData, 'PNG', 0, 0, pdfImgWidth, pdfImgHeight);
                    const fechaHora = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
                    pdf.save('informe-tesoreria-' + fechaHora + '.pdf');
                }

                // Restaurar botón
                btnDescargarPDF.innerHTML = textoOriginal;
                btnDescargarPDF.disabled = false;
            }).catch(error => {
                console.error('Error al generar el PDF:', error);
                alert('Error al generar el PDF. Por favor, intente nuevamente.');

                // Restaurar botón
                btnDescargarPDF.innerHTML = textoOriginal;
                btnDescargarPDF.disabled = false;
            });
        });
    }
</script>

</body>
</html>
