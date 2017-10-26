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
 * Localiza, abre e armazena arquivos de configurações de toda a aplicação
 * e Framework.
 * 
 * @namespace neoidea\core
 * @package core
 * @version prealfa
 * @author leik4
 */
class Config extends Foundation\FileContent
{
    use Foundation\Singleton;
    
    /**
     * Construtor.
     * Cria objeto e faz a configuração default da classe. 
     */
    function __construct() {
        $this->set_default_settings();
    }

    /**
     * Formatação de conteúdo tais como Xml, Yaml, Json entre outros formatos.
     * 
     * @param string $content Conteúdo para formatação.
     * @param string $type Tipo de conteúdo do conteúdo
     * 
     */
    public function parseContent(string $content, string $type)
    {
        switch ($type) {
            case 'json':
                $loadedFile = json_decode($content, true);
                echo "json";
                break;
            case 'ini':
                $loadedFile = parse_ini_file($content);
                break;
            default :
                $loadedFile = null;
                break;
        }
        if ($loadedFile === null) {
            throw new \Exception("File é nulo ou formato não suportado.");
        }
        return $loadedFile;
    }
    
    
    /**
     * Configura tipos prefeferidos e auto carregamento padrões para
     * a classe Config.
     */
    public function set_default_settings()
    {
        $this->set_prefferedType("json", "ini");
        $this->set_autoload(false);
        return;
    }
    
}
