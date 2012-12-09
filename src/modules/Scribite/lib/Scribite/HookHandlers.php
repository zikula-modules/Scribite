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
        $modconfig = ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => $module));

        if (!empty($modconfig)) {
            // load the selected editor with module config
            $scribiteheader = ModUtil::apiFunc('Scribite', 'user', 'loader', array(
                        'modulename' => $module,
                        'editor' => $modconfig['modeditor'],
                        'areas' => $modconfig['modareas']));
        } else {
            // load the default editor for unregistered module
            $scribiteheader = ModUtil::apiFunc('Scribite', 'user', 'loader', array(
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

}