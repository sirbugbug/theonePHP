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

namespace theone\bundled\Core\Foundation;

/**
 * Description of Singleton
 * @namespace neoidea\core
 * @package   core
 * @version prealfa
 * @author leik4
 */
trait Singleton
{
    /**
     * Instância da classe.
     * @access protected static
     */
    protected static $instance;
    
    /**
     * Cria e retorna uma instância única da classe.
     * 
     * @return \theone\Core\Registry.
     */
    public static function getInstance()
    {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance; 
    }
    /**
     * Impede que seja feito um clone o objeto.
     * (issues an E_USER_ERROR caso um clone seja requisitado.
     */
    public function __clone()
    {
	trigger_error( 'Cloning the registry is not permitted', E_USER_ERROR );
    }
}
