<?php

namespace App\Console\Commands\Academy;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Commands extends Command
{
    protected $commands = [
        ['academy:list', 'Lista todos os comandos da CMS'],
        ['academy:database', 'Exclui a database atual com todos os dados e recria com os valores padrões.'],
        ['academy:config', 'Esse comando irá limpar o cache da sua aplicação, útil após alterações em arquivos de configuração'],
        ['academy:run', 'Inicia o projeto']
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'academy:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lista todos os comandos da CMS';

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
        $this->info('Listando comandos da CMS:');

        return $this->table(['Comando', 'Descrição'], $this->commands);
    }
}
