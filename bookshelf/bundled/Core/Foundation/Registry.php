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
 * Registra objetos.
 * Armazena referências identificadas por uma string à objetos.
 * 
 * @package Core
 * @subpackage Foundation
 * @version prealfa
 * @author DaviWL
 */
abstract class Registry
{
    use Singleton;
    
    /**
     * @var array Lista com objetos armazenados - registrados - na classe.
     * @access protected static.
     */
    protected static $objects = [];

  
    /**
     * Clona um objeto.
     * 
     * @throws Impede que seja feito um clone o objeto.
     * (issues an E_USER_ERROR caso um clone seja requisitado.
     */
    public function __clone()
    {
        trigger_error( 'Cloning the registry is not permitted', E_USER_ERROR );
    }
    
    
    /**
     * Cria uma instância da classe passada. Cria através de dois métodos:
     * através de seu construtor ou chamando um método getInstance, comum a
     * todas as classes theone\ derivadas de um objeto Singleton.
     * 
     * @param string $className Namespace da classe.
     * @param string $params Parâmetros para o construtor da classe.
     * @return objeto Objeto criado.
     */
    public function newObject(string $ns, string $className, string ...$params)
    {
        $class = $ns."\\".$className;
        echo "<br><b>".$class."</b><br>";
        if (method_exists($class,'getInstance')) {
            $obj = $class::getInstance();
        } else {
            $obj = new $class($params);
        }
        
        self::storeObject($obj, $className);
        return self::obj($className);
    }
 
    
    /**
     * Armazena um objeto com uma identificação.
     * 
     * @param unknown $object
     * @param unknown $id
     */
    public static function storeObject( &$object, string $id )
    {
        self::$objects[$id] = $object;
        return $object;
    }
    
 
    /**
     * Retorna um objeto do registro
     * 
     * @param String $id Chave do Objeto.
     * @return object Objeto.
     */
    public static function obj( $id )
    {   
        if (key_exists($id, self::$objects)) {
            return self::$objects[ $id ];
        } else {
            throw new \Exception("Meu Objeto $id não encontrado.");
        }
        return null;
    }
    
    
    /**
     * Retorna um objeto do registro
     * 
     * @param String $id Chave do Objeto.
     * @return object Objeto.
     */
    public function __get( $id )
    {   
        if (key_exists($id, self::$objects)) {
            return self::$objects[ $id ];
        } else {
            throw new \Exception("Meu Objeto $id não encontrado.");
        }
        return null;
    }
    
    
    /**
     * Remove um objeto do registro
     * 
     * @param String $id Chave do Objeto.
     * @return boolean Remoção realizada com sucesso.
     */
    public static function removeObject($id): bool
    {
        $ok = false;
        if ( is_object( self::$objects[ $id ] )) {
            unset(self::$objects[$id]);
            $ok = true;
        }
        return $ok;
    }
}
