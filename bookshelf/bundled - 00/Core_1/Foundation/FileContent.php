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
use theone\bundled\Core as Core;

/**
 * L6, apaga, edita e organiza arquivos e listas usando uma chave $id. também
 * interpreta o tipo de arquivo que está manipulando dando tratamento exclusivo.
 * @author DaviWL <daviwldev@gmail.com>
 */
abstract class FileContent
{   
    
    /**
     * @var array Lista de arquivos organizada por identificadores.
     * @access protected. 
     */
    protected $fileList = [];
    
    /**
     * @var string Tipo de arquivo preferencial no momento da inclusão de arquivos.
     * @access protected.
     */
    protected $prefferedType = [""];
    
    /**
     * @var bool Carrega automaticamento arquivos adicionados na lista.
     * @access protected.
     */
    protected $autoload = false;
    
    
    /**
     * Formatação de conteúdo tais como Xml, Yaml, Json entre outros formatos. 
     * @param string $content Conteúdo para formatação.
     * @param string $type Tipo de conteúdo do conteúdo
     * 
     */
    abstract public function parseContent(string $content, string $type);
   
    
    /**
     * Edita configurações padronizadas da classe.
     */
    abstract public function set_default_settings();
    
    
    /**
     * Adiciona um arquivo numa lista de itens.
     * @param string $id Identificador do arquivo.
     * @param string $fileLink Link do arquivo.
     * @param bool $load Carregar conteúdo do arquivo.
     * @return bool Arquivo e load(se desejado) forem válidos.
     */
    public function addFile(string $id, string $fileLink): bool
    {
        if (!file_exists($fileLink) or !$this->verifyType($fileLink)) {
            throw new Core\Exceptions\FileException($fileLink);
        }
        
        // localiza caminho na referência do arquivo ($fileLink).
        // extrai caminho da referência
        // armazena o registro e carrega o conteúdo se autoload estiver ativo.
        
        $lastDS   = strripos ($fileLink ,DS);
        $fileName = substr ($fileLink, $lastDS+1);
        $content  = ($this->autoload) ? $this->loadContent($id, $fileLink) : null;
        
        $this->fileList[$id][$fileName][$fileLink] = $content;
        return true;
    }

    
    /**
     * Adiciona todos os arquivos de determinada fonte de arquivos (diretório.)
     * 
     * @param string $id Identificador de todos os arquivos.
     * @param string $source Fonte de arquivos (diretório).
     * @param bool $load Carregar os arquivos.
     * @return boolean Adição concluída com sucesso ou não.
     */
    public function addSourceFiles(string $id, string $source)
    {
        if (!is_dir($source)) {
            throw new Core\FileException("Diretório inválido: $source");
        }
        $files = scandir($$source);
        foreach ($files as $fileLink) {
            $ok = $this->addFile($id, $fileLink);
            if (!$ok) {
                return false;
            }
        }
        return true;
    }

    
    /**
     * Remove a referência de um arquivo com determinado identificador.
     * O conteúdo do arquivo carregado na lista é perdido (não ocorrendo
     * qualquer mudança no arquivo original.)
     * 
     * @param string $id Identificador do arquivo.
     * @param string $fileName Nome do arquivo.
     * @param bool $load Carregar conteúdo do arquivo.
     * @return bool Se Arquivo estiver na lista identificada.
     */
    public function removeFile(string $id, string $fileName): bool
    {
        if (!isset($this->fileList[$id][$fileName])) {
            return false;
        }
        unset($this->fileList[$id][$fileName]);
        return true;
    }
    
    
    /**
     * Carrega o arquivo de determinado identificador e o armazena, removendo
     * o conteúdo anterior.
     * 
     * @param string $id Identificador do arquivo.
     * @param string $fileName Nome do arquivo.
     * @return mixed False no caso de erros e conteúdo string ou array.
     */
    public function loadFile($id, $fileName)
    {
        if (!isset($this->fileList[$id][$fileName])) {
            throw new Core\FileException("Arquivo {$fileName} não encontrado");
        }
        $fileLink = key($this->fileList[$id][$fileName]);                        
        $content  = file_get_contents($fileLink);
        $fileType = $this->getFileType($fileName);
        
        $parsedContent = $this->parseContent($content, $fileType);
        
        if (!$parsedContent) {
            return FALSE;
        }
        echo "<br><h2>"; print_r($this->fileList); echo "<h2><br>";exit;
        $this->fileList[$id][$fileName][$fileLink] = $parsedContent;
        return $parsedContent;
    }
    
    
    /**
     * Carrega o conteúdo de todos os arquivos de um determinado $id e retorna
     * um array ou string formatado como Xml, Json tcs.
     * 
     * @param string $id Identificador do arquivo.
     * @return mixed array com todos os arquivos lidos do $id.
     * @throws Exception
     */
    public function loadID(string $id) 
    {
        if (!isset($this->fileList[$id])) {
            throw new Exception("id not found");
        }
        foreach ($this->fileList as $fileName) {
            $this->loadFile($id, $fileName);
        }
        return true;
    }
    
    
    /**
     * Retorna o tipo de arquivo com base na sua extensão.
     * 
     * @param type $fileName Nome do arquivo.
     * @return string Tipo do arquivo.
     */
    public function getFileType($fileName): string
    {
        $type = trim(substr(strrchr($fileName, "."), 1));
        return $type;
    }
    
    
    /**
     * Verifica se tipo do arquivo fornecido é válido conforme $prefferedType.
     * 
     * @param string $fileName
     * @return bool Tipo correto ou não.
     */
    public function verifyType(string $fileName): bool
    {
        $typeFound = false;
        $fileType = $this->getFileType($fileName);
        echo "<br><font color='red'>$fileType</font><br>";
        foreach ($this->prefferedType as $type) {
            echo "<br><font color='red'>{$fileType}: $type</font><br>";
            if ($fileType == $type) {
                $typeFound = true;
            }
        }
        echo $typeFound;
        return $typeFound;
    }
    
    
    /**
     * Retorna o conteúdo já carregado dos arquivos de determinado $id.
     * Quando um arquivo não possui conteúdo, o método pode ou não ser carregado
     * no processo.

     * @param string $id Identificador do arquivo.
     * @return array Lista com todos os arquivos de determino identificador $id
     * @throws Exception Caso identificador $id não existir na lista de arquivo.
     */
    public function getID(string $id, $load = true): array
    {
        if (!isset($this->fileList[$id])) {
            throw new Exception("trying getID but id not found");
        }        
        if ($load) {
            foreach ($this->fileList[$id] as $key => $value) {
                if (is_null($value)) {
                    $this->loadFile($id, $key);
                }
            }
        }
        return $this->fileList[$id];
    }

    
    /**
     * Retorna o conteúdo de um arquivo de determinado identificador $id.
     * 
     * @param string $id Identificador do arquivo.
     * @param string $fileName Nome do arquivo.
     * @return array Lista com todos os arquivos de determino identificador $id
     * @throws Exception Caso identificador $id não existir na lista de arquivo.
     */
    public function getContent(string $id,string $fileName): array
    {
        if (!isset($this->fileList[$id][$fileName])) {
            throw new Exception("trying getContent but file name not found");
        }
        return $this->fileList[$id][$fileName];
    }
    
    
    /**
     * Alias para getContents.
     */
    public function get(string $id, string $fileName): array
    {
        return $this->getContent($id, $fileName);
    }
    
    
      
