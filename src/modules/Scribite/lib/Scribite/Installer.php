<?php

/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Installer extends Zikula_AbstractInstaller
{

    public function install()
    {
        ModUtil::loadApi('Scribite', 'user', true);
        ModUtil::loadApi('Scribite', 'admin', true);


        // create table
        try {
            DoctrineHelper::createSchema($this->entityManager, array(
                'Scribite_Entity_Scribite'
            ));
        } catch (Exception $e) {
            LogUtil::registerStatus($e->getMessage());
            return false;
        }

        EventUtil::registerPersistentModuleHandler('Scribite', 'core.postinit', array('Scribite_Listeners', 'coreinit'));

        // create the default data for the module
        $this->defaultdata();


        // Install editor plugins
        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');
        foreach ($plugins as $pluginName) {
            $className = 'ModulePlugin_Scribite_'.$pluginName.'_Plugin';
            $instance = PluginUtil::loadPlugin($className);
            $pluginstate = PluginUtil::getState($instance->getServiceId(), PluginUtil::getDefaultState());
            if ($pluginstate['state'] == 2) {
                PluginUtil::install($className);
            }

        }


        // Initialisation successful
        return true;
    }

    public function upgrade($oldversion)
    {
        switch ($oldversion) {
            case '1.0':
            // no changes made

            case '1.1':
                // delete old paths
                $this->delVar('xinha_path');
                $this->delVar('tinymce_path');
                // set new path
                $this->setVar('editors_path', 'javascript/scribite_editors');

            case '1.2':
                try {
                    DoctrineHelper::createSchema($this->entityManager, array(
                        'Scribite_Entity_Scribite'
                    ));
                } catch (Exception $e) {
                    LogUtil::registerStatus($e->getMessage());
                    return false;
                }
                // create the default data for the module
                $this->defaultdata();
                // del old module vars
                $this->delVar('editor');
                $this->delVar('editor_activemodules');

            case '1.21':
                // create new values
                $this->setVar('openwysiwyg_barmode', 'full');
                $this->setVar('openwysiwyg_width', '400');
                $this->setVar('openwysiwyg_height', '300');
                $this->setVar('xinha_statusbar', 1);

            case '1.3':
                // create new values
                $this->setVar('openwysiwyg_barmode', 'full');
                $this->setVar('openwysiwyg_width', '400');
                $this->setVar('openwysiwyg_height', '300');
                $this->setVar('xinha_statusbar', 1);

            case '2.0':
                // create new values
                $this->setVar('DefaultEditor', '-');
                $this->setVar('nicedit_fullpanel', 1);
                // fill some vars with defaults
                if (!$this->getVar('xinha_converturls')) {
                    $this->setVar('xinha_converturls', 1);
                }
                if (!$this->getVar('xinha_showloading')) {
                    $this->setVar('xinha_showloading', 1);
                }
                if (!$this->getVar('xinha_activeplugins')) {
                    $this->setVar('xinha_activeplugins', 'a:2:{i:0;s:7:"GetHtml";i:1;s:12:"SmartReplace";}');
                }
                if (!$this->getVar('tinymce_activeplugins')) {
                    $this->setVar('tinymce_activeplugins', '');
                }
                if (!$this->getVar('fckeditor_autolang')) {
                    $this->setVar('fckeditor_autolang', 1);
                }
                //create new module vars for crpCalendar
                $record = array(
                    'modname' => 'crpCalendar',
                    'modfuncs' => 'new',
                    'modareas' => 'crpcalendar_event_text',
                    'modeditor' => '-'
                );
                $this->insertItem($record);


            case '2.1':
                //create new module vars for Content
                $record = array(
                    'modname' => 'content',
                    'modfuncs' => 'dummy',
                    'modareas' => 'dummy',
                    'modeditor' => '-'
                );
                $this->insertItem($record);

            case '2.2':
                //create new module vars for Blocks #14
                $record = array(
                    'modname' => 'Blocks',
                    'modfuncs' => "modify",
                    'modareas' => 'blocks_content',
                    'modeditor' => '-'
                );
                $this->insertItem($record);
                // check for Zikula 1.1.x version
                if (Zikula_Core::VERSION_NUM < '1.1.0') {
                    LogUtil::registerError($this->__('This version from Scribite only works with Zikula 1.1.x and higher. Please upgrade your Zikula version or use Scribite version 2.x .'));
                    return '2.2';
                }
                // create systeminit hook - new in Zikula 1.1.0
                if (!ModUtil::registerHook('zikula', 'systeminit', 'GUI', 'Scribite', 'user', 'run')) {
                    LogUtil::registerError($this->__('Error creating Hook!'));
                    return '2.2';
                }
                ModUtil::apiFunc('Modules', 'admin', 'enablehooks', array('callermodname' => 'zikula', 'hookmodname' => 'Scribite'));
                LogUtil::registerStatus($this->__('<strong>Scribite</strong> was activated as core hook. You can check settings <a href="index.php?module=Modules&type=admin&func=hooks&id=0">here</a>!<br />The template plugin from previous versions of Scribite can be removed from templates.'));

            case '3.0':
                //create new module vars for Newsletter and Web_Links
                $records = array(
                    array(
                        'modname' => 'Newsletter',
                        'modfuncs' => 'add_message',
                        'modareas' => 'message',
                        'modeditor' => '-'
                    ),
                    array(
                        'modname' => 'crpVideo',
                        'modfuncs' => 'new,modify',
                        'modareas' => 'video_content',
                        'modeditor' => '-'
                    ),
                    array(
                        'modname' => 'Web_Links',
                        'modfuncs' => 'linkview,addlink,modifylinkrequest',
                        'modareas' => 'description',
                        'modeditor' => '-'
                    )
                );
                foreach ($records as $record) {
                    $this->insertItem($record);
                }

                // set vars for YUI Rich Text Editor
                if (!$this->getVar('yui_type')) {
                    $this->setVar('yui_type', 'Simple');
                }
                if (!$this->getVar('yui_width')) {
                    $this->setVar('yui_width', 'auto');
                }
                if (!$this->getVar('yui_height')) {
                    $this->setVar('yui_height', '300');
                }
                if (!$this->getVar('yui_dombar')) {
                    $this->setVar('yui_dombar', true);
                }
                if (!$this->getVar('yui_animate')) {
                    $this->setVar('yui_animate', true);
                }
                if (!$this->getVar('yui_collapse')) {
                    $this->setVar('yui_collapse', true);
                }

            case '3.1':
                // modify Profile module
                $originalconfig = ModUtil::apiFunc('Scribite', 'user', 'getModuleConfig', array('modulename' => "Profile"));
                $newconfig = array('mid' => $originalconfig['mid'],
                        'modulename' => 'Profile',
                        'modfuncs' => "modify",
                        'modareas' => "prop_signature,prop_extrainfo,prop_yinterests",
                        'modeditor' => $originalconfig['modeditor']);
                $modupdate = ModUtil::apiFunc('Scribite', 'admin', 'editmodule', $newconfig);

            case '3.2':
                // set new editors folder
                $this->setVar('editors_path', 'modules/Scribite/pnincludes');
                LogUtil::registerStatus($this->__('<strong>Caution!</strong><br />All editors have moved to /modules/Scribite/pnincludes in preparation for upcoming features of Zikula. Please check all your settings!<br />If you have adapted files from editors you have to check them too.<br /><br /><strong>Dropped support for FCKeditor and TinyMCE</strong><br />For security reasons these editors will not be supported anymore. Please change editors to an other editor.'));

            case '4.0':

            case '4.1':

            case '4.2':
                $this->setVar('nicedit_xhtml', 1);

            case '4.2.1':
                if (!$this->getVar('ckeditor_language')) {
                    $this->setVar('ckeditor_language', 'en');
                }
                if (!$this->getVar('ckeditor_barmode')) {
                    $this->setVar('ckeditor_barmode', 'Full');
                }
                if (!$this->getVar('ckeditor_maxheight')) {
                    $this->setVar('ckeditor_maxheight', '400');
                }

            case '4.2.2':
                // this renames the table and the columns per new z1.3.0 standards
                $this->renameColumns();
                EventUtil::registerPersistentModuleHandler('Scribite', 'core.postinit', array('Scribite_Listeners', 'coreinit'));
                $this->setVar('editors_path', 'modules/Scribite/includes');
                LogUtil::registerStatus($this->__('<strong>Caution!</strong><br />All editors have moved to /modules/Scribite/includes.<br />If you have adapted files from editors you have to check them too.'));
            case '4.2.3':
                 
                //set vars for markitup
                if (!$this->getVar('markitup_width')) {
                    $this->setVar('markitup_width', '65%');
                }
                if (!$this->getVar('markitup_height')) {
                    $this->setVar('markitup_height', '400px');
                }

                // remove fckeditor (was deprecated in 4.1)
                $this->delVar('fckeditor_language');
                $this->delVar('fckeditor_barmode');
                $this->delVar('fckeditor_width');
                $this->delVar('fckeditor_maxheight');
                $this->delVar('fckeditor_autolang');
                // update module assignments to correct removed and deprecated editors
                $dbtable = DBUtil::getTables();
                $columns = $dbtable['scribite_column'];
                $sql = "UPDATE `$dbtable[scribite]` SET `$columns[modeditor]`='-' WHERE `$columns[modeditor]`='fckeditor' OR `$columns[modeditor]`='tinymce' OR `$columns[modeditor]`='openwysiwyg'";
                DBUtil::executeSQL($sql);
                // reset modules
                $this->resetModuleConfig('Downloads');
                $this->resetModuleConfig('FAQ');
                $this->resetModuleConfig('News');
                $this->resetModuleConfig('Pages');
                $this->resetModuleConfig('ContentExpress');
                $this->resetModuleConfig('Mediashare');
                // correct possible serialized data corruption
                if (!DataUtil::is_serialized($this->getVar('xinha_activeplugins'))) {
                    $this->delVar('xinha_activeplugins');
                }
                // relocate xinha styles
                $this->setVar('xinha_style', 'modules/Scribite/style/xinha/editor.css');
                $this->setVar('xinha_style_dynamiccss', 'modules/Scribite/style/xinha/DynamicCSS.css');
                $this->setVar('xinha_style_stylist', 'modules/Scribite/style/xinha/stylist.css');
                $this->setVar('ckeditor_style_editor', 'modules/Scribite/style/ckeditor/content.css');
                $this->setVar('ckeditor_skin', 'kama');
                
                // remove content settings
                $modconfig = $this->entityManager->getRepository('Scribite_Entity_Scribite')
                                 ->findOneBy(array('modname' => 'content'));
                if ($modconfig) {
                    $this->entityManager->remove($modconfig);
                    $this->entityManager->flush();
                }
            case '4.3.0':
                // notice - remove openwysiwyg vars @>4.3.0

                // activate new editor plugins
                $path = 'modules/Scribite/plugins';
                $plugins = FileUtil::getFiles($path, false, true, null, 'd');
                PluginUtil::loadAllPlugins();
                foreach ($plugins as $pluginName) {
                    $className = 'ModulePlugin_Scribite_'.$pluginName.'_Plugin';
                    $instance = PluginUtil::loadPlugin($className);
                    $pluginstate = PluginUtil::getState($instance->getServiceId(), PluginUtil::getDefaultState());
                    if ($pluginstate['state'] == 2) {
                        PluginUtil::install($className);
                    }

                    // migrate vars to editor plugins
                    if (method_exists($className,'getDefaults')) {
                        $vars = $className::getDefaults();
                        foreach($vars as $key => $value) {
                            $lowerPluginName = strtolower($pluginName);
                            $oldVarName = $lowerPluginName.'_'.$key;
                            $oldVarValue = $this->getVar($oldVarName);
                            $this->delVar($oldVarName);
                            if (empty($oldVarValue)) {
                                continue;
                            }
                            $oldVarValue = str_replace(
                                            'modules/Scribite/style/'.$lowerPluginName,
                                            'modules/Scribite/plugins/'.$pluginName.'/style/',
                                            $oldVarValue
                                           );


                            ModUtil::setVar('moduleplugin.scribite.'.$lowerPluginName, $key, $oldVarValue);
                        }
                    }
                }

                // new upload manager
                $this->setVar('upload_path', 'userdata/Scribite');
                $this->setVar('image_upload', false);

        }

        return true;
    }

    public function insertItem($data)
    {
        $modconfig = $this->entityManager->getRepository('Scribite_Entity_Scribite')
                    ->findOneBy(array('modname' => $data['modname']));

        if ($modconfig) {
            return false;
        }

        $item = new Scribite_Entity_Scribite();
        $item->merge($data);
        $this->entityManager->persist($item);
        $this->entityManager->flush();

    }


    public function uninstall()
    {
        // Delete editor plugins
        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');
        PluginUtil::loadAllPlugins();
        foreach ($plugins as $pluginName) {
            $className = 'ModulePlugin_Scribite_'.$pluginName.'_Plugin';
            PluginUtil::uninstall($className);
        }



        // drop tables
        DoctrineHelper::dropSchema($this->entityManager, array(
            'Scribite_Entity_Scribite'
        ));

        // Delete any module variables
        $this->delVars();

        EventUtil::unregisterPersistentModuleHandler('Scribite', 'core.postinit', array('Scribite_Listeners', 'coreinit'));


        // Deletion successful
        return true;
    }

    protected function defaultdata()
    {
        // Set editor defaults
        $this->setVar('DefaultEditor', '-');
        $this->setVar('upload_path', 'userdata/Scribite');
        $this->setVar('image_upload', false);

        // set database module defaults
        $records = $this->getDefaultModuleConfig();
        foreach ($records as $record) {
            $modconfig  = new Scribite_Entity_Scribite();
            $modconfig->merge($record);
            $this->entityManager->persist($modconfig);
            $this->entityManager->flush();
        }
    }

    protected function renameColumns()
    {
        $prefix = $this->serviceManager['prefix'];
        $sqlStatements = array();
        $sqlStatements[] = 'RENAME TABLE ' . $prefix . '_scribite' . " TO `scribite`";
        $sqlStatements[] = "ALTER TABLE  `scribite` 
CHANGE  `pn_mid`  `mid` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `pn_modname`  `modname` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '',
CHANGE  `pn_modfunc`  `modfuncs` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `pn_modareas`  `modareas` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `pn_modeditor`  `modeditor` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '0'";

        $connection = Doctrine_Manager::getInstance()->getConnection('default');
        foreach ($sqlStatements as $sql) {
            $stmt = $connection->prepare($sql);
            try {
                $stmt->execute();
            } catch (Exception $e) {
                LogUtil::registerError($e->getMessage());
            }   
        }
    }
    
    /**
     * reset module to (possibly new) defaults
     * @param type $modname 
     */
    private function resetModuleConfig($modname)
    {
        $modconfig = $this->entityManager->getRepository('Scribite_Entity_Scribite')
                          ->findOneBy(array('modname' => $modname));

        if ($modconfig == false) {
            return;
        }

        $default = $this->getDefaultModuleConfig($modname);

        $modconfig['modfuncs'] = implode(',', $default['modfuncs']);
        $modconfig['modareas'] = implode(',', $default['modareas']);

        $modconfig->merge($newconfig);
        $this->entityManager->persist($modconfig);
        $this->entityManager->flush();
        return true;
    }

    /**
     * Default funcs/areas for each module
     * @param type $modname
     * @return array 
     */
    private function getDefaultModuleConfig($modname = null)
    {
        $defaults = array(
                'Blocks' => array('modname' => 'Blocks',
                        'modfuncs' => 'modify',
                        'modareas' => 'blocks_content',
                        'modeditor' => '-'),
                'Book' => array('modname' => 'Book',
                        'modfuncs' => 'all',
                        'modareas' => 'content',
                        'modeditor' => '-'),
                'ContentExpress' => array('modname' => 'ContentExpress',
                        'modfuncs' => 'newcontent,editcontent',
                        'modareas' => 'text',
                        'modeditor' => '-'),
                'crpCalendar' => array('modname' => 'crpCalendar',
                        'modfuncs' => 'new,modify',
                        'modareas' => 'crpcalendar_event_text',
                        'modeditor' => '-'),
                'crpVideo' => array('modname' => 'crpVideo',
                        'modfuncs' => 'new,modify',
                        'modareas' => 'video_content',
                        'modeditor' => '-'),
                'Downloads' => array('modname' => 'Downloads',
                        'modfuncs' => 'edit',
                        'modareas' => 'description',
                        'modeditor' => '-'),
                'FAQ' => array('modname' => 'FAQ',
                        'modfuncs' => 'newfaq,modify',
                        'modareas' => 'faqanswer',
                        'modeditor' => '-'),
                'htmlpages' => array('modname' => 'htmlpages',
                        'modfuncs' => 'new,modify',
                        'modareas' => 'htmlpages_content',
                        'modeditor' => '-'),
                'Mailer' => array('modname' => 'Mailer',
                        'modfuncs' => 'testconfig',
                        'modareas' => 'mailer_body',
                        'modeditor' => '-'),
                'Mediashare' => array('modname' => 'Mediashare',
                        'modfuncs' => 'addmedia,edititem,addalbum,editalbum',
                        'modareas' => 'all',
                        'modeditor' => '-'),
                'News' => array('modname' => 'News',
                        'modfuncs' => 'newitem",modify',
                        'modareas' => 'news_hometext,news_bodytext',
                        'modeditor' => '-'),
                'Newsletter' => array('modname' => 'Newsletter',
                        'modfuncs' => 'add_message',
                        'modareas' => 'message',
                        'modeditor' => '-'),
                'PagEd' => array('modname' => 'PagEd',
                        'modfuncs' => 'all',
                        'modareas' => 'PagEd',
                        'modeditor' => '-'),
                'Pages' => array('modname' => 'Pages',
                        'modfuncs' => 'newitem,modify}',
                        'modareas' => 'pages_content',
                        'modeditor' => '-'),
                'Clip' => array('modname' => 'Clip',
                        'modfuncs' => 'pubedit',
                        'modareas' => 'all',
                        'modeditor' => '-'),
                'PhotoGallery' => array('modname' => 'PhotoGallery',
                        'modfuncs' => 'editgallery,editphoto',
                        'modareas' => 'photogallery_desc',
                        'modeditor' => '-'),
                'Profile' => array('modname' => 'Profile',
                        'modfuncs' => 'modify',
                        'modareas' => 'prop_signature,prop_extrainfo,prop_yinterests',
                        'modeditor' => '-'),
                'PostCalendar' => array('modname' => 'PostCalendar',
                        'modfuncs' => 'all',
                        'modareas' => 'description',
                        'modeditor' => '-'),
                'Reviews' => array('modname' => 'Reviews',
                        'modfuncs' => 'new,modify',
                        'modareas' => 'reviews_review',
                        'modeditor' => '-'),
                'ShoppingCart' => array('modname' => 'ShoppingCart',
                        'modfuncs' => 'all',
                        'modareas' => 'description',
                        'modeditor' => '-'),
        );
        if (isset($modname)) {
            return $defaults[$modname];
        } else {
            return $defaults;
        }
    }
}
