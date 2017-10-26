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

namespace theone\bundled\Core\Exceptions;

/**
 * Description of FileException
 *
 * @author DaviWL <daviwldev@gmail.com>
 */
class File extends \Exception
{

    const INVALID_FILE  = 0;
    const NOT_FOUND     = 1;
    const NOT_DIRECTORY = 2;

    /**
     * Constroi excessão.
     * @param string $message Mensagem do Desenvolvedor ou Framework.
     * @param int $code Código da excessão.
     */
    public function __construct (string $message, int $code)
    {
        parent::__construct($message, $code);
        
        switch ($code) {
            case self::INVALID_FILE:
                $this->message.="(01 file not exist)\n";
                break;
            
            case self::NOT_FOUND:
                $this->message.="(02 invalid directory)\n";
                break;
            
            case self::NOT_DIRECTORY:
                $this->message.="(03 file error)\n";
                break;
            
            default:
                $this->message.="(00 undefinied file error)\n";
                break;
        }        
        $this->code = $code;
        if ( THEONE_SYS["exceptions"]["autolog"]) {
            $this->log();
        }        
        return;
    }
    
    /**
     * Cria log da mensagem de excessão ou personalizada pelo Desenvolvedor
     * ou Framework..
     * @param string $msg Mensagem customizada da excessão.
     */
      public function log($msg = null)
      {
          $logMsg = !is_null($msg) ?? $this->getMessage();
          \theone\Core\Logger::log($logMsg);
          return;
      }
    
}
