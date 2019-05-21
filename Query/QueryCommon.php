<?php

namespace Halitar\CoreBundle\Query;

use Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of QueryCommon
 *
 * @author NDJATHE Julio <dev@halitar.com>
 */
trait QueryCommon {
    
    /**
     * Entity manager de doctrine
     * 
     * @return EntityManager
     */
    abstract public function getEm();
        
    /**
     * Connection PDO
     * 
     * @return Connection
     */
    public function getConnection() {

        return $this->getEm()->getConnection();
    }    
        
    /**
     * Execute une requete sql
     * 
     * @param type $sql
     * @return type
     */
    public function executeNativeQuery($sql) {
        
        return $this->getConnection()->executeQuery($sql)->fetchAll();
    }
    
    /**
     * Execute une requete sql et retourne une seule colonne
     * Utile pour les requetes de type count, select column from table where id = num etc ...
     * 
     * @param type $sql
     * @return type
     */
    public function executeNativeQueryColumn($sql) {
        
        return $this->getConnection()->executeQuery($sql)->fetchColumn();
    }    

    /**
     * Detach the current entity
     *
     * @param object $entity
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function detach($entity)
    {
        $this->getEm()->detach($entity);

        return $this;
    }

    /**
     * Remove the given entity
     *
     * @param  object $entity
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function remove($entity)
    {
        $this->getEm()->remove($entity);

        return $this;
    }

    /**
     * Persist of the given entity
     *
     * @param  object $entity
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function persist($entity)
    {
        $this->getEm()->persist($entity);

        return $this;
    }

    /**
     * Flush
     *
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function flush()
    {
        $this->getEm()->flush();

        return $this;
    }

    /**
     * Merge
     * Important : The managed entity is A NEW entity, you must get the returned value !
     * Important : Merge execute a query in order to fill the new managed entity !
     *
     * @return object The managed copy of the entity
     */
    public function merge($entity)
    {
        return $this->getEm()->merge($entity);
    }

    /**
     * Persist & Flush shortcuts
     *
     * @param  object $entity
     * @return \Main\CoreBundle\Manager\BaseManager
     */
    public function persistAndFlush($entity)
    {
        return $this->persist($entity)->flush();
    }

    /**
     * Remove & Flush shortcuts
     *
     * @param  object $entity
     * @return \Main\CoreBundle\Manager\BaseManager
     */
    public function removeAndFlush($entity)
    {
        return $this->remove($entity)->flush();
    }

    /**
     * Manually start a transaction (suspend auto-commit)
     *
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function beginTransaction()
    {
        $this->getEm()->getConnection()->beginTransaction();

        return $this;
    }

    /**
     * Manually commit a transaction
     *
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function commit()
    {
        $this->getEm()->getConnection()->commit();

        return $this;
    }

    /**
     * Manually rollback a transaction
     *
     * @return \Main\CoreBundle\Manager\Base\BaseManager
     */
    public function rollback()
    {
        $this->getEm()->close();
        $this->getEm()->getConnection()->rollBack();

        return $this;
    }

    /**
     * Executes a function in a transaction
     * Executes a flush after it, and manage beginTransaction, commit & rollback
     *
     * @param  callable $fnProcess
     * @return mixed
     */
    public function transactional($fnProcess)
    {
        try {

            // Execution de la fonction au sein de la transaction
            return $this->getEm()->transactional($fnProcess);

        } catch(StopTransactionException $e) {

            // On ne bloque rien dans cas
            return false;

        } catch(Exception $e) {

            // Pour le reste, comportement normal
            throw $e;

        }
    }    

    /**
     * Execution des requetes de type DQL
     * 
     * @param type $dql
     * @param type $params
     * @param type $limit
     * @return Query
     */
    public function getDql($dql, $params = array(), $limit = null) {

        $query = $this->getEm()->createQuery($dql);

        if (!is_null($limit)) {

            $query->setMaxResults($limit);
        }

        foreach ($params as $key => $value) {

            $query->setParameter($key, $value);
        }

        return $query;
    }

    /**
     * Execution des requetes de type DQL avec Paginator
     * 
     * @param type $dql
     * @param type $params
     * @param type $page
     * @param type $limit
     * @return Paginator
     */
    public function getDqlPaginator($dql, $params = array(), $page = 1, $limit = 30) {

        if (is_null($page)) {

            $page = 1;
        }

        $query = $this->getEm()->createQuery($dql)
                ->setFirstResult(($page - 1) * $limit)
                ->setMaxResults($limit);

        foreach ($params as $key => $value) {

            $query->setParameter($key, $value);
        }

        $query->setHydrationMode(Query::HYDRATE_ARRAY);

        return new Paginator($query, $fetchJoinCollection = true);
    }

}