     /**
     * Alteral tipo de arquivo preferido.
     * @param string $type Tipo de arquivo.
     * @return none.
     */
    public function set_prefferedType(...$types)
    {
        foreach ($types as $type) {
            $this->prefferedType[] = $type;
        }
        echo "Set types"; print_r($this->prefferedType);echo "<br>";
        return;
    }
    
    
    /**
     * Remove um tipo específico.
     * @param string $type Tipo para ser removido.
     * @return bool Remoção falhou?
     */
    public function unset_prefferedType(string $type): bool
    {
        $key = array_search ( $type , $this->prefferedType);
        if ($key>0) {
            unset($this->prefferedType[$key]);
            echo "Set types"; print_r($this->prefferedType);echo "<br>";
            return true;
        }
        return false;
    }

    
    /**
     * Altera configurações da classe.
     * @param bool $autoload Carregamento de conteúdo automático ou não.
     * @param string $types Tipos suportados.
     */
    public function set_settings(bool $autoload, string ...$types)
    {
        $this->set_prefferedType($types);
        $this->set_autoload($autoload);
        return;
    }
    
    
    /**
     * Ativa ou desativa o autoload do objeto.
     * @param bool $autoload Carregamento automático ou não.
     * @return none.
     */
    public function set_autoload(bool $autoload)
    {
        $this->autoload = $autoload;
        return;
    }
    
}
