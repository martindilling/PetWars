<?php

use PetWars\Fighters\FighterInterface;


function printHeader(\PetWars\Arena\Fight $fight)
{
    echo headline($fight->nextAttacker(), $fight->nextVictim());
    echo line();
}

function printMovePrefix(\PetWars\Arena\Fight $fight)
{
    echo moveNumber($fight->getMoveNumber());
    echo pipe();
    echo turn($fight->nextAttacker(), $fight->nextVictim());
    echo pipe();
}

function printGameOverSection(\PetWars\Arena\Fight $fight)
{
    echo line();
    echo gameOver();
    echo newline();
    echo status('winner', $fight->getWinner());
    echo newline();
    echo status('loser', $fight->getLoser());
}


function fighterIntro(FighterInterface $fighter)
{
    return sprintf(
        "%s the %s",
        $fighter->getName(), $fighter->getSpecies()
    );
}

function fighterStatus(FighterInterface $fighter)
{
    return sprintf(
        "%s (%s)",
        $fighter->getName(), $fighter->getHealth()
    );
}

function headline(FighterInterface $leftFighter, FighterInterface $rightFighter)
{
    return sprintf(
        "<h3>%s <em>vs</em> %s</h3>\n",
        fighterIntro($leftFighter), fighterIntro($rightFighter)
    );
}

function status($status, FighterInterface $fighter)
{
    return sprintf(
        "The %s is: %s",
        $status, fighterStatus($fighter)
    );
}

function turn(FighterInterface $leftFighter, FighterInterface $rightFighter)
{
    return sprintf(
        "%s attacking %s",
        $leftFighter->getName(), $rightFighter->getName()
    );
}

function moveNumber($number)
{
    echo str_pad($number, 3, '0', STR_PAD_LEFT);
}

function gameOver()
{
    echo "Game Over!";
}

function line()
{
    echo "<hr>\n";
}

function newline()
{
    echo "<br>\n";
}

function pipe()
{
    echo " | ";
}
