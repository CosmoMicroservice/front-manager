<?php

	namespace Kosmosx\Frontend\Commands\Parent;

	use Kosmosx\Frontend\Services\Interfaces\FrontendServiceInterface;

	class Commands
	{
		protected $processor;

		public function __construct(FrontendServiceInterface &$processor) {
			$this->processor = $processor;
		}
	}