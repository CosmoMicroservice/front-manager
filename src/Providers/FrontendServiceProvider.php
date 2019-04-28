<?php

	namespace Kosmosx\Frontend\Providers;

	use Illuminate\Support\ServiceProvider;

	class FrontendServiceProvider extends ServiceProvider
	{
		/**
		 * Register any application services.
		 *
		 * @return void
		 */
		public function register()
		{
			$this->registerAlias();
			$this->registerServices();
		}
		/**
		 * Load alias
		 */
		protected function registerAlias()
		{
			class_alias(\Kosmosx\Frontend\Services\ResourcesService::class, 'ResourcesService');
			class_alias(\Kosmosx\Frontend\Services\MetatagService::class, 'MetatagService');
		}
		/**
		 * Register Services
		 */
		protected function registerServices()
		{
			/**
			 * Service Response
			 */
			$this->app->singleton('service.resources', 'Kosmosx\Frontend\Services\ResourcesService');
			$this->app->singleton('service.metatag', 'Kosmosx\Frontend\Services\MetatagService');
			$this->app->singleton('factory.manager', 'Kosmosx\Frontend\Factory\ManagerFactory');
		}
	}