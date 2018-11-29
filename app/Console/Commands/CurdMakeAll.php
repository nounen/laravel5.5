<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * eg: `php artisan curd:make_all RolePermission`
 * Class CurdMakeAll
 * @package App\Console\Commands
 */
class CurdMakeAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curd:make_all {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成 model modelTrait controller request repository views';

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
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $dirAndName = "Admin/{$name}";

        $this->call("curd:make_model", ["name" => $name]);
        $this->call("curd:make_model_trait", ["name" => "{$name}Trait"]);
        $this->call("curd:make_controller", ["name" => "{$dirAndName}Controller"] );
        $this->call("curd:make_repository",  ["name" => "{$dirAndName}Repository"]);
        $this->call("curd:make_request",  ["name" => "{$dirAndName}Request"]);
    }
}
