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

namespace Zikula\ScribiteModule\Editor;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Twig\Environment;
use Zikula\Bundle\CoreBundle\HttpKernel\ZikulaHttpKernelInterface;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\ScribiteModule\Collection\HelperCollection;
use Zikula\ScribiteModule\Collector\EditorCollector;
use Zikula\ScribiteModule\Event\EditorHelperEvent;
use Zikula\ScribiteModule\Helper\AssetHelper;
use Zikula\ThemeModule\Api\ApiInterface\PageAssetApiInterface;

class Factory
{
    /**
     * @var VariableApiInterface
     */
    private $variableApi;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var PageAssetApiInterface
     */
    private $pageAssetApi;

    /**
     * @var ZikulaHttpKernelInterface
     */
    private $kernel;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EditorCollector
     */
    private $editorCollector;

    /**
     * @var AssetHelper
     */
    private $assetHelper;

    public function __construct(
        VariableApiInterface $variableApi,
        EventDispatcherInterface $dispatcher,
        PageAssetApiInterface $pageAssetApi,
        ZikulaHttpKernelInterface $kernel,
        Environment $twig,
        EditorCollector $editorCollector,
        AssetHelper $assetHelper
    ) {
        $this->variableApi = $variableApi;
        $this->dispatcher = $dispatcher;
        $this->pageAssetApi = $pageAssetApi;
        $this->kernel = $kernel;
        $this->twig = $twig;
        $this->editorCollector = $editorCollector;
        $this->assetHelper = $assetHelper;
    }

    /**
     * @param string $moduleName
     */
    public function load($moduleName)
    {
        $overrides = $this->variableApi->get('ZikulaScribiteModule', 'overrides');
        $editorId = (isset($overrides[$moduleName]['editor']))
            ? $overrides[$moduleName]['editor']
            : $this->variableApi->get('ZikulaScribiteModule', 'DefaultEditor', 'CKEditor');

        $editor = $this->editorCollector->get($editorId);
        $this->assetHelper->install($editorId, $editor);

        // check for modules providing helpers and load them into the page
        $event = new EditorHelperEvent(new HelperCollection(), $editorId);
        $helpers = $this->dispatcher->dispatch($event)->getHelperCollection()->getHelpers();
        foreach ($helpers as $helper) {
            if ($this->kernel->isBundle($helper['module'])) {
                $this->pageAssetApi->add($helper['type'], $helper['path']);
            }
        }

        // check for allowed html
        $allowedHtmlTags = $this->variableApi->getSystemVar('AllowableHTML');
        $disallowedHtmlTags = [];
        foreach ($allowedHtmlTags as $key => $access) {
            if (0 === $access) {
                $disallowedHtmlTags[] = $key;
            }
        }

        if ($editor instanceof EditorHelperProviderInterface) {
            $editorHelper = $editor->getHelperInstance();
            if (!($editorHelper instanceof EditorHelperInterface)) {
                throw new \RuntimeException(sprintf('%s must implement %s', get_class($editorHelper), EditorHelperInterface::class));
            }
            $additionalEditorParameters = $editorHelper->getParameters();
            $additionalExternalEditorPlugins = $editorHelper->getExternalPlugins();
        }

        // assign disabled textareas to template as a javascript array
        $javascript = 'var disabledTextareas = [';
        if (isset($overrides[$moduleName])) {
            foreach (array_keys($overrides[$moduleName]) as $area) {
                if ('editor' === $area) {
                    continue;
                }
                if (isset($overrides[$moduleName][$area]['disabled']) && 'true' === $overrides[$moduleName][$area]['disabled']) {
                    $javascript .= "'" . $area . "',";
                }
            }
        }
        $javascript = rtrim($javascript, ',');
        $javascript .= '];';
        $this->pageAssetApi->add('footer', '<script type="text/javascript">' . $javascript . '</script>');

        // assign override parameters to javascript object
        $javascript = '';
        $paramOverrides = false;
        if (isset($overrides[$moduleName])) {
            foreach ($overrides[$moduleName] as $area => $config) {
                if ('editor' === $area) {
                    continue;
                }
                if (!empty($config['params'])) {
                    $paramOverrides = true;

                    $javascript .= "var paramOverrides_${area} = {";

                    foreach ($config['params'] as $param => $value) {
                        $javascript .= "\n    ${param}: '${value}',";
                    }

                    $javascript .= "\n}";
                }
            }
        }
        $this->pageAssetApi->add('footer', '<script type="text/javascript">' . "\n" . $javascript . "\n" . '</script>');

        $parameters = [
            'editorVars' => $editor->getVars(),
            'modname' => $moduleName,
            'disallowedHtmlTags' => $disallowedHtmlTags,
            'paramOverrides' => $paramOverrides
        ];
        if (!empty($additionalEditorParameters)) {
            $parameters['editorParameters'] = $additionalEditorParameters;
        }
        if (!empty($additionalExternalEditorPlugins)) {
            $parameters['externalEditorPlugins'] = $additionalExternalEditorPlugins;
        }
        $content = $this->twig->render($editor->getDirectory() . '/Resources/views/editorheader.html.twig', $parameters);

        $this->pageAssetApi->add('footer', $content);
    }
}
