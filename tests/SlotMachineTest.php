<?php

use App\Models\{SlotMachine, Board, SymbolContainer};

class SlotMachineTest extends TestCase
{
	// TEST 0: total win when 0 prizes should be 0
    public function testPrizeIsZeroWhenZeroPaylines()
    {
        $bet_amount = 100;
        $test = [
        		'slotMachine' => (string)SlotMachine::constructFromBoard($this->createTestBoard0(), $bet_amount), 
        		'paylines' => [],
        		'bet_amount' => $bet_amount,
        		'total_win' => 0
        	];
		$slotMachineResult = json_decode($test['slotMachine']);
    	$this->assertEquals(
    		$slotMachineResult->paylines, 
    		$test['paylines'] );
    	$this->assertEquals($slotMachineResult->bet_amount, $test['bet_amount']);
    	$this->assertEquals($slotMachineResult->total_win, $test['total_win']);
	}

	// TEST 1: prize when 3 Symbols are equal should be bet_amount * 0.2 	
    public function testThirdPrice($value='')
    {
        $bet_amount = 100;
        $test = 
            [
        		'slotMachine' => (string)SlotMachine::constructFromBoard($this->createTestBoard1(), $bet_amount), 
        		'paylines' => [["cat","J","cat","cat","10"]],
        		'bet_amount' => $bet_amount,
        		'total_win' => (int)($bet_amount*0.2)	
        	];
		$slotMachineResult = json_decode($test['slotMachine']);
    	$this->assertEquals(
    		$slotMachineResult->paylines, 
    		$test['paylines'] );
    	$this->assertEquals($slotMachineResult->bet_amount, $test['bet_amount']);
    	$this->assertEquals($slotMachineResult->total_win, $test['total_win']);
	}

	// TEST 2: prize when 4 Symbols are equal should be bet_amount * 2 		
    public function testSecondPrize($value='')
    {
        $bet_amount = 100;
        $test = 
            [
        		'slotMachine' => (string)SlotMachine::constructFromBoard($this->createTestBoard2(), $bet_amount), 
        		'paylines' => [["J","J","dog","J","J"]],
        		'bet_amount' => $bet_amount,
        		'total_win' => (int)($bet_amount*2)	
        	];
		$slotMachineResult = json_decode($test['slotMachine']);
    	$this->assertEquals(
    		$slotMachineResult->paylines, 
    		$test['paylines'] );
    	$this->assertEquals($slotMachineResult->bet_amount, $test['bet_amount']);
    	$this->assertEquals($slotMachineResult->total_win, $test['total_win']);
	}

	// TEST 3: prize when 5 Symbols are equal should be bet_amount * 10 		
    public function testFirstPrize($value='')
    {
        $bet_amount = 100;
        $test = 
            [
        		'slotMachine' => (string)SlotMachine::constructFromBoard($this->createTestBoard3(), $bet_amount), 
        		'paylines' => [["J","J","J","J","J"]],
        		'bet_amount' => $bet_amount,
        		'total_win' => (int)($bet_amount)*10
        	];
		$slotMachineResult = json_decode($test['slotMachine']);
    	$this->assertEquals(
    		$slotMachineResult->paylines, 
    		$test['paylines'] );
    	$this->assertEquals($slotMachineResult->bet_amount, $test['bet_amount']);
    	$this->assertEquals($slotMachineResult->total_win, $test['total_win']);
	}

	// TEST 4: 2 lines with prize		
    public function testWhenTwoLinesWithPrize($value='')
    {
        $bet_amount = 100;
        $test = 
            [
        		'slotMachine' => (string)SlotMachine::constructFromBoard($this->createTestBoard4(), $bet_amount), 
        		'paylines' => [["cat","J","dog","J","J"], ["A", "A", "cat", "bird", "A"]],
        		'bet_amount' => $bet_amount,
        		'total_win' => (int)($bet_amount*0.2)*2	
        	];
		$slotMachineResult = json_decode($test['slotMachine']);
    	$this->assertEquals(
    		$slotMachineResult->paylines, 
    		$test['paylines'] );
    	$this->assertEquals($slotMachineResult->bet_amount, $test['bet_amount']);
    	$this->assertEquals($slotMachineResult->total_win, $test['total_win']);
	}

