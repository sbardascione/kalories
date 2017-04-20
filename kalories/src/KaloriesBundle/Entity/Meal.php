<?php

namespace KaloriesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="KaloriesBundle\Repository\MealRepository")
 * @ORM\Table(name="meal")
 */
class Meal
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Many Meals have One User.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="meals")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime",name="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer",name="calories")
     */
    private $calories;

    /**
     * @ORM\Column(type="string",name="name", length=50)
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * @param mixed $calories
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;
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




}