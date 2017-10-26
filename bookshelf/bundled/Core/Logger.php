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
    static public $logFile = "";

    /**
     * Grava mensagem no arquivo de log.
     * 
     * @param string $msg Mensagem para o log.
     * @return void.
     */
    static public function log(string $msg, string $logFile = null)
    {
        if (!is_null($logFile)) {
            self::$logFile = $logFile;
        } else {
            self::$logFile = ROOT.DS.THEONE_SYS["logger"]["home"];
        }
           
        $fileHandler = fopen(self::$logFile, "a");
        fwrite($fileHandler,date('Y-m-d H:i:s')." - ".$msg."\n");
        fclose($fileHandler); 
        
        return;
    }
    
    /**
     * Limpa log e, opcionalmente, faz backup
     * @throws Exceptions\File Arquivo de log não encontrado.
     */
    static public function clear($bkp = null)
    {
        if (!file_exists(self::$logFile)) {
            throw new Exceptions\File("Error erasing log file");
        }
        
        if ($bkp) {       
            $i = filetype(self::$logFile);
            $newbkp = $i++;
            
            copy(self::$logFile, self::$logFile.".bkp.".$newbkp);
        }

        file_put_contents(self::$logFile, date('Y-m-d H:i:s')." - log cleared\n");
        return;
    }
    
    static public function eraseBKP() {        
    }
}
