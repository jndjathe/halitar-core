<?php

namespace Halitar\CoreBundle\Manager;

use Halitar\CoreBundle\Manager\AbstractManager;

/**
 * Description of BaseManager
 *
 * @author NDJATHE Julio <jndjathe@halitar.com>
 */
class BaseManager extends AbstractManager {
    
    /**
     * 
     * @return Repository
     */
    public function getRepository() {
        
        return $this->getEm()->getRepository("");
    }  
    
}
