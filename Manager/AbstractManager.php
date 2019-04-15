<?php

namespace Halitar\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Description of AbstractManager
 *
 * @author NDJATHE Julio <jndjathe@halitar.com>
 */
abstract class AbstractManager
{
    use \Halitar\CoreBundle\Query\QueryCommon;

    /**
     * 
     */
    const HYDRATE_ARRAY_RESULT = 10;

    /**
     * The entity manager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     *
     * @var type 
     */
    protected $queryLimit;
    
    /**
     * Constructeur
     * 
     * @param EntityManager $em
     * @param type $queryLimit
     */
    public function __construct(EntityManager $em, $queryLimit)
    {
        $this->em = $em;
        $this->queryLimit = $queryLimit;
    }

    /**
     * Get the entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * Get the repository of the current entity
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    abstract public function getRepository();    
}
