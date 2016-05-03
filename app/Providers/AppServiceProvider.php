<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Question;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Question::creating(function ($question) {
                $user_id = \Auth::user()->id;
                $question->createdby = $user_id;
                $question->modifiedby = $user_id;

        });

        Question::updating(function ($question) {
                $user_id = \Auth::user()->id;
                $question->modifiedby = $user_id;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
