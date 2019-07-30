<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

use App\Category;
use App\CategoryObserver;
use App\Movie;
use App\MovieObserver;
use App\Series;
use App\SeriesObserver;
use App\Product;
use App\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Movie::observe(MovieObserver::class);
        Series::observe(SeriesObserver::class);
        Product::observe(ProductObserver::class);

        Blade::directive('datetime', function($expression) {
            return "<?php echo with($expression)->format('m/d/Y H:i'); ?>";
        });

        Blade::directive('boolean_to_string', function($expression) {
            return "<?php echo ( with($expression) == true ? 'true' : 'false' ); ?>";
        });
    }

    public function register()
    {
        //
    }
}
