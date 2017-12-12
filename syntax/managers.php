<?php
/**
 * DokuWiki Plugin animalleague (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Michal Kapusnik <michal.kapusnik@gmail.com>
 */

if (!defined('DOKU_INC')) die();

class syntax_plugin_animalleague_managers extends DokuWiki_Syntax_Plugin {
    public function getType() {
        return 'container'; //'container|baseonly|formatting|substition|protected|disabled|paragraphs';
    }

    public function getPType() {
        return 'block'; //normal|block|stack
    }

    public function getSort() {
        return 200;
    }

    function getAllowedTypes() {
        return array('container','substition','protected','disabled','formatting','paragraphs');
    }

    function connectTo($mode) {
        $this->Lexer->addEntryPattern('##team(?=.*team##)',$mode,'plugin_animalleague_managers');
    }

    function postConnect() {
        $this->Lexer->addExitPattern('team##','plugin_animalleague_managers');
    }

    public function handle($match, $state, $pos, Doku_Handler $handler) {
        switch ( $state ) {
            case DOKU_LEXER_ENTER:
                return array($state);

            case DOKU_LEXER_UNMATCHED:
                //$handler->_addCall('cdata', array($match), $pos);
                return array($state, $match);
                break;
        }
        return array($state, '');

/*
        switch ($state) {
            case DOKU_LEXER_ENTER:
                $this->syntax = substr($match, 1);
                return false;

            case DOKU_LEXER_UNMATCHED:
                //$people = preg_split('\n', $match);
                return explode("\n", $match);
        }

        return false;*/
    }

    public function render($mode, Doku_Renderer $renderer, $data) {
        if($mode != 'xhtml') return false;

        list($state,$match) = $data;
        switch ($state) {
            case DOKU_LEXER_ENTER:
                $renderer->doc .= '<br> ===== XManažer ===== <br>';
                break;

            case DOKU_LEXER_EXIT :
                $renderer->doc .= '<br>YYY';
                $renderer->doc .= "[[Hello@seznam.cz]]: <br> ";
                break;

            default:
                $renderer->doc .= ' DEFX '.$match.' DEFY ';
        }


        //list($content) = $data;
        //[[garlat@centrum.cz]]

        //$renderer->doc .= "[[Hello@seznam.cz]]: <br> ";
        /*if($data) {
            foreach ($data as $person) {
                $renderer->doc .= 'A'.$person.'B'.'<br>';
            }
        }*/

        return true;
    }
}