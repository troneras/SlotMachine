<?php 

namespace App\Models;

use App\Models\{Board, Line, Symbol};

class SlotMachine
{
	// this should go to a configuration file or fetched from a DDBB
	private static $ROWS = 3; // Configuration of this slot machine
	private static $COLS = 5; // Configuration of this slot machine

	private $board; // The board with the Symbols
	private $bet_amount; // The amount the user bets

	function __construct($bet_amount,$testing= false)
	{
		if (!$testing) {
			$this->board = new Board(static::$ROWS,static::$COLS, false);
			$this->bet_amount = $bet_amount;
		}
	}

	// ONLY TESTING: For testing with a prepopulated symbol list
	public static function constructFromBoard($board, $bet_amount)
	{
		$instance = new self($bet_amount, true );
		$instance->bet_amount = $bet_amount;
		$instance->board = $board;
		return $instance;
	}

	/*
	*  This method could be used for if the state was kept
	*/
	public function playGame()
	{
		$this->board = new Board(static::$ROWS,static::$COLS, false);
		return (string)$this;
	}

	public function getBoard()
	{
		return  $this->board;
	}

	public function getBetAmount()
	{
		return $this->bet_amount;
	}

	public function getTotalWin()
	{	
		$totalWin = 0;
		foreach ($this->board->getPayLines() as $payline) {
			$totalWin += $payline->getPayout($this->bet_amount);
		}
		return $totalWin;
	}

	public function getPaylines()
	{
		$output = array_map(function($line)
		{
			return $line->toArray();
		}, $this->board->getPaylines());

		return array_values($output);
	}

	public function __toString()
	{
		$output = [];
		$output['board'] = (string)$this->getBoard();
		$output['paylines'] = $this->getPaylines();
		$output['bet_amount'] = $this->getBetAmount();
		$output['total_win'] = $this->getTotalWin();

		return json_encode($output, JSON_PRETTY_PRINT );	
	}
}