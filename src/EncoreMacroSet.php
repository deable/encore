<?php

declare(strict_types=1);

namespace Deable\Encore;

use Latte;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;


final class EncoreMacroSet extends MacroSet
{

	public static function install(Latte\Compiler $compiler): void
	{
		$me = new EncoreMacroSet($compiler);
		$me->addMacro('style', [$me, 'macroStyle']);
		$me->addMacro('script', [$me, 'macroScript']);
	}

	/**
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 *
	 * @return string
	 * @throws Latte\CompileException
	 */
	public function macroStyle(MacroNode $node, PhpWriter $writer): string
	{
		return $writer->write('echo %escape(%modify($this->global->encoreLoader->getStyles(%node.args)))');
	}

	/**
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 *
	 * @return string
	 * @throws Latte\CompileException
	 */
	public function macroScript(MacroNode $node, PhpWriter $writer): string
	{
		return $writer->write('echo %escape(%modify($this->global->encoreLoader->getScripts(%node.args)))');
	}

}
