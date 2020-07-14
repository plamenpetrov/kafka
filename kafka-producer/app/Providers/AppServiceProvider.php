<?php

namespace App\Providers;

use App\Contracts\Producer;
use App\Services\Events\KafkaProducer;
use Illuminate\Support\ServiceProvider;
use RdKafka\Conf;
use RdKafka\Producer as RdKafkaProducer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KafkaProducer::class, function () {
            $configuration = new Conf();
            $configuration->set('metadata.broker.list', config('kafka.metadata.broker.list'));

            return new KafkaProducer(
                new RdKafkaProducer($configuration),
                (string) config('kafka.topic'),
                (int) config('kafka.max_flush_retries'),
                (int) config('kafka.timeout')
            );
        });

        $this->app->bind(Producer::class, KafkaProducer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
