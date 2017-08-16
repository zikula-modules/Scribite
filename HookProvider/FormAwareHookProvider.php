<?php

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula Foundation - http://zikula.org/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\ScribiteModule\HookProvider;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Zikula\Bundle\HookBundle\Category\FormAwareCategory;
use Zikula\Bundle\HookBundle\FormAwareHook\FormAwareHook;
use Zikula\Bundle\HookBundle\HookProviderInterface;
use Zikula\Bundle\HookBundle\ServiceIdTrait;
use Zikula\Common\Translator\TranslatorInterface;

class FormAwareHookProvider implements HookProviderInterface
{
    use ServiceIdTrait;
    private $session;
    private $translator;
    private $formFactory;

    public function __construct(
        SessionInterface $session,
        TranslatorInterface $translator
    ) {
        $this->session = $session;
        $this->translator = $translator;
    }

    public function getOwner()
    {
        return 'ZikulaScribiteModule';
    }

    public function getCategory()
    {
        return FormAwareCategory::NAME;
    }

    public function getTitle()
    {
        return $this->translator->__('Scribite FormAware Provider');
    }

    public function getProviderTypes()
    {
        return [
            FormAwareCategory::TYPE_EDIT => 'edit',
        ];
    }

    public function edit(FormAwareHook $hook)
    {
        $myForm = $this->formFactory->create(FooType::class, null, [
            'auto_initialize' => false, // required
            'mapped' => false // required
        ]);
        $hook
            ->formAdd($myForm)
            ->addTemplate(('@ZikulaScribiteModule/Hook/editor.html.twig'))
        ;
    }


    /**
     * Display a html snippet with buttons for inserting Scribites into a textarea
     * NOTE:
     *   Zikula_DisplayHook extends Zikula\Core\Hook\DisplayHook
     *   SO - this method SHOULD be backward compatible with old hooks.
     *
     * @param DisplayHook $hook
     *
     * @return void
     */
    public function uiEdit(DisplayHook $hook)
    {
        // get the module name
        $module = $hook->getCaller();

        // Security check if user has COMMENT permission for scribite
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

        // load the editor
        $scribiteheader = $this->loader([
            'modulename' => $module]);

        // add the scripts to page header
        if ($scribiteheader) {
            PageUtil::AddVar('header', $scribiteheader);
        }

        $response = new Zikula_Response_DisplayHook(Scribite_Version::PROVIDER_UIAREANAME, $this->view, 'hook/scribite.tpl');
        $hook->setResponse($response);
    }

    /**
     * Initialise Scribite for requested areas.
     *
     * @param array $args module name: 'modulename'
     *
     * @return string
     */
    private function loader($args)
    {
        // Argument checks
        $module = (isset($args['modulename'])) ? $args['modulename'] : ModUtil::getName();

        $overrides = ModUtil::getVar('Scribite', 'overrides');
        $editor = (isset($overrides[$module]['editor'])) ? $overrides[$module]['editor'] : ModUtil::getVar('Scribite', 'DefaultEditor');

        // check for modules providing helpers and load them into the page
        $event = new Zikula_Event('module.scribite.editorhelpers', new Scribite_EditorHelper(), ['editor' => $editor]);
        $helpers = EventUtil::getManager()->notify($event)->getSubject()->getHelpers();
        foreach ($helpers as $helper) {
            if (ModUtil::available($helper['module'])) {
                PageUtil::addVar($helper['type'], $helper['path']);
            }
        }

        // check for allowed html
        $allowedHtmlTags = System::getVar('AllowableHTML');
        $disallowedHtmlTags = [];
        while (list($key, $access) = each($allowedHtmlTags)) {
            if ($access == 0) {
                $disallowedHtmlTags[] = DataUtil::formatForDisplay($key);
            }
        }

        // fetch additonal editor specific parameters.
        $classname = 'ModulePlugin_Scribite_' . $editor . '_Util';
        $additionalEditorParameters = [];
        if (method_exists($classname, 'addParameters')) {
            $additionalEditorParameters = $classname::addParameters();
        }
        // fetch external editor plugins
        $additionalExternalEditorPlugins = [];
        if (method_exists($classname, 'addExternalPlugins')) {
            $additionalExternalEditorPlugins = $classname::addExternalPlugins();
        }

        // assign disabled textareas to template as a javascript array
        $javascript = 'var disabledTextareas = [';
        if (isset($overrides[$module])) {
            foreach (array_keys($overrides[$module]) as $area) {
                if ($area == 'editor') {
                    continue;
                }
                if ((isset($overrides[$module][$area]['disabled'])) && ($overrides[$module][$area]['disabled'] == 'true')) {
                    $javascript .= "'" . $area . "',";
                }
            }
        }
        $javascript = rtrim($javascript, ',');
        $javascript .= '];';
        PageUtil::addVar('footer', '<script type="text/javascript">' . $javascript . '</script>');

        // assign override parameters to javascript object
        $javascript = '';
        $paramOverrides = false;
        if (isset($overrides[$module])) {
            foreach ($overrides[$module] as $area => $config) {
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
        PageUtil::addVar('footer', '<script type="text/javascript">' . "\n" . $javascript . "\n" . '</script>');

        // insert notify function
        PageUtil::addVar('javascript', 'modules/Scribite/javascript/function-insertnotifyinput.js');

        $view = Zikula_View_Plugin::getPluginInstance('Scribite', $editor, Zikula_View::CACHE_DISABLED);

        // assign to template in Scribite 'namespace'
        $templateVars = [
            'editorVars' => ModUtil::getVar('moduleplugin.scribite.' . strtolower($editor)),
            'modname' => $module,
            'disallowedhtml' => $disallowedHtmlTags,
            'paramOverrides' => $paramOverrides
        ];
        if (!empty($additionalEditorParameters)) {
            $templateVars['editorParameters'] = $additionalEditorParameters;
        }
        if (!empty($additionalExternalEditorPlugins)) {
            $templateVars['addExtEdPlugins'] = $additionalExternalEditorPlugins;
        }
        $view->assign('Scribite', $templateVars);

        return $view->fetch('editorheader.tpl');
    }
}