	// TEST 5: 3 lines with prize		
    public function testWhenThreeLinesWithPrize($value='')
    {
        $bet_amount = 100;
        $test = 
            [
        		'slotMachine' => (string)SlotMachine::constructFromBoard($this->createTestBoard5(), $bet_amount), 
        		'paylines' => [["cat","J","dog","J","J"], [ "J", "J", "J", "9", "bird"], ["A", "A", "cat", "bird", "A"]],
        		'bet_amount' => $bet_amount,
        		'total_win' => (int)($bet_amount*0.2)*3	
        	];
		$slotMachineResult = json_decode($test['slotMachine']);
    	$this->assertEquals(
    		$slotMachineResult->paylines, 
    		$test['paylines'] );
    	$this->assertEquals($slotMachineResult->bet_amount, $test['bet_amount']);
    	$this->assertEquals($slotMachineResult->total_win, $test['total_win']);
	}


    private function createTestBoard0()
    {
    	/**
    	*	[bird, monkey, 9, dog, Q, 
    		 cat, J, cat, monkey, monkey,  
    		 10, A, Q, monkey,K]
    	*/
    	$board_symbols = [];
    	$testSymbols = explode(', ', 'bird, monkey, 9, dog, Q, cat, J, cat, monkey, monkey, 10, A, Q, monkey,K');
    	foreach ($testSymbols as $symbol) {
    		$board_symbols[] = SymbolContainer::getSymbol($symbol);
    	}
    	return Board::constructFromBoard(3,5, $board_symbols);
    }

    private function createTestBoard1()
    {
    	/**
    	*	[bird, monkey, 9, dog, Q, 
    		 cat, J, cat, cat, 10,  <-- cat
    		 10, A, Q, monkey,K]
    	*/
    	$board_symbols = [];
    	$testSymbols = explode(', ', 'bird, monkey, 9, dog, Q, cat, J, cat, cat, 10, 10, A, Q, monkey,K');
    	foreach ($testSymbols as $symbol) {
    		$board_symbols[] = SymbolContainer::getSymbol($symbol);
    	}
    	return Board::constructFromBoard(3,5, $board_symbols);
    }

    private function createTestBoard2()
    {
    	/**
    	*	[J, J, dog, J, J,  	<-- J
    		 A, J, J, 9, bird,
    		 A, A, cat, bird, cat]
    	*/
    	$board_symbols = [];
    	$testSymbols = explode(', ', 'J, J, dog, J, J, A, J, J, 9, bird, A, A, cat, bird, cat');
    	foreach ($testSymbols as $symbol) {
    		$board_symbols[] = SymbolContainer::getSymbol($symbol);
    	}
    	return Board::constructFromBoard(3,5, $board_symbols);
    }

    private function createTestBoard3()
    {
    	/**
    	*	[J, J, J, J, J,  	<-- J
    		 A, J, J, 9, bird,
    		 A, A, cat, bird, cat]
    	*/
    	$board_symbols = [];
    	$testSymbols = explode(', ', 'J, J, J, J, J, A, J, J, 9, bird, A, A, cat, bird, cat');
    	foreach ($testSymbols as $symbol) {
    		$board_symbols[] = SymbolContainer::getSymbol($symbol);
    	}
    	return Board::constructFromBoard(3,5, $board_symbols);
    }

    private function createTestBoard4()
    {
    	/**
    	*	[cat, J, dog, J, J,  	<-- J
    		 A, J, J, 9, bird,
    		 A, A, cat, bird, A]  <-- A
    	*/
    	$board_symbols = [];
    	$testSymbols = explode(', ', 'cat, J, dog, J, J, A, J, J, 9, bird, A, A, cat, bird, A');
    	foreach ($testSymbols as $symbol) {
    		$board_symbols[] = SymbolContainer::getSymbol($symbol);
    	}
    	return Board::constructFromBoard(3,5, $board_symbols);
    }

    private function createTestBoard5()
    {
    	/**
    	*	[cat, J, dog, J, J,  	<-- J
    		 J, J, J, 9, bird,    <--J
    		 A, A, cat, bird, A]  <-- A
    	*/
    	$board_symbols = [];
    	$testSymbols = explode(', ', 'cat, J, dog, J, J, J, J, J, 9, bird, A, A, cat, bird, A');
    	foreach ($testSymbols as $symbol) {
    		$board_symbols[] = SymbolContainer::getSymbol($symbol);
    	}
    	return Board::constructFromBoard(3,5, $board_symbols);
    }
}