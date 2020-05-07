<?php


namespace Ilma\Ecosystem\Services\UserService\Jobs\Notifications;

use Ilma\Ecosystem\Services\UserService\Models\UserModel;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ilma\Ecosystem\Services\UserService\ServiceInterface as UserService;

class CreatedJob  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var UserModel
     */
    public $model;

    /**
     * Create a new job instance.
     *
     * @param UserModel $model
     */
    public function __construct(UserModel $model)
    {
        $this->queue = 'auth-notifications-user';

        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $service = $this->getUserService();
        $service->createFromModel($this->model);
    }

    /**
     * @return UserService
     * @throws BindingResolutionException
     */
    private function getUserService(): UserService
    {
        return app()->make(UserService::class);
    }
}
