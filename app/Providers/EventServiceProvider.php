<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\ResetPasswordChangedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Event;
use Modules\Orders\src\Events\OrderStatusChanged;
use Modules\Courses\src\Listeners\RevokeStudentCourseAccess;
use Modules\Orders\src\Events\OrderRefunded;
use Modules\Orders\src\Listeners\SendOrderRefundedNotification;
use Modules\Orders\src\Events\OrderPaid;
use Modules\Orders\src\Listeners\SendOrderPaidNotification;
use Modules\Orders\src\Events\AdminOrderCancel;
use Modules\Orders\src\Listeners\AdminSendCancelledNotification;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PasswordReset::class => [
            ResetPasswordChangedListener::class,
        ],

        OrderStatusChanged::class => [
            RevokeStudentCourseAccess::class,
        ],
        OrderPaid::class => [
            SendOrderPaidNotification::class,
        ],
        OrderRefunded::class => [
            SendOrderRefundedNotification::class,
        ],
        AdminOrderCancel::class => [
            AdminSendCancelledNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
