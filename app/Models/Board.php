<?php 

namespace App\Models;
/**
* 
*/
class Board
{
	private $board = []; 
	private $rows, $columns;
	private $paylines; // The lines with prize

	function __construct($rows, $columns, $testing = false)
	{		
		if (!$testing) {			
			$this->rows = $rows;
			$this->columns = $columns;
			for ($i=0; $i < $rows*$columns; $i++) { 
				$this->board[] = SymbolContainer::getRandomSymbol();
			}
			$this->paylines = $this->calculatePaylines();
		}
	}

	// ONLY TESTING: For testing with a prepopulated symbol list
	public static function constructFromBoard($rows, $columns, $board)
	{
		$instance = new self($rows,$columns,true);
		$instance->rows = $rows;
		$instance->columns = $columns;
		$instance->board = $board;
		$instance->paylines = $instance->calculatePaylines();
		return $instance;
	}

	/*
	* Calculates the paylines based on the generated board
	*/
	private function calculatePaylines()
	{
		$rows = $this->getRows();

		$paylines = array_map(function($payline)
		{
			return new Line($payline);
		}, $rows);
		$paylines = array_filter($paylines, function ($line)
		{
			return $line->isPayLine($line);
		});
		return $paylines;
	}

	public function getPaylines()
	{
		return $this->paylines;
	}

	/*
	* @returns the board splited in rows
	*/
	public function getRows()
	{
		return array_chunk($this->board, $this->columns, true);
	}

	public function __toString()
	{
		return '['.implode(', ', $this->board).']';
	}

}