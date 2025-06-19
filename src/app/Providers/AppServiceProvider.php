<?php

namespace App\Providers;

use App\Http\Controllers\Api\PaymentsController\PaymentsController;
use App\Http\Controllers\Api\PaymentsController\PaymentsControllerInterface;
use App\Http\Middleware\TxMiddleware;
use App\Http\Middleware\ValidationMiddleware;
use App\Repositories\PaymentsRepository\PaymentsRepository;
use App\Repositories\PaymentsRepository\PaymentsRepositoryInterface;
use App\Services\PaymentService\CardPaymentProcessor;
use App\Services\PaymentService\CryptoPaymentProcessor;
use App\Validation\PaymentPayValidator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
        $this->bindServices();
        $this->bindMiddlewares();
        $this->bindControllers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }

    /**
     * Register project repositories
     *
     * @return void
     */
    protected function bindRepositories(): void
    {
        $this->app->singleton(PaymentsRepositoryInterface::class, PaymentsRepository::class);
    }

    /**
     * Register project services
     *
     * @return void
     */
    protected function bindServices(): void
    {
        $this->app->singleton(CardPaymentProcessor::class);
        $this->app->singleton(CryptoPaymentProcessor::class);
    }

    /**
     * Register controllers
     *
     * @return void
     */
    protected function bindControllers(): void
    {
        $this->app->singleton(PaymentsControllerInterface::class, PaymentsController::class);
    }

    /**
     * Register custom middlewares
     *
     * @return void
     */
    protected function bindMiddlewares(): void
    {
        $this->registerValidators();
        $this->app->singleton('tx', TxMiddleware::class);
    }

    /**
     * Register custom validation middlewares
     *
     * @return void
     */
    protected function registerValidators(): void
    {
        $this->app->singleton('validation.payment.pay', fn(Application $app) => new ValidationMiddleware(
            new PaymentPayValidator()
        ));
    }
}
