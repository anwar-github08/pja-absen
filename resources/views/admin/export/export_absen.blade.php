<?php
header('Content-type: application/vnd-ms-excel');
header('Content-Disposition: attachment; filename=Data Absen.xls');
?>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Karyawan</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 50; $i++)
            <tr>
                <td>1</td>
                <td>Anwar</td>
            </tr>
        @endfor
    </tbody>
</table>
