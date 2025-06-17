<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\RoleComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share $user with all views
        View::composer(['admin.*', 'manager.*', 'components.*'], RoleComposer::class);
    }
}