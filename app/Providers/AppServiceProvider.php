<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(E_ALL & ~E_DEPRECATED);

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $categoriesWithArticles = \App\Models\Category::withCount([
                'articles' => function ($query) {
                    $query->where('status', 'published');
                }
            ])->get()->filter(function ($cat) {
                return $cat->articles_count > 0;
            });
            $companyProfile = \App\Models\CompanyProfile::first() ?? new \App\Models\CompanyProfile();
            $view->with('categoriesWithArticles', $categoriesWithArticles);
            $view->with('companyProfile', $companyProfile);
        });
    }
}
