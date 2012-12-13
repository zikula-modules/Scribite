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
        $this->view->setCaching(false);
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
        $editor = (isset($args['editor']) && !empty($args['editor'])) ? $args['editor'] : ModUtil::getVar('Scribite', 'DefaultEditor');

        // Security check if user has COMMENT permission for Scribite and module
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

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

        // check for allowed html
        $AllowableHTML = System::getVar('AllowableHTML');
        $disallowedhtml = array();
        while (list($key, $access) = each($AllowableHTML)) {
            if ($access == 0) {
                $disallowedhtml[] = DataUtil::formatForDisplay($key);
            }
        }
        $this->view->assign('disallowedhtml', $disallowedhtml)
                ->assign(ModUtil::getVar("moduleplugin.scribite." . strtolower($editor)))
                ->assign('modname', $module)
                ->assign('modareas', $areas);

        // add additonal editor specific parameters
        $classname = 'ModulePlugin_Scribite_' . $editor . '_Plugin';
        if (method_exists($classname, 'addParameters')) {
            $additionalEditorParameters = $classname::addParameters();
            $this->view->assign($additionalEditorParameters);
        }

        return $this->view->fetch("file:modules/Scribite/plugins/$editor/templates/editorheader.tpl");
    }

}