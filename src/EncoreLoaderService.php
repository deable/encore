<?php

declare(strict_types=1);

namespace Deable\Encore;

use Nette\InvalidStateException;
use Nette\Utils\Html;


final class EncoreLoaderService
{
	private array $entryPoints;

	public function __construct(array $entryPoints)
	{
		$this->entryPoints = $entryPoints;
	}

	public function getStyles(string $name): Html
	{
		$files = $this->entryPoints[$name]['css'] ?? null;
		if ($files === null) {
			throw new InvalidStateException("Styles for endpoint '$name' not found!");
		}

		$root = Html::el();
		foreach ($files as $file) {
			$root->addHtml(Html::el('link', ['rel' => 'stylesheet', 'href' => $file]));
		}

		return $root;
	}

	public function getScripts(string $name): Html
	{
		$files = $this->entryPoints[$name]['js'] ?? null;
		if ($files === null) {
			throw new InvalidStateException("Scripts for endpoint '$name' not found!");
		}

		$root = Html::el();
		foreach ($files as $file) {
			$root->addHtml(Html::el('script', ['src' => $file]));
		}

		return $root;
	}

}
