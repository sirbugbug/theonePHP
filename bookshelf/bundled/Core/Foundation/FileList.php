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
 * Description of FileList
 *
 * @author DaviWL <daviwldev@gmail.com>
 */
//abstract 
class FileList
{
    protected $files = [];
    protected $prefferedTypes = ["*"];
    
    
    /**
     * Formata conteúdo de acordo com seu tipo de arquivo.
     * @param string $content Conteúdo do arquivo.
     * @param string $type Tipo do arquivo.
     */
    //abstract function parseContent(string $content, string $type);
    
    /**
     * Adiciona arquivo na lista
     * @param string $id Identificador.
     * @param string $fileLink Nome e caminho do arquivo.
     */
    function addFile(string $id, string $fileLink): bool
    {
        // verifica se arquivo existe e é de um tipo aceito.
        
        if (!$this->tryFile($fileLink)) {
            //throw new \Exception("Arquivo não aprovado");
            return false;
        }
        
        // separa nome de seu caminho e o adiciona na lista
        
        $fileName = $this->catchFileName($fileLink);
        $this->files[$id][$fileLink][$fileName] = null;
        
        return true;
    }
    
    /**
     * Adiciona à lista todos os arquivos aceitos.
     * @param string $id Identificador para os arquivos.
     * @param string $source Diretório com os arquivos a serem
     * incluidos na lista.
     * @return bool Adição com êxito.
     */
    function addSourceFiles(string $id, string $source)  : bool
    {
        $ok = false;
        $files = scandir($source);
        foreach ($files as $fileName) {
            if ($fileName == "." or $fileName == "..") {
                continue;
            }
            $ok = $this->addFile($id, $source.DS.$fileName);
        }
        return $ok;
    }
    
    /**
     * Remove arquivos registrados na lista do objeto.
     * @param string $Id Identificador do arquivo.
     * @param string $files Arquivos registrados.
     * @return bool Remoção com sucesso, considerando válidos todos os 
     * arquivos para remoção.
     */
    function removeFiles(string $id, string ...$files): bool
    {
        if  (!array_key_exists($id, $this->files)) {
            return false;
        }
        foreach ($files as $value) {
            unset($this->files[$id][$value]);
        }
        return true;
    }
    
    /**
     * Remove todos os arquivos de um identificador. 
     * @param string $id Identificador a ser eliminado.
     * @return bool Remoção efetuada com sucesso.
     */
    function removeIDFiles(string $id): bool
    {
        if  (!array_key_exists($id, $this->files)) {
            return false;
        }
        unset($this->files[$id]);
        return true;
    }
    
    function get($id, $fileName)
    {
        // verifica se arquivo existe e é de um tipo aceito.
        
        foreach ( $this->files as $key => $value ) {
            print_r($key);echo "</p>";            
        }
        
//        if (!$this->tryFile($fileLink)) {
//            //throw new \Exception("Arquivo não aprovado");
//            return false;
//        }
//        $fileLink = key($this->files[$id][$fileName]);
        return $this->files[$id][$fileName][$fileLink];
    }
    
    
    function loadFile(string $id, string $fileName)
    {
        // Arquivo incluindo seu caminho.
        $fileLink = key( $this->files[$id][$fileName] );

        // Verifica o tipo do arquivo.
        $type = filetype($fileLink);

        // Carrega conteudo do arquivo.
        $content = file_get_contents($fileLink);

        // Formata conteúdo de acordo com seu tipo.
        // $newContent = $this->parseContent($content, $type);
        $newContent = $content;

        // Armazena conteudo na lista de arquivos
        $this->files[$id][$fileName][$fileLink] = $newContent;

        return $newContent;
    }
    
    function loadID(string $id)
    {
        $ok = false;
        /**
         * @todo Otimizar foreach com chamada loadFile.
         */
        foreach ($this->files[$id] as $fileName => $fileLink) {
            $ok = $this->loadFile($id, $fileName);
        }
        print_r($this->files);
        return $ok;
    }
    
    function load()
    {
        $ok = false;
        /**
         * @todo Otimizar foreach com chamada loadID.
         */
        foreach ($this->files as $key => $value) {
            $ok = $this->loadID($key);
        }
        return $ok;
    }
    
//    function loadID(string $id){}
//    function parseContent(string $content){}
//    function getContent(string $fileName){}
//    function get(string $id, string $fileName){}
//    function setPrefferedTypes(array $types){}

    /**
     * Separa o caminho do nome do arquivo.
     * @param string $fileLink Nome do arquivo com caminho completos.
     * @return string Retorna apenas o nome do arquivo sem seu caminho.
     */
    function catchFileName(string $fileLink): string
    {
        $lastDS     = strripos ($fileLink ,DS);
        $fileName = substr ($fileLink, $lastDS+1);
        return $fileName;
    }
    
    /**
     * Verifica existência e se o tipo do arquivo é aceito.
     * @param string $fileLink
     * @return bool Teste realizado com sucesso.
     * @throws Exception Arquivo não existe.
     */
    function tryFile(string $fileLink) : bool
    {
        // primeiro verifica se o arquivo existe no caminho indicado.
        if ( !file_exists($fileLink) ) {
            return false;
        }
        
        // Verifica se o arquivo testado é de um tipo aceito.
        foreach ($this->prefferedTypes as $value) {
            
            // procura tipo de arquivo na lista padrão.
            if (filetype($fileLink) == $value or $value == "*") {
                return true;
            }
        }
        return false;
    }
    
}