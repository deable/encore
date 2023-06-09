<?php

declare(strict_types=1);

namespace Deable\Encore;

use Deable\Encore\Latte\LatteExtension;
use Nette\Bridges\ApplicationLatte\LatteFactory;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\FactoryDefinition;
use Nette\Schema\Expect;
use Nette\Schema\Schema;


final class EncoreExtension extends CompilerExtension
{
	private string $wwwDir;

	public function __construct(string $wwwDir)
	{
		$this->wwwDir = $wwwDir;
	}

	public function getConfigSchema(): Schema
	{
		return Expect::structure(
			[
				'distDir' => Expect::string()->default('dist'),
			]
		);
	}

	public function beforeCompile(): void
	{
		$distDir = "{$this->wwwDir}/{$this->config->distDir}";

		$builder = $this->getContainerBuilder();
		/** @noinspection PhpInternalEntityUsedInspection */
		$builder->addDependency("$distDir/manifest.json");
		/** @noinspection PhpInternalEntityUsedInspection */
		$builder->addDependency("$distDir/entrypoints.json");

		$entrypoints = json_decode(file_get_contents("$distDir/entrypoints.json"), true);

		$encoreLoaderService = $builder->addDefinition($this->prefix('loader'))
			->setType(EncoreLoaderService::class)
			->setArgument('entryPoints', $entrypoints['entrypoints']);

		$extensionService = $builder->addDefinition($this->prefix('extension'))
			->setType(LatteExtension::class);

		/** @var FactoryDefinition $factoryDefinition */
		$factoryDefinition = $builder->getDefinitionByType(LatteFactory::class);
		$factoryDefinition
			->getResultDefinition()
			->addSetup('addProvider', ['name' => 'encoreLoader', 'value' => $encoreLoaderService])
			->addSetup('addExtension', [$extensionService]);
	}

}
