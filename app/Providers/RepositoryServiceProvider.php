<?php

namespace App\Providers;

use App\Interfaces\FeautreInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\ServiceCategoryInterface;
use App\Interfaces\ServiceInterface;
use App\Interfaces\SettingInterface;
use App\Interfaces\TestimonialInterface;
use App\Interfaces\UserInterface;
use App\Repositories\FeatureRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ServiceCategoryRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SettingRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);
        $this->app->bind(ServiceCategoryInterface::class, ServiceCategoryRepository::class);
        $this->app->bind(ServiceInterface::class, ServiceRepository::class);
        $this->app->bind(FeautreInterface::class, FeatureRepository::class);
        $this->app->bind(TestimonialInterface::class, TestimonialRepository::class);
    }
}
