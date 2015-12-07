<?php

include_once 'Game.php';
include_once 'Player.php';
include_once 'Dice.php';

class Main
{
    public function start() 
	{
		// 1. The game contains
		$playerA = new Player('Player A');
		$playerB = new Player('Player B');
		$playerC = new Player('Player C');
		$playerD = new Player('Player D');
		
		// 4 players. 
		$playerInstances = [$playerA, $playerB, $playerC, $playerD];
			
		$game = new Game($playerInstances);
		$game->start();
    }
}

$main = new Main();
$main->start();
?>