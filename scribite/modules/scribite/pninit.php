<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @version    $Id$
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 * @category   Zikula_Extension
 * @package    Utilities
 * @subpackage scribite!
 */

function scribite_init()
{
    if (!DBUtil::createTable('scribite')) {
        return false;
    }

    // check for Zikula version, thi sversion only works with 1.0.2 and above
    // and create the system init hook
    if (PN_VERSION_NUM < '1.1.0' ) {
        LogUtil::registerError(_VERSIONHINT);
        return false;
    }

    if (!pnModRegisterHook('zikula', 'systeminit', 'GUI', 'scribite', 'user', 'run')) {
        return LogUtil::registerError(_ERRORCREATINGHOOK);
    }
    pnModAPIFunc('Modules', 'admin', 'enablehooks', array('callermodname' => 'zikula', 'hookmodname' => 'scribite'));
    LogUtil::registerStatus(_HOOKHINT);

    // create the default data for the module
    scribite_defaultdata();

    // Initialisation successful
    return true;
}

function scribite_upgrade($oldversion)
{

    switch($oldversion) {
        case '1.0':
            // no changes made
            return scribite_upgrade(1.1);
            break;
        case '1.1':
            // delete old paths
            pnModDelVar('scribite', 'xinha_path');
            pnModDelVar('scribite', 'tinymce_path');
            // set new path
            pnModSetVar('scribite', 'editors_path', 'javascript/scribite_editors');
            return scribite_upgrade(1.2);
            break;
        case '1.2':
            if (!DBUtil::createTable('scribite'))
            {
                return false;
            }
            // create the default data for the module
            scribite_defaultdata();
            // del old module vars
            pnModDelVar('scribite', 'editor');
            pnModDelVar('scribite', 'editor_activemodules');
            return scribite_upgrade(1.3);
            break;
        case '1.21':
            // create new values
            pnModSetVar('scribite', 'openwysiwyg_barmode', 'full');
            pnModSetVar('scribite', 'openwysiwyg_width', '400');
            pnModSetVar('scribite', 'openwysiwyg_height', '300');
            pnModSetVar('scribite', 'xinha_statusbar', 1);
            return scribite_upgrade(2.0);
            break;
        case '1.3':
            // create new values
            pnModSetVar('scribite', 'openwysiwyg_barmode', 'full');
            pnModSetVar('scribite', 'openwysiwyg_width', '400');
            pnModSetVar('scribite', 'openwysiwyg_height', '300');
            pnModSetVar('scribite', 'xinha_statusbar', 1);
            return scribite_upgrade(2.0);
            break;
        case '2.0':
            // create new values
            pnModSetVar('scribite', 'DefaultEditor', '-');
            pnModSetVar('scribite', 'nicedit_fullpanel', 1);
            // fill some vars with defaults
            if (!pnModGetVar('scribite', 'xinha_converturls')) {
                pnModSetVar('scribite', 'xinha_converturls', 1);
            }
            if (!pnModGetVar('scribite', 'xinha_showloading')) {
                pnModSetVar('scribite', 'xinha_showloading', 1);
            }
            if (!pnModGetVar('scribite', 'xinha_activeplugins')) {
                pnModSetVar('scribite', 'xinha_activeplugins', 'a:2:{i:0;s:7:"GetHtml";i:1;s:12:"SmartReplace";}');
            }
            if (!pnModGetVar('scribite', 'tinymce_ask')) {
                pnModSetVar('scribite', 'tinymce_ask', 0);
            }
            if (!pnModGetVar('scribite', 'tinymce_mcpuk')) {
                pnModSetVar('scribite', 'tinymce_mcpuk', 0);
            }
            if (!pnModGetVar('scribite', 'tinymce_activeplugins')) {
                pnModSetVar('scribite', 'tinymce_activeplugins', '');
            }
            if (!pnModGetVar('scribite', 'fckeditor_autolang')) {
                pnModSetVar('scribite', 'fckeditor_autolang', 1);
            }
            //create new module vars for crpCalendar
            $item = array('modname'   => 'crpCalendar',
                    'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                    'modareas'  => 'a:1:{i:0;s:22:"crpcalendar_event_text";}',
                    'modeditor' => '-');
            if (!DBUtil::insertObject($item, 'scribite', false, 'mid')) {
                return LogUtil::registerError(_CONFIGUPDATEFAILED);
            }
            return scribite_upgrade(2.1);
            break;
        case '2.1':
            //create new module vars for Content
            $record = array(array('modname'   => 'content',
                        'modfuncs'  => 'a:1:{i:0;s:5:"dummy";}',
                        'modareas'  => 'a:1:{i:0;s:5:"dummy";}',
                        'modeditor' => '-'));
            DBUtil::insertObjectArray($record, 'scribite', 'mid');
            return scribite_upgrade(2.2);
            break;
        case '2.2':
            //create new module vars for Blocks #14
            $record = array(array('modname'   => 'Blocks',
                        'modfuncs'  => 'a:1:{i:0;s:6:"modify";}',
                        'modareas'  => 'a:1:{i:0;s:14:"blocks_content";}',
                        'modeditor' => '-'));
            DBUtil::insertObjectArray($record, 'scribite', 'mid');
            // check for Zikula 1.1.x version
            if (PN_VERSION_NUM < '1.1.0' ) {
                LogUtil::registerError(_VERSIONHINT);
                break;
            }
            // create systeminit hook - new in Zikula 1.1.0
            if (!pnModRegisterHook('zikula', 'systeminit', 'GUI', 'scribite', 'user', 'run')) {
                return LogUtil::registerError(_ERRORCREATINGHOOK);
            }
            pnModAPIFunc('Modules', 'admin', 'enablehooks', array('callermodname' => 'zikula', 'hookmodname' => 'scribite'));
            LogUtil::registerStatus(_HOOKHINT);
            break;
    }

    // clear the cache folders
    $smarty =& new Smarty;
    $smarty->compile_dir = pnConfigGetVar('temp') . '/pnRender_compiled';
    $smarty->cache_dir = pnConfigGetVar('temp') . '/pnRender_cache';
    $smarty->use_sub_dirs = false;
    $smarty->clear_compiled_tpl();
    $smarty->clear_all_cache();

    return true;
}

