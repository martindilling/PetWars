<?php namespace PetWars\Fighters;

class Kitten extends Fighter implements FighterInterface
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->setSpecies('Kitten');
        $this->setHealth(30);
        $this->setDamageHit(5);
        $this->setHurtSound('Meow');
        $this->setDieSound('Meooooow... x_x');
    }
}
