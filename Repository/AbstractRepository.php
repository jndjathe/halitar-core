<?php

namespace Halitar\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of AbstractRepository
 * 
 * @author NDJATHE Julio <dev@halitar.com>
 */
abstract class AbstractRepository extends EntityRepository {
    
    use \Halitar\CoreBundle\Query\QueryCommon;
    
    /**
     * 
     * @return EntityManager
     */
    public function getEm() {

        return $this->getEntityManager();
    }    
}
