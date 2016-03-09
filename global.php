  <?php
function my_autoloader($class) {
    include 'include/classes/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');
?>

