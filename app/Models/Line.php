<?php 

namespace App\Models;
/**
* 
*/
class Line 
{
	private $payline = [];
	private $top_symbol;

	// this should go to a configuration file or fetched from a DDBB
	private static $PAYOUT_RULES = [
		3 => 0.2,  // if 3 equal symbols then pay 20%
		4 => 2,	   // if 4 equal symbols then pay 200%
		5 => 10    // if 5 equal symbols then pay 1000%
	];
	
	function __construct($symbols = [])
	{
		$this->payline = $symbols;
		$this->consecutive_symbols = $this->calculateHits();
	}

	/* 
	* Calculates the number of ocurrences of the most repeated symbol in the line
	*/
	private function calculateHits()
	{
		$symbol_names = array_map(function ($symbol){ return (string) $symbol; }, $this->payline);
		$hits = array_count_values($symbol_names);
		return max($hits);
	}

	/*
	* @returns if the line is a PayLine or not (if at least has a prize)
	*/
	public function isPayLine()
	{		
		return $this->consecutive_symbols >= min(array_keys(static::$PAYOUT_RULES));
	}

	/*
	* @returns calculates the payout based on the bet size and payout rule
	*/
	public function getPayout($bet)
	{		
		return (int) ($bet * static::$PAYOUT_RULES[$this->consecutive_symbols]);
	}

	public function getPayline()
	{
		return $this->payline;
	}

	public function toArray()
	{
		$output = [];
		foreach ($this->payline as $key => $symbol) {
			$output[] = (string)$symbol;
		}
		return $output;
	}
	public function jsonSerialize()
	{
		return $this->payline;
	}
	public function __toString()
	{
		return '['.implode(', ', $this->payline).']';
	}

}