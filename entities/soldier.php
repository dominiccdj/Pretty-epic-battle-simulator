<?php

require_once 'sniper.php';

/* 
   Entity which fights in a battle for the army
   
   Has variables: 
   alive(boolean, is soldier alive or not)
   health(integer, health value of the soldier)
   attackDamage(integer, attack damage value of the soldier)
*/

class Soldier
{
    private $alive;
    private $health;
    private $attackDamage;

    // Constructor for the Soldier class
    function __construct()
    {
        $this->alive = true;
        $this->health = 100;
        $this->attackDamage = 25;
    }

    /* Soldier's attack method, reduces health of the enemy by
       it's attack damage value */
    public function attack(Soldier $soldier)
    {
        /* There is 20% chance that soldier will critical hit while attacking
           which means that its damage is doubled */
        if (mt_rand(1, 5) == 1) {
            $soldier->decreaseHealth($this->getAttackDamage() * 2);
            echo "Critical hit, damage is doubled!<br><br>";
        }

        /* There is 10% chance that the attacking soldier will step on a landmine which will
           kill him instantly */ 
        elseif (mt_rand(1, 10) == 1) {
            $this->setDead();
            echo "Step on a landmine, soldier down!<br><br>";
        }

        // If none of above have occured, regular attack will be performed
        else {
            $soldier->decreaseHealth($this->getAttackDamage());
        }

        /* If attacked soldier's health falls below zero, his alive state becomes false
           and can no longer be attacked nor can it attack enemies */
        if ($soldier->getHealth() <= 0) {
            $soldier->setDead();
        }
    }

    // Sets soldier's alive state to false and health to zero
    public function setDead()
    {
        $this->alive = false;
        $this->setHealth(0);
    }

    // Returns boolean whether a soldier is alive(true) or not (false)
    public function isAlive()
    {
        return $this->alive;
    }

    // Decreases soldier's health by value given as argument
    public function decreaseHealth($n)
    {
        $this->health -= $n;
    }

    // Returns soldier's health value
    public function getHealth()
    {
        return $this->health;
    }

    // Sets soldier's health to a values given as an argument
    public function setHealth($n)
    {
        $this->health = $n;
    }

    // Returns soldier's attack damage value
    public function getAttackDamage()
    {
        return $this->attackDamage;
    }

    // Prints soldier's health
    public function printStats()
    {
        echo "Soldier HP = " . $this->getHealth() . "<br>";
    }

    // Returns an array of soldiers (Army)
    public function createArrayOfSoldiers($n)
    {
        $arr = array();

        /* 4/5 of the army will consist of regular soldiers, the rest are snipers
           who have double the attack damage by default */

        $nOfSnipers = round($n / 5);
        $nOfSoldiers = $n - $nOfSnipers;

        for ($i = 1; $i <= $nOfSoldiers; $i++) {
            $arr[$i] = new Soldier();
        }

        for ($i = $nOfSoldiers; $i <= $n; $i++) {
            $arr[$i] = new Sniper();
        }

        return $arr;
    }
}
