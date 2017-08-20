<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @see       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Controller_Admin extends Zikula_AbstractController
{
    public function postInitialize()
    {
        PageUtil::addVar('javascript', 'prototype');
        $this->view->setCaching(false);
    }

    // main function
    public function main()
    {
        $this->redirect(ModUtil::url('Scribite', 'admin', 'modifyconfig'));
    }

    // modify Scribite configuration
    public function modifyconfig()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());
        // Create form
        $form = FormUtil::newForm('Scribite', $this);

        return $form->execute('admin/modifyconfig.tpl', new Scribite_FormHandler_ModifyConfig());
    }

    /**
     * Create/modify/delete module or textarea overrides
     * template uses ajax to create/modify/delete rows
     *
     * @return string (html)
     */
    public function modifyoverrides()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());
        // get hookable modules (subscribers)
        $hookSubscribers = HookUtil::getHookSubscribers();
        $modulelist = [];
        foreach ($hookSubscribers as $module) {
            $modulelist[$module['name']] = $module['displayname'];
        }
        $this->view->assign('moduleList', $modulelist);

        // provide default values if none exists
        $overrides = ModUtil::getVar('Scribite', 'overrides');
        if (empty($overrides)) {
            ModUtil::setVar('Scribite', 'overrides', []);
        }

        // get all editors
        $editorList = ModUtil::apiFunc('Scribite', 'admin', 'getEditors');
        $this->view->assign('editorList', $editorList);

        return $this->view->fetch('admin/modifyoverrides.tpl');
    }

    // display editors
    public function editors()
    {
        $this->throwForbiddenUnless(SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADMIN), LogUtil::getErrorMsgPermission());

        // check for all supported editors and generate links
        $editors = ModUtil::apiFunc('Scribite', 'admin', 'getEditors', ['editorname' => 'list']);
        $this->view->assign('editors', $editors);
        $this->view->assign('defaulteditor', ModUtil::getVar('Scribite', 'DefaultEditor'));

        return $this->view->fetch('admin/editors.tpl');
    }

    /**
     * Update security settings (allowed html tags, html purifier configuration) to allow displaying embedded media.
     */
    public function allowEmbeddedMedia()
    {
        // step 1 - update allowed html tags
        $allowedHtml = System::getVar('AllowableHTML');
        foreach (['div', 'iframe', 'blockquote', 'script'] as $tagName) {
            $allowedHtml[$tagName] = 2; // allow with attributes
        }
        System::setVar('AllowableHTML', $allowedHtml);

        // step 2 - update html purifier configuration
        $securityCenterName = ModUtil::available('ZikulaSecurityCenterModule') ? 'ZikulaSecurityCenterModule' : 'SecurityCenter';
        $config = ModUtil::getVar($securityCenterName, 'htmlpurifierConfig', '');
        $config = $config != '' ? unserialize($config) : [];
        $config['HTML']['SafeIframe'] = true;
        $config['URI']['SafeIframeRegexp'] = '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%'; //allow YouTube and Vimeo
        $config['HTML']['AllowedElements'] = ['iframe'];

        ModUtil::setVar($securityCenterName, 'htmlpurifierConfig', serialize($config));

        LogUtil::registerStatus($this->__('Done! Settings have been updated for allowing display of embedded media.'));

        $this->redirect(ModUtil::url('Scribite', 'admin', 'modifyconfig'));
    }
}
