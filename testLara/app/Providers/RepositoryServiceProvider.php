<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\RepoPattern\Categories\Repositories\CategoryRepository;
use App\RepoPattern\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(){

        $this->app->bind(
                        CategoryRepositoryInterface::class,
                        CategoryRepository::class
                );

            }



    }

?>