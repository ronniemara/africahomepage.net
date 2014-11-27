<?php

namespace Myapp\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of RepositoriesServiceProvider
 *
 * @author ron
 */
class RepositoriesServiceProvider extends ServiceProvider {

    //put your code here
    public function register() {
        \App::bind('\Myapp\Repositories\PostRepositoryInterface', function() {
            return new \Myapp\Repositories\EloquentPostRepository(new \Post);
        });
        
        \App::bind('\Myapp\Repositories\TagRepositoryInterface', function() {
            return new \Myapp\Repositories\EloquentTagRepository();
        });
    }

}

