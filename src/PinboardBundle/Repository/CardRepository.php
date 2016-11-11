<?php

namespace PinboardBundle\Repository;

/**
 * CardRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CardRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Retrieve all the active cards, sorted by the "sort" parameter
     *
     * @param string $sort
     * @return array
     */
    public function getActiveCards($sort = 'ASC')
    {
        return $this->createQueryBuilder('c')
            ->where('c.active = :active_param')
            ->setParameter('active_param', true)
            ->orderBy('c.sort', $sort)
            ->getQuery()
            ->getResult();
    }
}