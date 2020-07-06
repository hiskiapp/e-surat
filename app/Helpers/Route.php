<?php

if (!function_exists('routeController')) {

	/**
	 * Route Controller by Hiskia Dev
	 *
	 * @param
	 * @return
	 */
	function routeController($prefix, $controller)
	{
		$name = str_replace("/", ".", $prefix);
		$prefix = trim($prefix, '/') . '/';

		if (substr($controller, 0, 1) != "\\") {
			$controller = "\App\Http\Controllers\\" . $controller;
		}

		$exp = explode("\\", $controller);
		$controller_name = end($exp);

		try {
			$controller_class = new \ReflectionClass($controller);
			$controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);
			$wildcards = '/{one?}/{two?}/{three?}/{four?}/{five?}';

			Route::get($prefix, ['uses' => $controller . '@getIndex', 'as' => $name]);
			foreach ($controller_methods as $method) {

				if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {
					if (substr($method->name, 0, 3) == 'get') {
						$method_name = substr($method->name, 3);
						$slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
						$as = $name . '.' . strtolower(implode('.', $slug));
						$slug = strtolower(implode('-', $slug));
						$slug = ($slug == 'index') ? '' : $slug;
						Route::get($prefix . $slug . $wildcards, ['uses' => $controller . '@' . $method->name, 'as' => $as]);
					} elseif (substr($method->name, 0, 4) == 'post') {
						$method_name = substr($method->name, 4);
						$slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
						$as = $name . '.' . strtolower(implode('.', $slug));
						$slug = strtolower(implode('-', $slug));
						Route::post($prefix . $slug . $wildcards, [
							'uses' => $controller . '@' . $method->name,
							'as' => $as,
						]);
					}
				}
			}
		} catch (\Exception $e) {
		}
	}
}
