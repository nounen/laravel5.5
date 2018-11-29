<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * eg: `php artisan curd:make_views Admin/RolePermission`
 * Class CurdMakeViews
 * @package App\Console\Commands
 */
class CurdMakeViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curd:make_views {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CURD 通用视图生成';

    protected $views = [
        'index.blade.php',
        'create.blade.php',
        'edit.blade.php',
        'show.blade.php',
    ];

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
        $nameArr = explode('/', $name);
        $dirName = strtolower(reset($nameArr));
        $modelName = snake_case(end($nameArr));
        $viewPath = resource_path() . "/views/{$dirName}/$modelName";

        $this->makeDir($viewPath);

        foreach ($this->views as $view) {
            $path = "{$viewPath}/{$view}";
            $this->makeView($view, $path);
        }
    }

    protected function makeDir($viewPath)
    {
        if (! file_exists($viewPath)) {
            mkdir($viewPath);
        }
    }

    protected function makeView($view, $path)
    {
        if (file_exists($path)) {
            $this->error("{$view} already exists!");
            return ;
        }

        // 生成新模板
        $content = file_get_contents(__DIR__."/stubs/views.{$view}");
        if ($content) {
            file_put_contents($path, $content);
        }
    }
}
