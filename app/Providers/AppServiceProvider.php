<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use App\Models\Partenaire;
use App\Observers\PartenaireObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Ici tu peux enregistrer d'autres services si nécessaire
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Partenaire::observe(PartenaireObserver::class);
        // Partager les notifications avec toutes les vues
        View::composer('*', function ($view) {
            $notifications = Notification::with('evenement')
                ->orderBy('date', 'desc')
                ->take(10) // afficher les 10 dernières notifications
                ->get();

            $view->with('notifications', $notifications);
        });
    }
}
