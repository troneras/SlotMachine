<?php 
	namespace App\Models;
	/**
	* 	Represents a slot machine symbol 
	*/
	class Symbol 
	{
		private $name;

		function __construct($name)
		{
			$this->name = $name;
		}

		public function getName()
		{
			return $this->name;
		}

		// If one symbol is equal to another, in this case is the same as == 
		public function equals($other)
		{
			if (is_null($other)) {
				return false;
			}
			return $this->name == $other->getName();
		}

		public function jsonSerialize()
		{
			return $this->name;
		}
		public function __toString()
		{
			return $this->name;
		}
	}