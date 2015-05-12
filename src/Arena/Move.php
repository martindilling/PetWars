<?php namespace PetWars\Arena;

use PetWars\Fighters\FighterInterface;

class Move
{
    const HIT  = 1;
    const MISS = 2;

    /**
     * @var FighterInterface
     */
    protected $attacker;

    /**
     * @var FighterInterface
     */
    protected $victim;

    /**
     * @var int
     */
    protected $action;

    /**
     * @var int
     */
    protected $damage;

    /**
     * @param FighterInterface $attacker
     * @param FighterInterface $victim
     */
    public function __construct(FighterInterface $attacker, FighterInterface $victim)
    {
        $this->attacker = $attacker;
        $this->victim   = $victim;

        $this->execute();
    }

    /**
     * @return \PetWars\Fighters\FighterInterface
     */
    public function getAttacker()
    {
        return $this->attacker;
    }

    /**
     * @return \PetWars\Fighters\FighterInterface
     */
    public function getVictim()
    {
        return $this->victim;
    }

    /**
     * @return int
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @return void
     */
    protected function execute()
    {
        if (mt_rand(1, 2) === 1) {
            $this->hit();
        } else {
            $this->miss();
        }
    }

    /**
     * @return void
     */
    protected function hit()
    {
        $this->action = self::HIT;
        $this->damage = $this->victim->getDamageHit();
    }

    /**
     * @return void
     */
    protected function miss()
    {
        $this->action = self::MISS;
        $this->damage = 0;
    }
}
