<?php

require 'autoload.php';
require 'printHelpers.php';

$leftFighter  = new \PetWars\Fighters\Kitten('Molly');
$rightFighter = new \PetWars\Fighters\Puppy('Buddy');
$fight        = new \PetWars\Arena\Fight($leftFighter, $rightFighter);


/**
 * Simple presentation of the fight.
 */
printHeader($fight);

while (!$fight->isGameOver()) {
    printMovePrefix($fight);
    $fight->makeNextMove();
    newline();
}

printGameOverSection($fight);
