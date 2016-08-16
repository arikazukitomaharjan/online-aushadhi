<?php

    namespace App\Providers;

    use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
    use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

    class EventServiceProvider extends ServiceProvider
    {

        /**
         * The event listener mappings for the application.
         *
         * @var array
         */
        protected $listen = [
            'App\Events\RegistrationEvent'             => [
                'App\Listeners\RegistrationListner'
            ] ,
            'App\Events\ResetPasswordEvent'            => [
                'App\Listeners\ResetPasswordListner'
            ] ,
            'App\Events\LoginNotificationEvent'        => [
                'App\Listeners\LoginNotificationListener'
            ] ,
            'App\Events\ExpiryDateNotificationEvent'   => [
                'App\Listeners\ExpiryDateNotificationListener'
            ] , 'App\Events\DeliveredNotificationEvent' => [
                'App\Listeners\DeliveredNotificationListener'
            ] ,
            'App\Events\NotifyEveryMinuteEvent'        => [
                'App\Listeners\NotifyEveryMinuteListener'
            ] ,
            'App\Events\LogoutNotificationEvent'       => [
                'App\Listeners\LogoutNotificationListener'
            ]

        ];





        /**
         * Register any other events for your application.
         *
         * @param  \Illuminate\Contracts\Events\Dispatcher $events
         *
         * @return void
         */
        public function boot(DispatcherContract $events)
        {

            parent::boot($events);

            //
        }
    }
