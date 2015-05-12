<?php namespace PetWars\Fighters;

class Puppy extends Fighter implements FighterInterface
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->setSpecies('Puppy');
        $this->setHealth(30);
        $this->setDamageHit(5);
        $this->setHurtSound('Woof');
        $this->setDieSound('Woooooof... x_x');
    }
}
