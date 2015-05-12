<?php namespace PetWars\Fighters;

interface FighterInterface
{
    /**
     * @param string $name
     */
    public function __construct($name);

    /**
     * @param \PetWars\Fighters\FighterInterface $opponent
     *
     * @return bool
     */
    public function attack(FighterInterface $opponent);

    /**
     * @param int $hitPoints
     *
     * @return bool
     */
    public function takeDamage($hitPoints);

    /**
     * @return bool
     */
    public function hasSounds();

    /**
     * @return null|true
     */
    public function playSounds();

    /**
     * @return bool
     */
    public function isDead();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getSpecies();

    /**
     * @return int
     */
    public function getHealth();

    /**
     * @return int
     */
    public function getDamageHit();
}
