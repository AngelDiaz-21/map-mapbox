<?php
function generateTable($employe) {
    $tabla = '<table class="table table-bordered table-sm table-hover">
                <thead>
                    <tr class="font-weight-bold bg-dark text-white text-center">
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Información</th>
                        <th>Camas totales</th>
                        <th>Camas ocupadas</th>
                        <th>Camas disponibles</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($employe as $value) {
        $tabla .= sprintf('
            <tr class="text-center">
                <td>%s</td>
                <td>%s</td>
                <td class="text-justify">%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
            </tr>',
            $value['hospital_nombre'],
            $value['telefono'],
            $value['informacion'],
            $value['total_camas'],
            $value['camas_ocupadas'],
            $value['camas_disponibles']
        );
    }

    return $tabla .= '</tbody></table>';
}
?>