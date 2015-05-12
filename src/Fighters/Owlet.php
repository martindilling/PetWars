<?php namespace PetWars\Fighters;

class Owlet extends Fighter implements FighterInterface
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->setSpecies('Owlet');
        $this->setHealth(30);
        $this->setDamageHit(5);
        $this->setHurtSound('Hoot');
        $this->setDieSound('Hoooooot... x_x');
    }
}
