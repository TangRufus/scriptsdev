<?php

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
	public function activate(Composer $composer, IOInterface $io)
	{
		if (in_array('--no-dev', $_SERVER['argv'])) {
			return;
		}

		$extra = $composer->getPackage()->getExtra();
		if (empty($extra['scripts-dev'])) {
			return;
		}

		$scripts = array_merge_recursive(
			$composer->getPackage()->getScripts(),
			$extra['scripts-dev']
		);

		$composer->getPackage()->setScripts($scripts);
	}
}
