<?php 
$arg=['-c'=>'makeController','-m'=>'makeModel','-mw'=>'makeMiddleware'];
if (!isset($argv[1]) && !isset($argv[2])) {   
    echo "\033[0;31m 'command like php make -c TaskConroller \033[0m\n";
    exit;
}
 
if (!isset($arg[$argv[1]]))
{
    $ar=$argv[1];
    echo "\033[0;31m 'arg $ar not found  \033[0m\n";
    exit;
}
//call function 
  $arg[$argv[1]]($argv[2]);

 function makeController($name)
 {
   $content= file_get_contents("console/templet/_controller.php");
   $newContent = str_replace("T_Name",ucfirst(strtolower($name)) , $content);
   saveFile("Controller/".ucfirst(strtolower($name)).".php",$newContent);
   exit;
 }
 function makeModel($name)
 {
    $content= file_get_contents("console/templet/_model.php");
    $newContent = str_replace("T_Name",ucfirst(strtolower($name)) , $content);
    saveFile("AppLogic/".ucfirst(strtolower($name)).".php",$newContent);
    exit;

 }
 function  makeMiddleware($name)
 {
    $content= file_get_contents("console/templet/_middleware.php");
    $newContent = str_replace("T_Name",ucfirst(strtolower($name)) , $content);
    saveFile("Middleware/".ucfirst(strtolower($name)).".php",$newContent);
    exit;
 }

 function saveFile($filename, $content) {
   if  (file_exists("app/".$filename)) die("\033[0;31m 'File app/$filename is Exist  \033[0m\n");
   $handle = fopen("app/".$filename, 'w') or die('Cannot open file:  '.$filename);
    fwrite($handle, $content);
    fclose($handle);
    echo "\03[0;32m 'file  app/$filename is Saved \033[0m\n";
}