<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * DiscoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DiscoRepository extends EntityRepository
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

    public function myFindAll()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->where('a.deleted = false');
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        return $results;
    }

    public function getByArtist($artist_id, $page, $limit = null)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder
            ->join('a.artists', 'artist', 'WITH', 'artist.id = :id')
            ->where('a.deleted = false')
            ->orderBy('a.date', 'DESC')
            ->setParameter('id', $artist_id);
        ;

        if (!is_null($limit)) {
            $queryBuilder->setMaxResults($limit);
        }

        $query = $queryBuilder->getQuery();

        $query
            ->setFirstResult(($page-1) * $limit)
            ->setMaxResults($limit)
        ;

        return new Paginator($query);
    }
}