<?php
echo "Hello World!<br>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Current Directory: " . getcwd() . "<br>";
echo "File exists check:<br>";
echo "index.php: " . (file_exists('index.php') ? 'YES' : 'NO') . "<br>";
echo "vendor/autoload.php: " . (file_exists('vendor/autoload.php') ? 'YES' : 'NO') . "<br>";
echo "bootstrap/app.php: " . (file_exists('bootstrap/app.php') ? 'YES' : 'NO') . "<br>";
echo "storage directory: " . (is_dir('storage') ? 'YES' : 'NO') . "<br>";
?>
