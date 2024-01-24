<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostgreSQL Table List with Contents</title>
</head>
<body>

    <h2>PostgreSQL Table List with Contents</h2>

    <?php
    $host = "<your_postgresql_host>";
    $db = "<your_postgresql_db>";
    $user = "<your_postgresql_user>";
    $password = "<your_postgresql_password>";
    $connection = pg_connect("host=$host dbname=$db user=$user password=$password");
    if (!$connection) {
        echo "ERROR.<br>";
        exit;
    }

    // Tüm tablo isimlerini dinamik olarak al
    $result = pg_query($connection, "SELECT table_name FROM information_schema.tables WHERE table_schema='public'");

    if (!$result) {
        echo "RESULT ERROR.<br>";
        exit;
    }

    // Her tabloyu döngü içinde işle
    while ($row = pg_fetch_assoc($result)) {
        $tableName = $row['table_name'];

        $contentResult = pg_query_params($connection, "SELECT * FROM " . pg_escape_identifier($tableName), array());

        if (!$contentResult) {
            echo " - Content ERROR for table {$tableName}: " . pg_last_error($connection);
        } else {
            $numRows = pg_num_rows($contentResult);

            if ($numRows > 0) {
                echo "<h3>{$tableName}</h3>";
                echo "<table border='1'>";

                // Tablo başlıkları
                echo "<tr>";
                for ($i = 0; $i < pg_num_fields($contentResult); $i++) {
                    echo "<th>" . pg_field_name($contentResult, $i) . "</th>";
                }
                echo "</tr>";

                // Tablo içeriği
                while ($contentRow = pg_fetch_assoc($contentResult)) {
                    echo "<tr>";
                    foreach ($contentRow as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            }
        }
    }
    ?>

</body>
</html>

