<?php

declare(strict_types=1);

namespace Deable\Encore\Latte\Nodes;

use Latte\Compiler\Nodes\Php\Expression\ArrayNode;
use Latte\Compiler\Nodes\Php\ExpressionNode;
use Latte\Compiler\Nodes\StatementNode;
use Latte\Compiler\PrintContext;
use Latte\Compiler\Tag;


final class ScriptNode extends StatementNode
{
	public ExpressionNode $subject;

	public static function create(Tag $tag): self
	{
		$node = new self;
		$node->subject = $tag->parser->parseUnquotedStringOrExpression();

		return $node;
	}

	public function print(PrintContext $context): string
	{
		return $context->format('echo %escape($this->global->encoreLoader->getScripts(%node));', $this->subject);
	}

	public function &getIterator(): \Generator
	{
		yield $this->subject;
	}

}
