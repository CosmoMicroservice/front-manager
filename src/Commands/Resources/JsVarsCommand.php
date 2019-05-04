<?php

	namespace Kosmosx\Frontend\Commands\Resources;

	use Kosmosx\Frontend\Commands\CommandProcessor;
	use Kosmosx\Frontend\Commands\CommandsInterface;

	class JsVarsCommand extends CommandProcessor implements CommandsInterface
	{
		protected $vars = array();

		public function get(?string $get = null): ?string
		{
			if (null == $this->variable)
				return null;

			$property = "type=\"text/javascript\"";

			if (null != $name && array_key_exists($name, $this->variable)) {
				$variable['name'] = $name;
				$variable['content'] = json_encode($this->variable[$name], JSON_FORCE_OBJECT);
			}
			else {
				$variable['name'] = env('JS_VARIABLE', 'JS_LARAVEL');
				$variable['content'] = json_encode($this->variable, JSON_FORCE_OBJECT);
			}

			$content = "var " . $variable['name'] . " = " . $variable['content'] . ";";
			unset($variable);

			$output = $this->templateProcessor('script', $property, $content);

			return $output ?: null;
		}

		public function add($variable, string $name = null)
		{
			if (is_array($variable) && $name == null)
				$this->variable = array_merge($this->variable, $variable);
			else
				$this->variable[$name] = $variable;

			return $this;
		}

		/**
		 * @param string $context
		 * @param string|null $name
		 * @return bool
		 */
		public function has(string $context, ?string $name = null): bool
		{
			return $this->exist($this->vars,$context, $name = null);
		}

		/**
		 * @param string $context
		 * @param string|null $name
		 * @return bool
		 */
		public function forget(string $context, ?string $name = null): bool
		{
			return $this->delete($this->vars,$context, $name = null);
		}
	}