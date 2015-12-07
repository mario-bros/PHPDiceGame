<?php
class Dice
{
    public $sides = 6;

	public function Dice($sides = 6)
	{
		$this->sides = $sides;
    }

	public function setDice()
	{
		return rand(1, $this->sides);
    }
}

?>