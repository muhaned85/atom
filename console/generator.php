<?php

class CodeGenerator {
    public static function generateController($className) {
        $filename = $className . 'Controller.php';
        $content = "<?php\n\nclass $className" . "Controller {\n\n}";
        self::saveFile($filename, $content);
    }

    public static function generateModel($className) {
        $filename = $className . '.php';
        $content = "<?php\n\nclass $className {\n\n}";
        self::saveFile($filename, $content);
    }

    private static function saveFile($filename, $content) {
        $handle = fopen($filename, 'w') or die('Cannot open file:  '.$filename);
        fwrite($handle, $content);
        fclose($handle);
        echo "File '$filename' created successfully!";
    }
}

// Usage example
$controllerName = "UserController";
$modelName = "User";

CodeGenerator::generateController($controllerName);
CodeGenerator::generateModel($modelName);
?>
