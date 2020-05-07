<?php
/** @noinspection PhpUnused */


namespace Ilma\Ecosystem\Services\JwtService\Jobs\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ilma\Ecosystem\Services\JwtService\ServiceInterface as JwtService;

class InvalidatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public $token;

    /**
     * Create a new job instance.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->queue = 'auth-notifications-jwt';

        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $this->getService()->invalidateToken($this->token);
    }

    /**]
     * @return JwtService
     * @throws BindingResolutionException
     */
    private function getService(): JwtService
    {
        return app()->make(JwtService::class);
    }
}
