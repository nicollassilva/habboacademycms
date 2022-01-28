<?php

namespace App\Console\Commands\Academy;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Optimize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'academy:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esse comando irá limpar o cache da sua aplicação, útil após alterações em arquivos de configuração';

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
        Artisan::call('optimize:clear');

        $this->info('Cache da aplicação excluídos e arquivos de configurações recarregados.');
    }
}
