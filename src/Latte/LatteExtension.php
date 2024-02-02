<?php

declare(strict_types=1);

namespace Deable\Encore\Latte;

use Deable\Encore\Latte\Nodes\ScriptNode;
use Deable\Encore\Latte\Nodes\StyleInlineNode;
use Deable\Encore\Latte\Nodes\StyleNode;
use Latte\Extension;


final class LatteExtension extends Extension
{

	public function getTags(): array
	{
		return [
			'style' => [StyleNode::class, 'create'],
			'styleInline' => [StyleInlineNode::class, 'create'],
			'script' => [ScriptNode::class, 'create'],
		];
	}

}
