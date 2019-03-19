<?php

require_once 'soldier.php';

/* 
   Entity based on Soldier which fights in a battle for the army
   
   Has variables: 
   alive(inherited, boolean, is soldier alive or not)
   health(inherited, integer, health value of the soldier)
   attackDamage(inherited, integer, attack damage value of the soldier)

   Sniper has doubled Soldier's attack damage value
*/

class Sniper extends Soldier
{
    // Constructor for the Sniper class
    function __construct()
    {
        parent::__construct();
        $this->atrackDamage = 50;
    }

    // Prints sniper's health
    public function printStats($n = 0)
    {
        echo "Sniper HP = " . $this->getHealth() . "<br>";
    }
}
