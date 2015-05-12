<?php namespace PetWars\Fighters;

class Lamb extends Fighter implements FighterInterface
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->setSpecies('Lamb');
        $this->setHealth(30);
        $this->setDamageHit(5);
        $this->setHurtSound('Baah');
        $this->setDieSound('Baaaaaah... x_x');
    }
}
