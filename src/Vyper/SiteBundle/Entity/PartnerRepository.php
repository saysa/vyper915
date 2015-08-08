<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PartnerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PartnerRepository extends EntityRepository
{
    public function getByPictureId($pictureID)
    {
        $queryBuilder = $this->createQueryBuilder('t');
        $queryBuilder
            ->where('t.picture = :pictureID')
            ->setParameter('pictureID', $pictureID)
        ;
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        return $results;
    }

    public function partnerMedia($type)
    {
        $queryBuilder = $this->createQueryBuilder('t');
        $queryBuilder
            ->where('t.type = :type')
            ->setParameter('type', $type)
        ;
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        return $results;
    }

    public function partnerEvent($type)
    {
        $queryBuilder = $this->createQueryBuilder('t');
        $queryBuilder
            ->where('t.type = :type')
            ->setParameter('type', $type)
        ;
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        return $results;
    }

}