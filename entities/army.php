<?php

require_once 'soldier.php';

/*
   Entity which can participate in a battle against other army

   Has variables:
   soldiers(array, array of soldiers who fight for the army)
   health(integer, sum of all soldier's health values)

*/

class Army
{
    private $soldiers;
    private $health;

    // Constructor for the Army class
    function __construct($nOfSoldiers)
    {
        $this->soldiers = Soldier::createArrayOfSoldiers($nOfSoldiers);
        $this->health = 0;
        $this->updateHealth();
    }

    /* Attacks another army which is passed in as an argument
       in a way that random ally soldier attacks random enemy soldier */
    public function attack(Army $army2)
    {

        // Only alive soldiers can attack
        do {
            $allySoldier = $this->getRandomSoldier();
        } while ($allySoldier->isAlive() == false);

        // Attack alive enemies only
        do {
            $enemySoldier = $army2->getRandomSoldier();
        } while ($enemySoldier->isAlive() == false);

        $allySoldier->attack($enemySoldier);

        $this->updateHealth();
        $army2->updateHealth();
    }

    // Updates army's health value to a sum of soldier's health values
    public function updateHealth()
    {
        $healthSum = 0;

        foreach ($this->getSoldiers() as $soldier) {
            $healthSum += $soldier->getHealth();
        }

        $this->health = $healthSum;
    }

    // Returns array of soldiers(Army)
    public function getSoldiers()
    {
        return $this->soldiers;
    }

    // Returns health value of an 
    public function getHealth()
    {
        return $this->health;
    }

    // Returns a random soldier from the 'soldiers' array
    function getRandomSoldier()
    {
        return $this->soldiers[rand(1, count($this->soldiers))];
    }

    // Prints army's health and individual soldiers health
    public function printArmyStats()
    {
        echo "ARMY HP: " . $this->health . "<br>";
        for ($i = 1; $i < count($this->soldiers) + 1; $i++) {

            // Displaying stats for each alive soldier
            if ($this->soldiers[$i]->isAlive() == true) {
                $this->soldiers[$i]->printStats($i);
            }
        }
        echo '</div> <br>';
    }
}
