<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;

class CheckForMaintenanceMode {

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->app->isDownForMaintenance())
        {
            if(!in_array($request->getClientIp(), ['175.158.43.210'])){
              $maintenanceMode = new MaintenanceMode($this->app);
              return $maintenanceMode->handle($request, $next);
            }else{
              echo '<div style="text-align:center;color:red;font-size:60px">!!!Maintenance Mode!!!</div>';
            }
        }

        return $next($request);
    }

}
