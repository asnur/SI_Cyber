<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absen</title>
</head>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Rekap Absen.xls");
    ?>
    <table>
        <tr>
            <td>Nama</td>
            <td>Jam</td>
            <td>Jam</td>
        </tr>
        <?php
        foreach ($absen as $a) {
        ?>
            <tr>
                <td><?= $a['nama'] ?></td>
                <td><?= $a['jam'] ?></td>
                <td><?= $a['tanggal'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>