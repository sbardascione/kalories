<?php

namespace KaloriesBundle\Repository;


use Doctrine\ORM\EntityRepository;
use KaloriesBundle\Entity\User;

class MealRepository extends EntityRepository
{
    public function findByUserFilterByDateGroupedByDay(User $user, $date_from = null, $date_to = null){

        $query = $this->createQueryBuilder("m")
            ->select("DATE_FORMAT(m.date,'%Y-%m-%d') as day")
            ->addSelect("sum(m.calories) as day_calories")
            ->where("m.user = :user")->setParameter('user',$user);

        if(isset($date_from)){
            $query->andWhere("m.date >= :date_from")->setParameter('date_from', $date_from);
        }

        if(isset($date_to)){
            $query->andWhere("m.date <= :date_to")->setParameter('date_to', $date_to);
        }

        $query->groupBy("day")
            ->orderBy("day");

        return $query->getQuery()->getResult();
    }

}