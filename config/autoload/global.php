<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
	'zfctwig' => [
		'environment_loader' => 'ZfcTwigLoaderChain',
		'environment_options' => [],
		'loader_chain' => [
			'ZfcTwigLoaderTemplateMap',
			'ZfcTwigLoaderTemplatePathStack'
		],
		'extensions' => [
			'zfctwig' => 'ZfcTwigExtension'
		],
		'suffix' => 'twig',
		'enable_fallback_functions' => true,
		'disable_zf_model' => true,
	],
	'zenddevelopertools' => [
		/**
		 * General Profiler settings
		 */
		'profiler' => [
			'enabled' => false,
			'strict' => true,
			'flush_early' => true,
			'cache_dir' => 'data/cache',
			'matcher' => [],
			'collectors' => [],
		],
		/**
		 * General Toolbar settings
		 */
		'toolbar' => [
			'enabled' => false,
			'auto_hide' => true,
			'position' => 'bottom',
			'version_check' => true,
			'entries' => [],
		],
	],
];