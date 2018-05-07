<?php 

namespace App\Models;

/**
*  This class keeps track of the instantiated symbols and only creates new ones if they don't already exists
*/
class SymbolContainer
{
	// this should go to a configuration file or fetched from a DDBB
	private static $AVAILABLE_SYMBOLS = ['9', '10', 'J', 'Q', 'K' ,'A', 'cat', 'dog', 'monkey', 'bird'];
	private static $symbols = [];

	// This class should not be instantiated
	private function __construct()
	{}

	/*
	*  Checks if the symbol name already exists and return a new instance or an existing one
	*/
	static function getSymbol($name='')
	{
		if(!array_key_exists($name, static::$symbols)){
			static::$symbols[$name] = new Symbol($name);
		}
		return static::$symbols[$name];
	}

	/*
	* Returns a random new symbol from the list of available ones
	*/
	static function getRandomSymbol()
	{
		return static::getSymbol(static::$AVAILABLE_SYMBOLS[rand(0,9)]);
	}

	static function getAvailableSymbols(){
		return static::$AVAILABLE_SYMBOLS;
	}

	// This class should not be cloned
	function __clone()
	{
	}
}