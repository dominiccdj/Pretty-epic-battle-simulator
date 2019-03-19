<?php

require_once 'entities/army.php';

/*
   Functions for a successful battle against two armies
*/

// Starts battle between two armies passed as arguments
function startBattle(Army $army1, Army $army2)
{
    // Counting moves during battle
    $movesCounter = 0;

    // Display the initial stats of two opposing armies
    echo "Battle is starting!<br><br>";
    $army1->printArmyStats();
    $army2->printArmyStats();
    echo "<hr>";

    // Battle must be going until all soldiers of one army are dead (Army health == 0)
    // After an attack, each of the armies stats are displayed
    while ($army1->getHealth() > 0 && $army2->getHealth() > 0) {

        // Army 1 attacks army 2 first
        echo "<br>MOVE NO: " . ++$movesCounter . "<br><br>";
        echo "Army 1 attacked army 2<br><br>";

        $army1->attack($army2);
        $army1->printArmyStats();
        $army2->printArmyStats();
        echo "<hr>";


        // Army 2 attacks army 1 afterwards
        // If statement checks if army 1 has won on the move before this
        if ($army1->getHealth() > 0 && $army2->getHealth() > 0) {
            echo "<br>MOVE NO: " . ++$movesCounter . "<br><br>";
            echo "Army 2 attacked army 1<br><br>";

            $army2->attack($army1);
            $army1->printArmyStats();
            $army2->printArmyStats();
            echo "<hr>";
        }
    }

    // Display the battle results after it's done
    battleResults($army1, $army2, $movesCounter);
}

// Prints results of the battle, results vary depending on which army has won
function battleResults(Army $army1, Army $army2, $moves)
{

    // If the army 1 is still alive, it has won the battle, otherwise army 2 has won
    if ($army1->getHealth() > 0) {
        $winnerArmy = $army1;
        echo "<br>### ARMY 1 HAS WON! ###<br><br>";
    } elseif ($army2->getHealth() > 0) {
        $winnerArmy = $army2;
        echo "<br>### ARMY 2 HAS WON! ###<br><br>";
    }

    echo "Remaining HP left in the army: " . $winnerArmy->getHealth() . "<br>";

    // Count alive soldiers and display them
    $aliveSoldiers = 0;
    foreach ($winnerArmy->getSoldiers() as $soldier) {
        if ($soldier->isAlive()) {
            $aliveSoldiers++;
        }
    }
    echo "Remaining soldiers alive in the army: " . $aliveSoldiers . "<br>";

    // Display how many moves(from argument) has the battle lasted
    echo "<br>Battle lasted " . $moves . " moves <br>";
    echo "<br>#########################<br>";
}
