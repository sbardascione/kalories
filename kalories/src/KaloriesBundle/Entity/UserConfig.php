<?php

namespace KaloriesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_config")
 */
class UserConfig
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * One Product has One Shipping.
     * @ORM\OneToOne(targetEntity="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer",name="day_calories", nullable=false)
     */
    private $day_calories;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDayCalories()
    {
        return $this->day_calories;
    }

    /**
     * @param mixed $day_calories
     */
    public function setDayCalories($day_calories)
    {
        $this->day_calories = $day_calories;
    }


}