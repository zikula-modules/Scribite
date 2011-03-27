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
        if (!DBUtil::createTable('scribite')) {
            return false;
        }

        EventUtil::registerPersistentModuleHandler('Scribite', 'core.postinit', array('Scribite_Listeners', 'coreinit'));

        // create the default data for the module
        $this->defaultdata();

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
                if (!DBUtil::createTable('scribite')) {
                    return false;
                }
                // create the default data for the module
                scribite_defaultdata();
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
                $item = array('modname' => 'crpCalendar',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:22:"crpcalendar_event_text";}',
                        'modeditor' => '-');
                if (!DBUtil::insertObject($item, 'scribite', false, 'mid')) {
                    LogUtil::registerError($this->__('Error! Could not update module configuration.'));
                    return '2.0';
                }

            case '2.1':
                //create new module vars for Content
                $record = array(array('modname' => 'content',
                                'modfuncs' => 'a:1:{i:0;s:5:"dummy";}',
                                'modareas' => 'a:1:{i:0;s:5:"dummy";}',
                                'modeditor' => '-'));
                DBUtil::insertObjectArray($record, 'scribite', 'mid');

            case '2.2':
                //create new module vars for Blocks #14
                $record = array(array('modname' => 'Blocks',
                                'modfuncs' => 'a:1:{i:0;s:6:"modify";}',
                                'modareas' => 'a:1:{i:0;s:14:"blocks_content";}',
                                'modeditor' => '-'));
                DBUtil::insertObjectArray($record, 'scribite', 'mid');
                // check for Zikula 1.1.x version
                if (Zikula_Core::VERSION_NUM < '1.1.0') {
                    LogUtil::registerError($this->__('This version from scribite! only works with Zikula 1.1.x and higher. Please upgrade your Zikula version or use scribite! version 2.x .'));
                    return '2.2';
                }
                // create systeminit hook - new in Zikula 1.1.0
                if (!ModUtil::registerHook('zikula', 'systeminit', 'GUI', 'scribite', 'user', 'run')) {
                    LogUtil::registerError($this->__('Error creating Hook!'));
                    return '2.2';
                }
                ModUtil::apiFunc('Modules', 'admin', 'enablehooks', array('callermodname' => 'zikula', 'hookmodname' => 'scribite'));
                LogUtil::registerStatus($this->__('<strong>scribite!</strong> was activated as core hook. You can check settings <a href="index.php?module=Modules&type=admin&func=hooks&id=0">here</a>!<br />The template plugin from previous versions of scribite! can be removed from templates.'));

            case '3.0':
                //create new module vars for Newsletter and Web_Links
                $record = array(array('modname' => 'Newsletter',
                                'modfuncs' => 'a:1:{i:0;s:11:"add_message";}',
                                'modareas' => 'a:1:{i:0;s:7:"message";}',
                                'modeditor' => '-'),
                        array('modname' => 'crpVideo',
                                'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                                'modareas' => 'a:1:{i:0;s:13:"video_content";}',
                                'modeditor' => '-'),
                        array('modname' => 'Web_Links',
                                'modfuncs' => 'a:3:{i:0;s:8:"linkview";i:1;s:7:"addlink";i:2;s:17:"modifylinkrequest";}',
                                'modareas' => 'a:1:{i:0;s:11:"description";}',
                                'modeditor' => '-'));
                DBUtil::insertObjectArray($record, 'scribite', 'mid');

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
                $this->setVar('editors_path', 'modules/scribite/pnincludes');
                LogUtil::registerStatus($this->__('<strong>Caution!</strong><br />All editors have moved to /modules/scribite/pnincludes in preparation for upcoming features of Zikula. Please check all your settings!<br />If you have adapted files from editors you have to check them too.<br /><br /><strong>Dropped support for FCKeditor and TinyMCE</strong><br />For security reasons these editors will not be supported anymore. Please change editors to an other editor.'));

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
                if (!$this->getVar('ckeditor_width')) {
                    $this->setVar('ckeditor_width', '"100%"');
                }
                if (!$this->getVar('ckeditor_height')) {
                    $this->setVar('ckeditor_height', '400');
                }

            case '4.2.2':
                $this->renameColumns();
                EventUtil::registerPersistentModuleHandler('Scribite', 'core.postinit', array('Scribite_Listeners', 'coreinit'));
                $this->setVar('editors_path', 'modules/Scribite/includes');
                LogUtil::registerStatus($this->__('<strong>Caution!</strong><br />All editors have moved to /modules/Scribite/includes.<br />If you have adapted files from editors you have to check them too.'));
            case '4.2.3':
        }

        return true;
    }

    public function uninstall()
    {
        // drop table
        if (!DBUtil::dropTable('scribite')) {
            return false;
        }

        // Delete any module variables
        $this->delVars();

        EventUtil::unregisterPersistentModuleHandler('Scribite', 'core.postinit', array('Scribite_Listeners', 'coreinit'));
        // Deletion successful
        return true;
    }

    protected function defaultdata()
    {
        // Set editor defaults
        $this->setVar('editors_path', 'modules/Scribite/includes');

        // xinha
        $this->setVar('xinha_language', 'en');
        $this->setVar('xinha_skin', 'blue-look');
        $this->setVar('xinha_barmode', 'reduced');
        $this->setVar('xinha_width', 'auto');
        $this->setVar('xinha_height', 'auto');
        $this->setVar('xinha_style', 'modules/Scribite/config/xinha/editor.css');
        $this->setVar('xinha_statusbar', 1);
        $this->setVar('xinha_converturls', 1);
        $this->setVar('xinha_showloading', 1);
        $this->setVar('xinha_activeplugins', 'a:2:{i:0;s:7:"GetHtml";i:1;s:12:"SmartReplace";}');

        /* deprecated editors
          // tinymce
          $this->setVar('tinymce_language', 'en');
          $this->setVar('tinymce_style', 'modules/Scribite/config/tiny_mce/editor.css');
          $this->setVar('tinymce_theme', 'simple');
          $this->setVar('tinymce_width', '75%');
          $this->setVar('tinymce_height', '400');
          $this->setVar('tinymce_dateformat', '%Y-%m-%d');
          $this->setVar('tinymce_timeformat', '%H:%M:%S');
          $this->setVar('tinymce_activeplugins', '');

          // fckeditor
          $this->setVar('fckeditor_language', 'en');
          $this->setVar('fckeditor_barmode', 'Default');
          $this->setVar('fckeditor_width', '500');
          $this->setVar('fckeditor_height', '400');
          $this->setVar('fckeditor_autolang', 1);
         */

        // openwysiwyg
        $this->setVar('openwysiwyg_barmode', 'full');
        $this->setVar('openwysiwyg_width', '400');
        $this->setVar('openwysiwyg_height', '300');
        $this->setVar('nicedit_fullpanel', 0);

        // nicedit
        $this->setVar('nicedit_xhtml', 0);

        // yui
        $this->setVar('yui_type', 'Simple');
        $this->setVar('yui_width', 'auto');
        $this->setVar('yui_height', '300');
        $this->setVar('yui_dombar', true);
        $this->setVar('yui_animate', true);
        $this->setVar('yui_collapse', true);

        // ckeditor
        $this->setVar('ckeditor_language', 'en');
        $this->setVar('ckeditor_barmode', 'Full');
        $this->setVar('ckeditor_width', '"100%"');
        $this->setVar('ckeditor_height', '400');

        // set database module defaults
        $record = array(
                array('modname' => 'Blocks',
                        'modfuncs' => 'a:1:{i:0;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:14:"blocks_content";}',
                        'modeditor' => '-'),
                array('modname' => 'Book',
                        'modfuncs' => 'a:1:{i:0;s:3:"all";}',
                        'modareas' => 'a:1:{i:0;s:7:"content";}',
                        'modeditor' => '-'),
                array('modname' => 'ContentExpress',
                        'modfuncs' => 'a:3:{i:0;s:0:"";i:1;s:10:"newcontent";i:2;s:11:"editcontent";}',
                        'modareas' => 'a:1:{i:0;s:4:"text";}',
                        'modeditor' => '-'),
                array('modname' => 'crpCalendar',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:22:"crpcalendar_event_text";}',
                        'modeditor' => '-'),
                array('modname' => 'crpVideo',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:13:"video_content";}',
                        'modeditor' => '-'),
                array('modname' => 'FAQ',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:9:"faqanswer";}',
                        'modeditor' => '-'),
                array('modname' => 'htmlpages',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:17:"htmlpages_content";}',
                        'modeditor' => '-'),
                array('modname' => 'Mailer',
                        'modfuncs' => 'a:1:{i:0;s:10:"testconfig";}',
                        'modareas' => 'a:1:{i:0;s:11:"mailer_body";}',
                        'modeditor' => '-'),
                array('modname' => 'Mediashare',
                        'modfuncs' => 'a:3:{i:0;s:8:"addmedia";i:1;s:8:"edititem";i:2;s:8:"addalbum";i:3;s:9:"editalbum";}',
                        'modareas' => 'a:1:{i:0;s:3:"all";}',
                        'modeditor' => '-'),
                array('modname' => 'News',
                        'modfuncs' => 'a:3:{i:0;s:3:"new";i:1;s:6:"modify";i:2;s:7:"display";}',
                        'modareas' => 'a:2:{i:0;s:13:"news_hometext";i:1;s:13:"news_bodytext";}',
                        'modeditor' => '-'),
                array('modname' => 'Newsletter',
                        'modfuncs' => 'a:1:{i:0;s:11:"add_message";}',
                        'modareas' => 'a:1:{i:0;s:7:"message";}',
                        'modeditor' => '-'),
                array('modname' => 'PagEd',
                        'modfuncs' => 'a:1:{i:0;s:3:"all";}',
                        'modareas' => 'a:1:{i:0;s:5:"PagEd";}',
                        'modeditor' => '-'),
                array('modname' => 'Pages',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:13:"pages_content";}',
                        'modeditor' => '-'),
                array('modname' => 'Clip',
                        'modfuncs' => 'a:1:{i:0;s:7:"pubedit";}',
                        'modareas' => 'a:1:{i:0;s:3:"all";}',
                        'modeditor' => '-'),
                array('modname' => 'PhotoGallery',
                        'modfuncs' => 'a:2:{i:0;s:11:"editgallery";i:1;s:9:"editphoto";}',
                        'modareas' => 'a:1:{i:0;s:17:"photogallery_desc";}',
                        'modeditor' => '-'),
                array('modname' => 'Profile',
                        'modfuncs' => 'a:1:{i:0;s:6:"modify";}',
                        'modareas' => 'a:3:{i:0;s:14:"prop_signature";i:1;s:14:"prop_extrainfo";i:2;s:15:"prop_yinterests";}',
                        'modeditor' => '-'),
                array('modname' => 'PostCalendar',
                        'modfuncs' => 'a:1:{i:0;s:3:"all";}',
                        'modareas' => 'a:1:{i:0;s:11:"description";}',
                        'modeditor' => '-'),
                array('modname' => 'Reviews',
                        'modfuncs' => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                        'modareas' => 'a:1:{i:0;s:14:"reviews_review";}',
                        'modeditor' => '-'),
                array('modname' => 'ShoppingCart',
                        'modfuncs' => 'a:1:{i:0;s:3:"all";}',
                        'modareas' => 'a:1:{i:0;s:11:"description";}',
                        'modeditor' => '-'),
        );
        DBUtil::insertObjectArray($record, 'scribite', 'mid');
    }

    protected function renameColumns()
    {
        $prefix = $GLOBALS['ZConfig']['System']['prefix'];
        $sql = "ALTER TABLE  `{$prefix}_scribite` CHANGE  `pn_mid`  `z_mid` INT( 11 ) NOT NULL AUTO_INCREMENT ,
CHANGE  `pn_modname`  `z_modname` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '',
CHANGE  `pn_modfunc`  `z_modfuncs` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `pn_modareas`  `z_modareas` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `pn_modeditor`  `z_modeditor` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '0'";

        $connection = Doctrine_Manager::getInstance()->getCurrentConnection();
        try {
            $stmt = $connection->prepare($sql);
            $stmt->execute();
        } catch (Exception $e) {
            LogUtil::registerError($e->getMessage());
        }
    }

}
