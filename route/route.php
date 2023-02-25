<?php

/** 
 * @package route
 * @author Murilo Gomes <contatoprofmugomes@gmail.com>
 * @copyright (c) 2023 Murilo Gomes
 * @license GPL-2.0
 * @version 1.0.0, 2023-02-24
 */

namespace Route;

class route
{
    private $aAllUrls = array();
    private $sURLs = '';
    private $aURLs = array();

    /* Obtém a URL e realiza a separação das partes das URLs */
    public function __construct()
    {
        /**
         * Caso esteja usando o servidor embutido do PHP o getenv retornará vazio
         * nesse caso será necessário usar a variável global
         */

        $requestURI = empty(getenv('REQUEST_URI')) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
        $sURL = rtrim(parse_url($requestURI, PHP_URL_PATH), '/');

        $sURLs = empty($sURL) ? '/' : $sURL;

        $sParturl1 = explode('/', $sURLs);
        $sParturl2 = array_filter($sParturl1);
        $sParturl3 = array_values($sParturl2);

        $retorno = array($sURLs, $sParturl3);
        $this->aAllUrls = $retorno;
        $this->sURLs = $retorno[0];
        $this->aURLs = $retorno[1];
    }

    /* Retorna o array das URLs */
    public function getAllURLs()
    {
        return $this->aAllUrls;
    }

    /* Retorna as URLs com as barras */
    public function getURLs()
    {
        return implode('/', $this->aURLs);
    }

    /* Retorna verdadeiro ou falso de acordo com o nome da URL */
    public function verificarURL(string $nome)
    {
        if (preg_match('#^' . $nome . '$#iu', $this->sURLs, $matches)) {
            $retorno = true;
        } else {
            $retorno = false;
        }

        return $retorno;
    }

    /* Retorna o nome da URL de acordo com o índice informado */
    public function getURL(int $ntxt)
    {
        $retorno = empty($this->aURLs[$ntxt]) ? '' : $this->aURLs[$ntxt];

        return $retorno;
    }

    /* Retorna a primeira URL */
    public function getPrimeiraURL()
    {
        return empty($this->aURLs[0]) ? '' : $this->aURLs[0];
    }

    /* Retorna a penultima URL */
    public function getPenultimaURL()
    {
        if (!empty($this->aURLs[count($this->aURLs) - 2])) {
            return $this->aURLs[count($this->aURLs) - 2];
        } else {
            return '';
        }
    }

    /* Retorna a ultima URL */
    public function getUltimaURL()
    {
        return end($this->aURLs);
    }
}
