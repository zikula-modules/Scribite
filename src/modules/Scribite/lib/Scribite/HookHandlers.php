<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */
class Scribite_HookHandlers extends Zikula_Hook_AbstractHandler
{

    /**
     * Zikula_View instance
     *
     * @var Zikula_View
     */
    private $view;

    /**
     * Post constructor hook.
     *
     * @return void
     */
    public function setup()
    {
        $this->view = Zikula_View::getInstance("Scribite");
        $this->name = 'Scribite';
    }

    /**
     * Display a html snippet with buttons for inserting Scribites into a textarea
     *
     * @param Zikula_Hook $hook
     *
     * @return void
     */
    public function uiEdit(Zikula_DisplayHook $hook)
    {
        // get the module name
        $module = $hook->getCaller();

        // Security check if user has COMMENT permission for scribite
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

        // get config for module
        $modconfig = ModUtil::apiFunc('Scribite', 'admin', 'getModuleConfig', array('modulename' => $module));

        if (!empty($modconfig)) {
            // load the selected editor with module config
            $scribiteheader = $this->loader(array(
                'modulename' => $module,
                'editor' => $modconfig['modeditor'],
                'areas' => $modconfig['modareas']));
        } else {
            // load the default editor for unregistered module
            $scribiteheader = $this->loader(array(
                'modulename' => $module,
                'areas' => 'all'));
        }

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
     * @param array $args Text area: 'area', Module name: 'modulename'.
     *
     * @return string
     */
    private function loader($args)
    {
        // Argument checks
        $areas = (isset($args['areas'])) ? $args['areas'] : "all";
        $module = (isset($args['modulename'])) ? $args['modulename'] : ModUtil::getName();

        // Security check if user has COMMENT permission for Scribite and module
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

        // check for editor argument, if none given the default editor will be used
        if (!isset($args['editor']) || empty($args['editor'])) {
            // get default editor from config
            $args['editor'] = ModUtil::getVar('Scribite', 'DefaultEditor');
            ;
        }

        // set some general parameters
        $zBaseUrl = rtrim(System::getBaseUrl(), '/');
        $zikulaBaseURI = rtrim(System::getBaseUri(), '/');
        $zikulaBaseURI = ltrim($zikulaBaseURI, '/');
        $zikulaRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

        // prepare view instance
        $view = Zikula_View::getInstance('Scribite');
        //$view = Zikula_View_Plugin::getModulePluginInstance('Scribite', $args['editor']);

        $view->setCaching(false);
        //$view->assign(ModUtil::getVar('Scribite'));
        $view->assign(ModUtil::getVar("moduleplugin.scribite." . strtolower($args['editor'])));
        $view->assign('modname', $args['modulename']);
        $view->assign('zBaseUrl', $zBaseUrl);
        $view->assign('zikulaBaseURI', $zikulaBaseURI);
        $view->assign('zikulaRoot', $zikulaRoot);
        $view->assign('editor_dir', $args['editor']);
        $view->assign('zlang', ZLanguage::getLanguageCode());

        // check for modules installed providing plugins and load specific javascripts
        // This should be changed to an event or something... CAH 12/12/2012
        if (ModUtil::available('Mediashare')) {
            PageUtil::AddVar('javascript', 'modules/Mediashare/javascript/finditem.js');
        }
        if (ModUtil::available('MediaAttach')) {
            PageUtil::AddVar('javascript', 'modules/MediaAttach/javascript/finditem.js');
        }
        if (ModUtil::available('Files')) {
            PageUtil::AddVar('javascript', 'modules/Files/javascript/getFiles.js');
        }
        if (ModUtil::available('SimpleMedia')) {
            PageUtil::AddVar('javascript', 'modules/SimpleMedia/javascript/findItem.js');
        }
        if (ModUtil::available('MediaRepository')) {
            PageUtil::AddVar('javascript', 'modules/MediaRepository/javascript/MediaRepository_finder.js');
        }

        if (isset($areas[0]) && ($areas[0] == "all")) {
            $areas = 'all';
        }
        // set parameters
        $view->assign('modareas', $areas);

        // check for allowed html
        $AllowableHTML = System::getVar('AllowableHTML');
        $disallowedhtml = array();
        while (list($key, $access) = each($AllowableHTML)) {
            if ($access == 0) {
                $disallowedhtml[] = DataUtil::formatForDisplay($key);
            }
        }
        $view->assign('disallowedhtml', $disallowedhtml);


        // add additonal editor specific parameters
        $classname = 'ModulePlugin_Scribite_' . $args['editor'] . '_Plugin';
        if (method_exists($classname, 'addParameters')) {
            $additionalEditorParameters = $classname::addParameters();
            $view->assign($additionalEditorParameters);
        }

        return $view->fetch("file:modules/Scribite/plugins/$args[editor]/templates/editorheader.tpl");
    }

}