<?php

namespace App\Console\Commands\Academy;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LocalRunner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'academy:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicia o projeto';

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
        $this->info('Iniciando servidor, acesse: ' . getenv('APP_URL'));

        Artisan::call('serve --port=80');

    }
}
