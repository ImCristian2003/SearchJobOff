<?php
include('Fuction_Backup.php');

echo backup_tables('localhost','root','','searchjob');

$fecha=date("Y-m-d");
header("Content-disposition: attachment; filename=db-backup-".$fecha.".sql");
header("Content-type: MIME");
echo '<script> alert("Copia de seguridad descargada exitosamente en la dirección: C:\xampp\htdocs\SearchjobOff\assets\libraries\backupDB\backups"); window.location="views/admin/gestionarBD.php"; </script>';
readfile("../../bd/copiasSeguridad/copia-seguridad-".$fecha.".sql");
