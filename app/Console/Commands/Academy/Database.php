<?php

namespace App\Console\Commands\Academy;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Database extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'academy:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exclui a database atual com todos os dados e recria com os valores padrões.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!$this->confirm('Isso irá apagar toda seus registros e adicionar somente os padrões, deseja continuar?', false)) {
            $this->warn('Comando não executado.');
        }

        Artisan::call('migrate:fresh --seed');

        $this->info('Database resetada!');
    }
}
