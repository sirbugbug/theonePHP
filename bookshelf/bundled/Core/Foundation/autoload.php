<?php
namespace theone\bundled\Core\Foundation;

spl_autoload_register(function ($class)
{
    
    // Formata o nome do arquivo de ac
    
    $classRoot  = str_replace(NSROOT.'\\','',$class);
    $classClean = str_replace("\\","/",$classRoot);
    $classFile  = ROOT.DS.$classClean.".php";

    if (file_exists($classFile)) {
        require_once $classFile;
        return;
    }
    
    throw new \Exception("{$classFile} não encontrado pelo autoloader.");
});
