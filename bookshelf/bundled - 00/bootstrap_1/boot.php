<?php
/*
 * The MIT License
 *
 * Copyright 2017  PHP Blacklabel!
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace theone\bundled\Core;
use theone\bundled\Core\Exceptions as Exceptions;

Logger::log("testando");


try {
    
    $a = 0;
    $b = $a/2;
    
} catch ( Exceptions\File $ex ) {
    echo $ex->getMessage();
    $ex->log();
    die ("realiza gravação de log");
    
}

echo "<br>passou!";


//try {
//    $a = 0;
//    $b = $a/2;
//} catch (Exceptions\FileExcepption $ex) {
//    echo $ex;
//}
//
//echo "<br>passou!";









// Cria ambiente do aplicativo

//$env = Environment::getInstance();
//$config = $env->newObject("theone\bundled\Core", "Config");

//$config->addFile("core", SYSROOT.DS."config/testeando.json", true);

//$config->addSourceFiles("core", SYSROOT.DS."config", true);
//$config->loadID("core");
        










//$source = SYSROOT.DS."config";
//echo "here ... $source <br>";
//
//if (!is_dir($source)) {
//    return false;
//}
//            
//$dirFiles = scandir($source);
//foreach ($dirFiles as $item) {
//    
//    if (is_dir($item)) {
//        continue;
//    }
//            
//            $file = $source.DS.$item;
//            $fileName = str_replace(strrchr($item, "."),"",$item);
//            echo "{$fileName}, <b>{$file}</b> <br>";
//}
 
//print_r($config);
        