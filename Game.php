<?php
class Game 
{
	private $finishState = false;
	private $registeredPlayers = [];
	public $exceptionNumber = 6;
	
    public function Game($playerInstances) 
	{	
		// 2. Each player will have
		foreach ($playerInstances as $player) {
			
			// 6 dice in their dice up.
			$player->setDice(6);
			$this->registeredPlayers[] = $player;
		}
    }

    public function start() 
	{
		$winnerFound = 0;
		$round = 0;
		while ($this->finishState == false) {
			
			// 3. Each round all players will roll their
			$round++;
			$this->_outputStartRound($round);
			
			// dice at the same time.
			foreach ($this->registeredPlayers as $player) {
				$player->rollDice();
			}
			$this->_outputResultAfterRolled();
			
			// 4. All dice with
            $i = 0;
			while ( $i < count($this->registeredPlayers) ) {
				
				$this->registeredPlayers[$i]->removeDices($this->exceptionNumber);
				
				// number 1 on top side will be passed to player on his right hand (the right most player will pass the dice to left most player)
                if ($i == 0) {
                    $this->registeredPlayers[$i]->shiftDicesByNumber(1);
                }

				
				if ( $i == (count($this->registeredPlayers) - 1) ) {
					$assignedPlayerIndex = 0;
				} else {
					$assignedPlayerIndex = $i + 1;
                    $this->registeredPlayers[$assignedPlayerIndex]->shiftDicesByNumber(1);
				}

                $this->registeredPlayers[$assignedPlayerIndex]->addDiceCollection($this->registeredPlayers[$i]->dicesBuffer);
                $this->registeredPlayers[$i]->emptiedDicesBuffer();

				$i++;
			}
			$this->_outputResultAfterMoved();


			//check how many winner come at last
			foreach ($this->registeredPlayers as $player) {
				if ( empty($player->diceCollections) ) $winnerFound++;
			}

			if ($winnerFound > 0) $this->finishState = true;
		}

		$this->finish();
    }

    public function finish() 
	{
        echo '<br/><br/>';
		foreach ($this->registeredPlayers as $player) {
			if ( empty($player->diceCollections) ) echo $player->getName() . ' win! <br/><br/>';
		}
		exit(' FINISH ');
    }

	private function _outputStartRound($round) 
	{
		echo '<br/><br/><B>ROUND ' . $round . '<B><br/><br/>';
        
    }
	
	private function _outputResultAfterRolled() 
	{
        echo '<u>After dice rolled :<u> <br/>';
		
		$this->_print_player_results();

		echo '<br/><br/><br/>';
    }
	
	private function _outputResultAfterMoved()
	{
        echo '<u>After dice moved / removed :<u> <br/>';
		
		$this->_print_player_results();
    }
	
	private function _print_player_results()
	{
		foreach ($this->registeredPlayers as $player) {
			
			$diceCollectionStrings = '';
			$totalCollections = count($player->diceCollections);
			$i = 1;
			foreach ($player->diceCollections as $diceCollection) {

				if ($i == $totalCollections)
					$diceCollectionStrings .= $diceCollection;
				else
					$diceCollectionStrings .= $diceCollection . ', ';

				$i++;
			}

			echo $player->getName() . ': ' . $diceCollectionStrings . '<br/>';
		}
    }
}
?>