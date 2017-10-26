<?php

/*
 * The MIT License
 *
 * Copyright (C) 2017 DaviWL <daviwldev@gmail.com>
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

/**
 * Description of Logger
 *
 * @author DaviWL <daviwldev@gmail.com>
 */
final class Logger 
{
    static public $logFile = "log.txt";

    static public function setLogfile($logFile)
    {
        if (!file_exists($logFile)) {
            throw new Exceptions\File("Erro utilizando um log", 2);
        }            
        self::$logFile = $logFile;
        return;
    }

    /**
     * Grava mensagem no arquivo de log.
     * 
     * @param string $msg Mensagem para o log.
     * @return void.
     */
    static public function log(string $msg)
    {
        self::setLogfile(THEONE_SYS["logger"]["home"]);
        echo self::$logFile; exit;
        try {
            
            echo self::$logFile;
            
            chmod(self::$logFile, 777);            
        } catch (Exceptions\File $e) {
            echo $e->getMessage();
        }
        
        $fileHandler = fopen(self::$logFile, "a");
        fwrite($fileHandler,date('Y-m-d H:i:s')."n".$msg."nn\n");
        fclose($fileHandler);
        return;       
    }
    
}