<?php
require 'entities/soldier.php';
require 'entities/army.php';
require 'events/battle.php';

// Initializing two armies, number of soldiers for each comes from a GET request
$army1 = new Army($_GET["army1"]);
$army2 = new Army($_GET["army2"]);

// Start the battle
startBattle($army1, $army2);
