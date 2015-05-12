<?php namespace PetWars\Fighters;

use PetWars\Sounds\hasSoundQueue;
use PetWars\Sounds\PrintSound;

abstract class Fighter
{
    use hasSoundQueue;

    /**
     * @var bool
     */
    protected $dead = false;

    /**
     * @var string
     */
    protected $species;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $health;

    /**
     * @var int
     */
    protected $damageHit;

    /**
     * @var \PetWars\Sounds\SoundInterface
     */
    protected $hurtSound;

    /**
     * @var \PetWars\Sounds\SoundInterface
     */
    protected $dieSound;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param \PetWars\Fighters\FighterInterface $opponent
     *
     * @return bool
     */
    public function attack(FighterInterface $opponent)
    {
        return $opponent->takeDamage($opponent->getDamageHit());
    }

    /**
     * @param int $hitPoints
     *
     * @return bool
     */
    public function takeDamage($hitPoints)
    {
        if ($this->isDead()) {
            return false;
        }

        $this->queueHurtSound();
        $this->reduceHealth($hitPoints);

        return true;
    }

    /**
     * @return bool
     */
    public function isDead()
    {
        return $this->dead;
    }

    /**
     * @return string
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getDamageHit()
    {
        return $this->damageHit;
    }

    /**
     * @param int $hitPoints
     * @return void
     */
    protected function reduceHealth($hitPoints)
    {
        $this->health = $this->health - $hitPoints;

        if ($this->shouldDie()) {
            $this->dies();
        }
    }


    /**
     * @return bool
     */
    protected function shouldDie()
    {
        if ($this->health <= 0) {
            return true;
        }

        return false;
    }

    /**
     * @return void
     */
    protected function dies()
    {
        $this->queueDieSound();

        $this->dead = true;
    }

    /**
     * @return void
     */
    protected function queueHurtSound()
    {
        $this->queueSound($this->hurtSound);
    }

    /**
     * @return void
     */
    protected function queueDieSound()
    {
        $this->queueSound($this->dieSound);;
    }

    /**
     * @param string $species
     * @return void
     */
    protected function setSpecies($species)
    {
        $this->species = $species;
    }

    /**
     * @param int $health
     * @return void
     */
    protected function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @param int $damageHit
     * @return void
     */
    protected function setDamageHit($damageHit)
    {
        $this->damageHit = $damageHit;
    }

    /**
     * @param string $hurtSound
     * @return void
     */
    protected function setHurtSound($hurtSound)
    {
        $this->hurtSound = new PrintSound($hurtSound);
    }

    /**
     * @param string $dieSound
     * @return void
     */
    protected function setDieSound($dieSound)
    {
        $this->dieSound = new PrintSound($dieSound);
    }
}
