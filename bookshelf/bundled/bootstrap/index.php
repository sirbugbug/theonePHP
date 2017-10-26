<?php

/**
 * Criação de constantes, arrays, classes annônimas "globais"
 * e carregamento da função autoload.
 * PHP version 7.
 *
 * @package theone\Boot.
 * @author  Leik04
 * @license MIT
 */

namespace theone\bundled\Boot;

// Prepara framework antes da sua lógica.
// Caminhos do Framework e do Projeto


// O caminho do Prdjeto desde a raiz do servidor web.
define('ROOT', dirname(dirname(dirname(__FILE__))));


// Root do projeto, não do servidor.
define('SYSROOT', dirname(dirname(__FILE__)));


// Caminho do URL do Projeto.
define('WEBROOT', dirname(dirname(dirname(__FILE__))));


// Namespace do Framework.
define('NSROOT', "theone");


// Separador de diretórios do SO.
define('DS', DIRECTORY_SEPARATOR);

// Flags doFramework.
define("THEONE_LOGIC", 100);
define("THEONE_FILE", 500);
define("THEONE_TYPE", 501);


// Define a constante com as configurações exclusivas do framework.
define("THEONE_SYS", parse_ini_file('system.ini', true));



// Chamando o processo de boot.
// Prepara framework antes da sua lógica.
// Define a constante com as configurações exclusivas do framework.

//require SYSROOT."/Core/Foundation/exception_handler.php";
require SYSROOT.'/Core/Foundation/autoload.php';
require SYSROOT.'/bootstrap/boot.php';
