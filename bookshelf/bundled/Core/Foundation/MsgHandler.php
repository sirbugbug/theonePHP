<?php

/*
 * The MIT License
 *
 * Copyright 2017 euloucopoeta.
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

namespace theone\bundled\Core\Foundation;

/**
 * Description of MessageHandler
 *
 * @author euloucopoeta
 */
class MsgHandler
{
    protected static $list = [];
    protected static $counter = 0;

    /**
     * Adiciona uma mensagem.
     * 
     * @param string $className Classe-origem da mensagem.
     * @param string $methodName Método-origem da mensagem.
     * @param array $data Mensagem e lista de informações relacionadas.
     * @param int $errcode Código de erro se necessário.
     * @return boolean Adição realizada com sucesso..
     */
    function add(string $className, string $methodName, array $data,  int  $errcode = -1)
    { 
        if ($errcode >= 0) {
            self::$list[] [$className] [$methodName] = array();
        } else {
            self::$list[$className][$methodName]  = $data;
        }
      
        self::$counter++;
        return true;
    }
    
    function readMessage($className, $methodName, $pos)
    {
        if ( !isset(self::$list[$className][$methodName][$pos]) ) {
            MessageHandler::addMessage(__CLASS__, __METHOD__,[ $pos, "mensagem requirida não foi encontrada"]);
            return false;
        }
        return self::$list[$className] [$messageName] [$pos];
    }
    
    function getClassMessages()
    {
        if (!isset(self::$list[$className])) {
            MessageHandler::addMessage(__CLASS__, __METHOD__,[ [], "mensagem de uma classe e método não foi encontrados"]);
            return self::$list[$className] [$messageName];
        }
    }    
    
    
    
    
    
    
    function getMessage(string $className, string $methodName) {
        return self::$list[$id][$code];
    }
    
    function removeMessage(string $id, int $type);
    function getMessageList(string $id, int $type);
    
    function lastMessage()
    {
        $msg = self::$list;
        $result = array_pop($msg);
        return $result;
    }
    
    function popMessage() {
        return array_pop(self::$list);
    }
    
    function shiftMessage() {
        return array_shift(self::$list);
    }
    
//    function firstMessage();
//    function nextMessage();
//    function previousMessage();
    
    
}
