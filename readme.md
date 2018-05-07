# SIMPLE COMMAND LINE SLOT MACHINE  
  
The slot machine has been divided in the following Models:  
* Symbol -> represents a single symbol  
* SymbolContainer -> symbol factory, reuses previously created symbols  
* Board -> represents the playing board  
* Line -> represents a board line and keeps the logic related to Pay Lines  
* SlotMachine -> this is the top level Model  
  
Tests have been developed covering possible failure points, you can find them under ```app/tests/SlotMachineTest.php```:  
- testPrizeIsZeroWhenZeroPaylines  
- testThirdPrice  
- testSecondPrice  
- testFirstPrice  
- testWhenTwoLinesWithPrize  
- testWhenThreeLinesWithPrize  
  
1. Install proyect dependencies:  
```  
composer install  
```  
  
2. To run the tests under ```app/tests/SlotMachineTest.php``` run:  
```  
./vendor/bin/phpunit  
```  
you should see an outpul similar to 
```
$ ./vendor/bin/phpunit
PHPUnit 7.1.5 by Sebastian Bergmann and contributors.

......                                                              6 / 6 (100%)

Time: 111 ms, Memory: 4.00MB

OK (6 tests, 18 assertions)

```
3. To run the slot machine simply run the following command from a terminal:  
```  
php artisan slot:run  
```
You should see a JSON output similar to: 
```json
{
    "board": "[10, Q, Q, 10, J, cat, A, cat, dog, J, A, Q, bird, 9, monkey]",
    "paylines": [],
    "bet_amount": 100,
    "total_win": 0
}

```