<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\Route;

class GeneratePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:generate {--model=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        $permissions = [];

        foreach ($routes as $route) {
            $name = $route->getName();

            if ($name) {
                $permissionName = str_replace(['.', ':'], ['_', '_'], $name);
                $permissions[] = [
                    'name' => $permissionName,
                    'guard_name' => 'web', // Ajuster si nécessaire
                ];
            }
        }
        Route::insert($permissions);

        $this->info('Permissions générées avec succès !');
    }
}
