<?php
require_once('vendor/autoload.php');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
// Set the file name with current time
$filename = 'report_' . date('YmdHis') . '.docx';

// Save the document as a Word file
$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($filename);

// Download the file
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));
ob_clean();
flush();
readfile($filename);
unlink($filename);
exit;
?>


