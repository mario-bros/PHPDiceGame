<?php
class Player 
{
	private $name;
	public $diceCollections = [];
    public $dicesBuffer = [];
    var $dice;

	public function Player($name = '')
	{
		$this->name = $name;
        $this->dice = new Dice();
    }

	public function setDice($diceCount) 
	{
		for ($i = 0; $i < $diceCount; $i++) {
			$this->diceCollections[] = $this->dice->setDice();
		}
    }

	public function getName() 
	{
        return $this->name;
    }

	public function setName($name) 
	{
        $this->name = $name;
    }

	public function rollDice()
	{
        foreach ($this->diceCollections as $idx => $collection) {
            $this->diceCollections[$idx] = $this->dice->setDice();
        }
    }

	public function removeDices($exceptionNumber)
	{
		// 5. All dice with number 6 on top side will be
        foreach ( $this->diceCollections as $idx => $diceNumber ) {
			if ($diceNumber == $exceptionNumber) {
				// removed from their dice cup.
				$this->removeDiceCollection($idx);
			}
		}
    }
	
	public function shiftDicesByNumber($number)
	{
        foreach ( $this->diceCollections as $idx => $diceNumber ) {

            if ( $diceNumber == $number ) {
                $this->dicesBuffer[] = $number;
                $this->removeDiceCollection($idx);
            }
        }
    }

	public function emptiedDicesBuffer()
	{
        $this->dicesBuffer = [];
	}
	
	public function addDiceCollection($collectedDices)
	{
		foreach ($collectedDices as $diceNumber) {
			$this->diceCollections[] = $diceNumber;
		}
    }
	
	public function removeDiceCollection($index)
	{
        unset( $this->diceCollections[$index] );
    }
}

?>