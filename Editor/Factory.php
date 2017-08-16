<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\Editor;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Templating\EngineInterface;
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
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var EditorCollector
     */
    private $editorCollector;

    /**
     * @var AssetHelper
     */
    private $assetHelper;

    /**
     * @param VariableApiInterface $variableApi
     * @param EventDispatcherInterface $dispatcher
     * @param PageAssetApiInterface $pageAssetApi
     * @param ZikulaHttpKernelInterface $kernel
     * @param EngineInterface $templating
     * @param EditorCollector $editorCollector
     * @param AssetHelper $assetHelper
     */
    public function __construct(
        VariableApiInterface $variableApi,
        EventDispatcherInterface $dispatcher,
        PageAssetApiInterface $pageAssetApi,
        ZikulaHttpKernelInterface $kernel,
        EngineInterface $templating,
        EditorCollector $editorCollector,
        AssetHelper $assetHelper
    ) {
        $this->variableApi = $variableApi;
        $this->dispatcher = $dispatcher;
        $this->pageAssetApi = $pageAssetApi;
        $this->kernel = $kernel;
        $this->templating = $templating;
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
        $helpers = $this->dispatcher->dispatch('module.scribite.editorhelpers', $event)->getHelper()->getHelpers();
        foreach ($helpers as $helper) {
            if ($this->kernel->isBundle($helper['module'])) {
                $this->pageAssetApi->add($helper['type'], $helper['path']);
            }
        }

        // check for allowed html
        $allowedHtmlTags = $this->variableApi->getSystemVar('AllowableHTML');
        $disallowedHtmlTags = [];
        while (list($key, $access) = each($allowedHtmlTags)) {
            if ($access == 0) {
                $disallowedHtmlTags[] = $key;
            }
        }

        if ($editor instanceof EditorHelperProviderInterface) {
            $editorHelperClass = $editor->getHelperClass();
            $editorHelper = new $editorHelperClass;
            if (!($editorHelper instanceof EditorHelperInterface)) {
                throw new \RuntimeException(sprintf('%s must implement %s', $editorHelperClass, EditorHelperInterface::class));
            }
            if ($editorHelper instanceof DispatcherAwareInterface) {
                $editorHelper->setDispatcher($this->dispatcher);
            }
            $additionalEditorParameters = $editorHelper->getParameters();
            $additionalExternalEditorPlugins = $editorHelper->getExternalPlugins();
        }

        // assign disabled textareas to template as a javascript array
        $javascript = 'var disabledTextareas = [';
        if (isset($overrides[$moduleName])) {
            foreach (array_keys($overrides[$moduleName]) as $area) {
                if ($area == 'editor') {
                    continue;
                }
                if ((isset($overrides[$moduleName][$area]['disabled'])) && ($overrides[$moduleName][$area]['disabled'] == 'true')) {
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
                if ($area == 'editor') {
                    continue;
                }
                if (!empty($config['params'])) {
                    $paramOverrides = true;

                    $javascript .= "var paramOverrides_$area = {";

                    foreach ($config['params'] as $param => $value) {
                        $javascript .= "\n    $param: '$value',";
                    }

                    $javascript .= "\n}";
                }
            }
        }
        $this->pageAssetApi->add('footer', '<script type="text/javascript">' . "\n" . $javascript . "\n" . '</script>');

        $parameters = [
            'editorVars' => $editor->getVars(),
            'modname' => $moduleName,
            'disallowedhtml' => $disallowedHtmlTags,
            'paramOverrides' => $paramOverrides
        ];
        if (!empty($additionalEditorParameters)) {
            $parameters['editorParameters'] = $additionalEditorParameters;
        }
        if (!empty($additionalExternalEditorPlugins)) {
            $parameters['addExtEdPlugins'] = $additionalExternalEditorPlugins;
        }
        $content = $this->templating->render($editor->getDirectory() . '/Resources/views/editorheader.html.twig', $parameters);

        $this->pageAssetApi->add('footer', $content);
    }
}