function scribite_delete()
{
    // drop table
    if (!DBUtil::dropTable('scribite')) {
        return false;
    }

    // Delete any module variables
    pnModDelVar('scribite');

    // delete the system init hook
    if (!pnModUnregisterHook('zikula', 'systeminit', 'GUI', 'scribite', 'user', 'run')) {
        return LogUtil::registerError(_STATS_ERRORDELETINGHOOK);
    }
    // Deletion successful
    return true;
}

function scribite_defaultdata()
{
    // Set editor defaults
    pnModSetVar('scribite', 'editors_path', 'javascript/scribite_editors');
    pnModSetVar('scribite', 'xinha_language', 'en');
    pnModSetVar('scribite', 'xinha_skin', 'blue-look');
    pnModSetVar('scribite', 'xinha_barmode', 'reduced');
    pnModSetVar('scribite', 'xinha_width', 'auto');
    pnModSetVar('scribite', 'xinha_height', 'auto');
    pnModSetVar('scribite', 'xinha_style', 'modules/scribite/pnconfig/xinha/editor.css');
    pnModSetVar('scribite', 'xinha_statusbar', 1);
    pnModSetVar('scribite', 'xinha_converturls', 1);
    pnModSetVar('scribite', 'xinha_showloading', 1);
    pnModSetVar('scribite', 'xinha_activeplugins', 'a:2:{i:0;s:7:"GetHtml";i:1;s:12:"SmartReplace";}');
    pnModSetVar('scribite', 'tinymce_language', 'en');
    pnModSetVar('scribite', 'tinymce_style', 'modules/scribite/pnconfig/tiny_mce/editor.css');
    pnModSetVar('scribite', 'tinymce_theme', 'simple');
    pnModSetVar('scribite', 'tinymce_width', '75%');
    pnModSetVar('scribite', 'tinymce_height', '400');
    pnModSetVar('scribite', 'tinymce_dateformat', '%Y-%m-%d');
    pnModSetVar('scribite', 'tinymce_timeformat', '%H:%M:%S');
    pnModSetVar('scribite', 'tinymce_ask', 0);
    pnModSetVar('scribite', 'tinymce_mcpuk', 0);
    pnModSetVar('scribite', 'tinymce_activeplugins', '');
    pnModSetVar('scribite', 'fckeditor_language', 'en');
    pnModSetVar('scribite', 'fckeditor_barmode', 'Default');
    pnModSetVar('scribite', 'fckeditor_width', '500');
    pnModSetVar('scribite', 'fckeditor_height', '400');
    pnModSetVar('scribite', 'fckeditor_autolang', 1);
    pnModSetVar('scribite', 'openwysiwyg_barmode', 'full');
    pnModSetVar('scribite', 'openwysiwyg_width', '400');
    pnModSetVar('scribite', 'openwysiwyg_height', '300');
    pnModSetVar('scribite', 'nicedit_fullpanel', 0);

    // set database module defaults
    $record = array(array('modname'   => 'About',
                'modfuncs'  => 'a:1:{i:0;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:10:"about_info";}',
                'modeditor' => '-'),
            array('modname'   => 'Admin_Messages',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:22:"admin_messages_content";}',
                'modeditor' => '-'),
            array('modname'   => 'Blocks',
                'modfuncs'  => 'a:1:{i:0;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:14:"blocks_content";}',
                'modeditor' => '-'),
            array('modname'   => 'Book',
                'modfuncs'  => 'a:1:{i:0;s:3:"all";}',
                'modareas'  => 'a:1:{i:0;s:7:"content";}',
                'modeditor' => '-'),
            array('modname'   => 'ContentExpress',
                'modfuncs'  => 'a:3:{i:0;s:0:"";i:1;s:10:"newcontent";i:2;s:11:"editcontent";}',
                'modareas'  => 'a:1:{i:0;s:4:"text";}',
                'modeditor' => '-'),
            array('modname'   => 'crpCalendar',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:22:"crpcalendar_event_text";}',
                'modeditor' => '-'),
            array('modname'   => 'cotype',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:4:"edit";}',
                'modareas'  => 'a:1:{i:0;s:4:"text";}',
                'modeditor' => '-'),
            array('modname'   => 'content',
                'modfuncs'  => 'a:1:{i:0;s:3:"dummy";}',
                'modareas'  => 'a:1:{i:0;s:4:"dummy";}',
                'modeditor' => '-'),
            array('modname'   => 'element',
                'modfuncs'  => 'a:5:{i:0;s:11:"start_topic";i:1;s:9:"add_topic";i:2;s:10:"edit_topic";i:3;s:10:"view_topic";i:4;s:9:"edit_post";}',
                'modareas'  => 'a:1:{i:0;s:4:"comm";}',
                'modeditor' => '-'),
            array('modname'   => 'eventia',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:26:"eventia_course_description";}',
                'modeditor' => '-'),
            array('modname'   => 'FAQ',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:9:"faqanswer";}',
                'modeditor' => '-'),
            array('modname'   => 'htmlpages',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:17:"htmlpages_content";}',
                'modeditor' => '-'),
            array('modname'   => 'Mailer',
                'modfuncs'  => 'a:1:{i:0;s:10:"testconfig";}',
                'modareas'  => 'a:1:{i:0;s:11:"mailer_body";}',
                'modeditor' => '-'),
            array('modname'   => 'mediashare',
                'modfuncs'  => 'a:2:{i:0;s:8:"addmedia";i:1;s:8:"edititem";}',
                'modareas'  => 'a:1:{i:0;s:3:"all";}',
                'modeditor' => '-'),
            array('modname'   => 'News',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:2:{i:0;s:13:"news_hometext";i:1;s:13:"news_bodytext";}',
                'modeditor' => '-'),
            array('modname'   => 'PagEd',
                'modfuncs'  => 'a:1:{i:0;s:3:"all";}',
                'modareas'  => 'a:1:{i:0;s:5:"PagEd";}',
                'modeditor' => '-'),
            array('modname'   => 'Pages',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:13:"pages_content";}',
                'modeditor' => '-'),
            array('modname'   => 'pagesetter',
                'modfuncs'  => 'a:1:{i:0;s:7:"pubedit";}',
                'modareas'  => 'a:1:{i:0;s:3:"all";}',
                'modeditor' => '-'),
            array('modname'   => 'PhotoGallery',
                'modfuncs'  => 'a:2:{i:0;s:11:"editgallery";i:1;s:9:"editphoto";}',
                'modareas'  => 'a:1:{i:0;s:17:"photogallery_desc";}',
                'modeditor' => '-'),
            array('modname'   => 'pncommerce',
                'modfuncs'  => 'a:1:{i:0;s:8:"itemedit";}',
                'modareas'  => 'a:1:{i:0;s:15:"ItemDescription";}',
                'modeditor' => '-'),
            array('modname'   => 'pnForum',
                'modfuncs'  => 'a:4:{i:0;s:9:"viewtopic";i:1;s:8:"newtopic";i:2;s:8:"editpost";i:3;s:5:"reply";}',
                'modareas'  => 'a:1:{i:0;s:7:"message";}',
                'modeditor' => '-'),
            array('modname'   => 'pnhelp',
                'modfuncs'  => 'a:1:{i:0;s:4:"edit";}',
                'modareas'  => 'a:1:{i:0;s:4:"text";}',
                'modeditor' => '-'),
            array('modname'   => 'pnMessages',
                'modfuncs'  => 'a:2:{i:0;s:5:"newpm";i:1;s:10:"replyinbox";}',
                'modareas'  => 'a:1:{i:0;s:7:"message";}',
                'modeditor' => '-'),
            array('modname'   => 'pnWebLog',
                'modfuncs'  => 'a:2:{i:0;s:10:"addposting";i:1;s:7:"addpage";}',
                'modareas'  => 'a:1:{i:0;s:9:"xinhatext";}',
                'modeditor' => '-'),
            array('modname'   => 'Profile',
                'modfuncs'  => 'a:1:{i:0;s:6:"modify";}',
                'modareas'  => 'a:3:{i:0;s:9:"signature";i:1;s:9:"extrainfo";i:2;s:10:"yinterests";}',
                'modeditor' => '-'),
            array('modname'   => 'PostCalendar',
                'modfuncs'  => 'a:1:{i:0;s:6:"submit";}',
                'modareas'  => 'a:1:{i:0;s:11:"description";}',
                'modeditor' => '-'),
            array('modname'   => 'Reviews',
                'modfuncs'  => 'a:2:{i:0;s:3:"new";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:14:"reviews_review";}',
                'modeditor' => '-'),
            array('modname'   => 'ShoppingCart',
                'modfuncs'  => 'a:1:{i:0;s:3:"all";}',
                'modareas'  => 'a:1:{i:0;s:11:"description";}',
                'modeditor' => '-'),
            array('modname'   => 'tFAQ',
                'modfuncs'  => 'a:2:{i:0;s:4:"view";i:1;s:6:"modify";}',
                'modareas'  => 'a:1:{i:0;s:8:"tfanswer";}',
                'modeditor' => '-'));
    DBUtil::insertObjectArray($record, 'scribite', 'mid');

}

