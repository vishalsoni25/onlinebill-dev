<?php
// Database configuration
$host = 'sql208.infinityfree.com';
$username = 'if0_36535169';
$password = 'KOWSw5MBeJT19n';
$database = 'if0_36535169_roughbilling';

// Directory where the backup file will be stored
$backupDir = '/home/vol15_8/infinityfree.com/if0_36535169/htdocs/backup/';
$backupFile = $backupDir . 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Create the backup directory if it doesn't exist
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0777, true);
}

// Create a new connection to the MySQL database
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Open file for writing
$handle = fopen($backupFile, 'w');
if (!$handle) {
    die("Could not open file for writing: " . $backupFile);
}

// Fetch all tables
$tables = $mysqli->query("SHOW TABLES");
if (!$tables) {
    die("Error fetching tables: " . $mysqli->error);
}

// Loop through each table and write its structure and data
while ($row = $tables->fetch_row()) {
    $table = $row[0];

    // Get table structure
    $structure = $mysqli->query("SHOW CREATE TABLE `$table`");
    if (!$structure) {
        die("Error fetching table structure: " . $mysqli->error);
    }

    $createTable = $structure->fetch_row();
    fwrite($handle, $createTable[1] . ";\n\n");

    // Get table data
    $data = $mysqli->query("SELECT * FROM `$table`");
    if (!$data) {
        die("Error fetching table data: " . $mysqli->error);
    }

    while ($dataRow = $data->fetch_assoc()) {
        $columns = array_keys($dataRow);
        $values = array_values($dataRow);

        $columnsList = implode("`, `", $columns);
        $valuesList = implode("', '", array_map([$mysqli, 'real_escape_string'], $values));

        fwrite($handle, "INSERT INTO `$table` (`$columnsList`) VALUES ('$valuesList');\n");
    }

    fwrite($handle, "\n\n");
}

// Close the file
fclose($handle);

// Close the database connection
$mysqli->close();

echo "Backup completed successfully. The backup file is stored at: $backupFile";
?>
