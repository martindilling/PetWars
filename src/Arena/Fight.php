<?php namespace PetWars\Arena;

use PetWars\Fighters\FighterInterface;

class Fight
{
    /**
     * @var bool
     */
    protected $gameOver = false;

    /**
     * @var \PetWars\Fighters\FighterInterface
     */
    protected $leftFighter;

    /**
     * @var \PetWars\Fighters\FighterInterface
     */
    protected $rightFighter;

    /**
     * @var \PetWars\Arena\Move[]
     */
    protected $moves = [];

    /**
     * @param \PetWars\Fighters\FighterInterface $leftFighter
     * @param \PetWars\Fighters\FighterInterface $rightFighter
     */
    public function __construct(FighterInterface $leftFighter, FighterInterface $rightFighter)
    {
        $this->leftFighter  = $leftFighter;
        $this->rightFighter = $rightFighter;
    }

    /**
     * @return bool
     */
    public function makeNextMove()
    {
        if ($this->isGameOver()) {
            return false;
        }

        $move = new Move($this->nextAttacker(), $this->nextVictim());
        $this->addMove($move);

        if ($move->getAction() === Move::MISS) {
            return true;
        }

        $attacker = $move->getAttacker();
        $victim   = $move->getVictim();
        $attacker->attack($victim);
        $this->playSounds($attacker, $victim);

        if ($victim->isDead()) {
            $this->endGame();
        }

        return true;
    }

    /**
     * @return int
     */
    public function getMoveNumber()
    {
        return count($this->moves);
    }

    /**
     * @return \PetWars\Fighters\FighterInterface
     */
    public function nextAttacker()
    {
        $lastMove = $this->getLastMove();

        if (!$lastMove || ($lastMove && $lastMove->getAttacker() === $this->rightFighter)) {
            return $this->leftFighter;
        }

        return $this->rightFighter;
    }

    /**
     * @return \PetWars\Fighters\FighterInterface
     */
    public function nextVictim()
    {
        $lastMove = $this->getLastMove();

        if (!$lastMove || ($lastMove && $lastMove->getVictim() === $this->leftFighter)) {
            return $this->rightFighter;
        }

        return $this->leftFighter;
    }

    /**
     * @return \PetWars\Arena\Move
     */
    public function getLastMove()
    {
        return end($this->moves);
    }

    /**
     * @return \PetWars\Arena\Move[]
     */
    public function getMoves()
    {
        return $this->moves;
    }

    /**
     * @return bool
     */
    public function isGameOver()
    {
        return $this->gameOver;
    }

    /**
     * @return null|\PetWars\Fighters\FighterInterface
     */
    public function getWinner()
    {
        if (!$this->isGameOver()) {
            return null;
        }

        return $this->getLastMove()->getAttacker();
    }

    /**
     * @return null|\PetWars\Fighters\FighterInterface
     */
    public function getLoser()
    {
        if (!$this->isGameOver()) {
            return null;
        }

        return $this->getLastMove()->getVictim();
    }

    /**
     * @param \PetWars\Arena\Move $move
     *
     * @return void
     */
    protected function addMove(Move $move)
    {
        $this->moves[] = $move;
    }

    /**
     * @param \PetWars\Fighters\FighterInterface $attacker
     * @param \PetWars\Fighters\FighterInterface $victim
     *
     * @return void
     */
    protected function playSounds(FighterInterface $attacker, FighterInterface $victim)
    {
        if ($attacker->hasSounds()) {
            $attacker->playSounds();
        }

        if ($victim->hasSounds()) {
            $victim->playSounds();
        }
    }

    /**
     * @return void
     */
    protected function endGame()
    {
        $this->gameOver = true;
    }
}
