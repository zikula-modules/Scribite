<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @see       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Version extends Zikula_AbstractVersion
{
    const PROVIDER_UIAREANAME = 'provider.scribite.ui_hooks.editor';

    public function getMetaData()
    {
        $meta = [];
        $meta['displayname'] = $this->__('Scribite');
        $meta['oldnames'] = ['scribite'];
        $meta['url'] = $this->__('scribite');
        $meta['version'] = '5.0.3';
        $meta['core_min'] = '1.3.5';
        $meta['core_max'] = '1.5.99';
        $meta['description'] = $this->__('WYSIWYG editors for Zikula');
        $meta['securityschema'] = ['Scribite::' => 'Modulename::'];
        $meta['capabilities'] = [
            HookUtil::PROVIDER_CAPABLE => ['enabled' => true]
        ];

        return $meta;
    }

    protected function setupHookBundles()
    {
        $bundle = new Zikula_HookManager_ProviderBundle($this->name, self::PROVIDER_UIAREANAME, 'ui_hooks', __('WYSIWYG Editor'));
        $bundle->addServiceHandler('form_edit', 'Scribite_HookHandlers', 'uiEdit', 'scribite.editor');
        $this->registerHookProviderBundle($bundle);
    }
}
