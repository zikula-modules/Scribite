<?php

declare(strict_types=1);

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Helper;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Zikula\Bundle\CoreBundle\HttpKernel\ZikulaHttpKernelInterface;
use Zikula\ScribiteModule\Editor\EditorInterface;

class AssetHelper
{
    /**
     * @var ZikulaHttpKernelInterface
     */
    private $kernel;

    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(
        ZikulaHttpKernelInterface $kernel,
        Filesystem $filesystem
    ) {
        $this->kernel = $kernel;
        $this->filesystem = $filesystem;
    }

    public function install($id, EditorInterface $editor)
    {
        $targetDir = $this->kernel->getProjectDir() . '/public/editors/' . preg_replace('/editors$/', '', mb_strtolower($id));
        $finder = new Finder();
        if ($this->filesystem->exists($targetDir)) {
            $finder->files()->in($targetDir)->name('version.txt');
            if (1 === $finder->count()) {
                foreach ($finder as $file) {
                    if ($file->getContents() === $editor->getMeta()['version']) {
                        return; // current version assets already installed
                    }
                }
            }
        }
        // install the assets
        $this->filesystem->remove($targetDir);
        $this->filesystem->mkdir($targetDir, 0777);
        $this->filesystem->dumpFile($targetDir . '/version.txt', $editor->getMeta()['version']);
        if (is_dir($originDir = $editor->getDirectory() . '/Resources/public')) {
            $this->filesystem->mirror($originDir, $targetDir, Finder::create()->in($originDir));
        }
        if (is_dir($originDir = $editor->getDirectory() . '/vendor')) {
            $this->filesystem->mirror($originDir, $targetDir, Finder::create()->in($originDir));
        }
    }
}
