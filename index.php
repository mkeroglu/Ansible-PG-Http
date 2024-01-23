<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostgreSQL Bağlantısı</title>
</head>
<body>

    <h2>PostgreSQL Table</h2>

    <?php
    $connection = pg_connect("host=10.106.31.106 dbname=Sekom user=postgres password=q1w2e3r4");
    if (!$connection) {
        echo "ERROR.<br>";
        exit;
    }

    $result = pg_query($connection, 'SELECT * FROM "Personal List-2"');
    if(!$result) {
        echo "RESULT ERROR.<br>";
        exit;
    }
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>SURNAME</th>
            <th>JOB-TITLE</th>
        </tr>
        <?php
        while($row = pg_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['surname']}</td>
                <td>{$row['jobtitle']}</td>
            </tr>
            ";
        }
        ?>
    </table>

</body>
</html>

