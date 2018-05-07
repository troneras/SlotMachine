<?php 
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use App\Models\SlotMachine;

class SlotCommand extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'slot:run';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Small part of a simulated slot machine using Lumen";
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info( new SlotMachine(100) );        
    }
}