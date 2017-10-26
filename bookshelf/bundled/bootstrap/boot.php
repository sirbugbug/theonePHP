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
 * furnished to do so, subject to the following conditions: = 
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

// Cria ambiente do aplicativo

$env = Environment::getInstance();

$f = new Foundation\FileList;
$source = ROOT.DS."bundled/config";

$f->addSourceFiles("core", $source);
$f->load();

$local = $f->get("core","theone.json");



        
//$config = $env->newObject("theone\bundled\Core\Foundation", "FileList");
//
//Logger::log("Objetos principais inicializados pelo ambiente(Eviromment).");
//
//$file =  SYSROOT.DS."config/theone.json";
//$config->addFile("core", $file);







//$config->addSourceFiles("core", SYSROOT.DS."config");
//$v = $config->get("core", "theone_3.json");
//echo $v;




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
        