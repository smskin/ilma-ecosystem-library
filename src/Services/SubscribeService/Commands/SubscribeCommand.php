<?php


namespace Ilma\Ecosystem\Services\SubscribeService\Commands;

use Ilma\Ecosystem\Services\SubscribeService\ServiceInterface as SubscribeService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;

class SubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecosystem:auth:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @throws BindingResolutionException
     */
    public function handle(): void
    {
        $service = $this->getSubscribeService();
        $service->subscribe();
    }

    /**
     * @return SubscribeService
     * @throws BindingResolutionException
     */
    private function getSubscribeService(): SubscribeService
    {
        return app()->make(SubscribeService::class);
    }
}
