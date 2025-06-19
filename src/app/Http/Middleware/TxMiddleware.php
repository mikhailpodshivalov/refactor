<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Middleware implements work with transactions. Start a transaction for transferred database connections,
 * commit or roll it back automatically.
 */
class TxMiddleware
{
    /**
     * Processing a request using transactions
     *
     * @param Request $request
     * @param Closure $next
     * @param string  ...$connections
     *
     * @return mixed
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next, string ...$connections): mixed
    {
        $connections = !empty($connections) ? $connections : [Config::get('database.default')];

        $callback = fn() => $next($request);
        foreach ($connections as $connection) {
            $callback = fn() => DB::connection($connection)->transaction(fn() => $callback());
        }

        return $callback();
    }
}
