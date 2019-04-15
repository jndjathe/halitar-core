<?php

namespace Halitar\CoreBundle\Controller;

/**
 * Description of BaseJsonResponse
 *
 * @author NDJATHE Julio <jndjathe@halitar.com>
 */
class BaseJsonResponse {
    
    /**
     * Les donnees
     *
     * @var array
     */
    protected $aData = array();

    /**
     * 
     * @return array
     */
    public function getCmds()
    {
        return $this->aData;
    }

    /**
     * Ajout d'un action Ajax
     * 
     * @param type $cmd
     * @param array $params
     * @return \BaseJsonResponse
     */
    public function addCmd($cmd, array $params = array(), $useTimer = false)
    {
        $this->aData[] = array(
            'cmd' => $cmd,
            'params' => $params,
            'useTimer' => $useTimer,
        );

        return $this;
    }
    
    /**
     * Retourne la reponse au format json
     * 
     * @return type
     */
    public function getJsonResponse() {
        return $this->getCmds();
    }
}
