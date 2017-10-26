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
 * Aplicação.
 * Registro de todos os objetos do Framework e Aplicativo. Um acesso global à
 * objetos, durante a vída do aplicativo, incluindo os processos de cache.
 * Também tem um método para criação de objetos dinâmicos, não previstos no
 * Framework.
 * 
 * @package core
 * @version prealfa
 * @author  leik4
 */
class Environment extends Foundation\Registry
{
    use Foundation\Singleton;
    /**
     * Instância da classe.
     * @access private
     */
    protected static $frameworkID = "theOne alpha.0.05";
    
    /** 
     * Cria e retorna uma instância única da classe.
     * @return \blacklabel\core\Registry./
     */
    public static function getFrameworkID()
    {
        return self::$frameworkID;
    }    
}
