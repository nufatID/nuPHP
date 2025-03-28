<?php

// Nama file database SQLite
$databaseFile = 'database.sqlite';

// Membuat atau membuka koneksi ke database SQLite
$db = new PDO('sqlite:' . $databaseFile);

// SQL untuk membuat tabel imgclamps
$sql = "
CREATE TABLE IF NOT EXISTS imgclamps (
    cer_id INTEGER PRIMARY KEY AUTOINCREMENT,
    member_id INTEGER NOT NULL,
    type TEXT NOT NULL,
    mime TEXT NOT NULL,
    base64 TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
";

// Menjalankan perintah SQL
$db->exec($sql);

echo "Table imgclamps created successfully.\n";