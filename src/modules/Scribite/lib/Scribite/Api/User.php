<?php
/**
 * Zikula Application Framework
 *
 * @copyright  (c) Zikula Development Team
 * @link       http://www.zikula.org
 * @license    GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @author     sven schomacker <hilope@gmail.com>
 */
class Scribite_Api_User extends Zikula_AbstractApi
{
    // load module config from db into array or list all modules with config
    public function getModuleConfig($args)
    {
        if (!isset($args['modulename'])) {
            $args['modulename'] = ModUtil::getName();
        }

        $modconfig = array();
        if ($args['modulename'] == 'list') {
            $modconfig = DBUtil::selectObjectArray('scribite', '', 'modname');
        } else {
            $dbtables = DBUtil::getTables();
            $scribitecolumn = $dbtables['scribite_column'];
            $where = "$scribitecolumn[modname] = '" . $args['modulename'] . "'";
            $item = DBUtil::selectObjectArray('scribite', $where);

            if ($item == false) {
                return;
            }

            $modconfig['mid'] = $item[0]['mid'];
            $modconfig['modulename'] = $item[0]['modname'];
            if (!is_int($item[0]['modfuncs'])) {
                $modconfig['modfuncs'] = unserialize($item[0]['modfuncs']);
            }
            if (!is_int($item[0]['modareas'])) {
                $modconfig['modareas'] = unserialize($item[0]['modareas']);
            }
            $modconfig['modeditor'] = $item[0]['modeditor'];
        }
        return $modconfig;
    }

    // read editors folder and load names into array
    // has to be changed with args!!
    public function getEditors($args)
    {

        $editors = array();


        $path = 'modules/Scribite/plugins';
        $plugins = FileUtil::getFiles($path, false, true, null, 'd');



        $editors = array();

        foreach ($plugins as $pluginName) {

            $className = 'ModulePlugin_Scribite_'.$pluginName.'_Plugin';
            $instance = PluginUtil::loadPlugin($className);
            $pluginstate = PluginUtil::getState($instance->getServiceId(), PluginUtil::getDefaultState());
            if ($pluginstate['state'] == 1) {
                $editors[$pluginName] = $instance->getMetaDisplayName();
            }
        }

        // Add "-" as default for no editor
        $editors['-'] = '-';
        
        asort($editors);
        return $editors;
        
    }

    public function getEditorTitle($args)
    {
        if (!PluginUtil::isAvailable('moduleplugin.scribite.'.$args['editorname'])) {
            return '';
        }

        $className = 'ModulePlugin_Scribite_'.$args['editorname'].'_Plugin';
        $instance = PluginUtil::loadPlugin($className);
        return $instance->getMetaDisplayName();
    }

    // load IM/EFM settings for Xinha and pass vars to session
    // not implemented yet ;)
    public function getEFMConfig($args)
    {
        // get editors path and load xinha scripts
        $editors_path = $this->getVar('editors_path');
        require_once $editors_path . '/xinha/contrib/php-xinha.php';

        $zikulaBaseURI = rtrim(System::getBaseUri(), '/');
        $zikulaBaseURI = ltrim($zikulaBaseURI, '/');
        $zikulaRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

        // define backend configuration for the plugin
        $IMConfig = array();
        $IMConfig['images_dir'] = '/files/';
        $IMConfig['images_url'] = 'files/';
        $IMConfig['files_dir'] = '/files/';
        $IMConfig['files_url'] = 'files';
        $IMConfig['thumbnail_prefix'] = 't_';
        $IMConfig['thumbnail_dir'] = 't';
        $IMConfig['resized_prefix'] = 'resized_';
        $IMConfig['resized_dir'] = '';
        $IMConfig['tmp_prefix'] = '_tmp';
        $IMConfig['max_filesize_kb_image'] = 2000;
        // maximum size for uploading files in 'insert image' mode (2000 kB here)

        $IMConfig['max_filesize_kb_link'] = 5000;
        // maximum size for uploading files in 'insert link' mode (5000 kB here)
        // Maximum upload folder size in Megabytes.
        // Use 0 to disable limit
        $IMConfig['max_foldersize_mb'] = 0;

        $IMConfig['allowed_image_extensions'] = array("jpg", "gif", "png");
        $IMConfig['allowed_link_extensions'] = array("jpg", "gif", "pdf", "ip", "txt",
                "psd", "png", "html", "swf",
                "xml", "xls");

        xinha_pass_to_php_backend($IMConfig);
        return $IMConfig;
    }

    /**
     * Initialise Scribite for requested areas.
     *
     * @param array $args Text area: 'area', Module name: 'modulename'.
     *
     * @return string
     */
    public static function loader($args)
    {
        $dom = ZLanguage::getModuleDomain('Scribite');
        // Argument checks
        if (!isset($args['areas'])) {
            return LogUtil::registerError(__('Error! Scribite_Api_User::loader() "area" argument was empty.', $dom));
        }
        if (!isset($args['modulename'])) {
            $args['modulename'] = ModUtil::getName();
        }

        $module = $args['modulename'];

        // Security check if user has COMMENT permission for Scribite and module
        if (!SecurityUtil::checkPermission('Scribite::', "$module::", ACCESS_COMMENT)) {
            return;
        }

        // check for editor argument, if none given the default editor will be used
        if (!isset($args['editor']) || empty($args['editor'])) {
            // get default editor from config
            $defaulteditor = ModUtil::getVar('Scribite', 'DefaultEditor');
            if ($defaulteditor == '-') {
                return; // return if no default is set and no arg is given
                // id given editor doesn't exist use default editor
            } else {
                $args['editor'] = $defaulteditor;
            }
        }

        // check if editor argument exists, load default if not given
        if (ModUtil::apiFunc('Scribite', 'user', 'getEditors', array('editorname' => $args['editor']))) {

            // set some general parameters
            $zBaseUrl = rtrim(System::getBaseUrl(), '/');
            $zikulaThemeBaseURL = "$zBaseUrl/themes/" . DataUtil::formatForOS(UserUtil::getTheme());
            $zikulaBaseURI = rtrim(System::getBaseUri(), '/');
            $zikulaBaseURI = ltrim($zikulaBaseURI, '/');
            $zikulaRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');

            // prepare view instance
            //$view = Zikula_View::getInstance('Scribite');
            $view = Zikula_View_Plugin::getModulePluginInstance('Scribite', $args['editor']);


            $view->setCaching(false);
            //$view->assign(ModUtil::getVar('Scribite'));
            $view->assign(ModUtil::getVar("moduleplugin.scribite.".strtolower($args['editor'])));
            $view->assign('modname', $args['modulename']);
            $view->assign('zBaseUrl', $zBaseUrl);
            $view->assign('zikulaBaseURI', $zikulaBaseURI);
            $view->assign('zikulaRoot', $zikulaRoot);
            $view->assign('editor_dir', $args['editor']);
            $view->assign('zlang', ZLanguage::getLanguageCode());

            // check for modules installed providing plugins and load specific javascripts
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

            if ($args['areas'][0] == "all") {
                $args['areas'] = 'all';
            }
            // set parameters
            $view->assign('modareas', $args['areas']);

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
            $classname = 'ModulePlugin_Scribite_'.$args['editor'].'_Plugin';
            if (method_exists($classname,'addParameters')) {
                $additionalEditorParameters = $classname::addParameters();
                $view->assign($additionalEditorParameters);
            }

            
            // view output
            // 1. check if special template is required (from direct module call)
            if (isset($args['tpl']) && $view->template_exists($args['tpl'])) {
                $templatefile = $args['tpl'];
                // 2. check if a module specific template exists
            } elseif ($view->template_exists('editorheaders/' . $args['editor'] . '_' . $args['modulename'] . '.tpl')) {
                $templatefile = 'editorheaders/' . $args['editor'] . '_' . $args['modulename'] . '.tpl';
                // 3. if none of the above load default template
            } else {
                $templatefile = 'editorheaders/' . $args['editor'] . '.tpl';
            }
            $output = $view->fetch($templatefile);
            // end main switch

            return $output;
        }
    }
    
    
    /**
     * upload file
     *
     * @param array $args file values
     * @return status(bool)
     */
    public function uploadFile($args)
    {
        // Security check
        if (!SecurityUtil::checkPermission('Scribite::', '::', ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }
        
        
        if (count($args) == 0) {
            $args = $_FILES['file'];
        }            
            
        extract($args);
        
        
        //Check file extension
        $allowedExtensions = array('png', 'jpg', 'gif', 'jpeg');
        $ex = end(explode(".", $name));
        if ( !in_array($ex, $allowedExtensions) ) {
            return LogUtil::registerError($this->__f('Error! Invalid file type: %1$s', $ex));
        }

        //Check file size
        if($size >= 16000000) {
            return LogUtil::registerError($this->__('Error! Your file is too big. The limit is 14 MB.'));
        }

        $destination  = $this->getVar('upload_path');
        $code = FileUtil::uploadFile('file', $destination);
        LogUtil::registerError(FileUtil::uploadErrorMsg($code));

        
        // create thumbnail
        $imagine = new Imagine\Gd\Imagine();
        $size    = new Imagine\Image\Box(120, 120);
        $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $imagine->open($destination.'/'.$name)
                ->thumbnail($size, $mode)
                ->save($destination.'/thumbs/'.$name);
    }
    
    /**
     * show images
     *
     * @param array $args file values
     * @return status(bool)
     */
    public function showImages($args) {
        $view = Zikula_View::getInstance('Scribite', false, null, true);        
        
        $upload_path = $this->getVar('upload_path');
        $images = array();
        if ($handle = opendir($upload_path)) {

            $allowedExtensions = array('png', 'jpg', 'gif', 'jpeg');
            while (false !== ($file = readdir($handle))) {
                $extension = end(explode(".", $file));
                if ( in_array($extension, $allowedExtensions) ) {
                    $thumb = $upload_path.'/thumbs/'.$file;
                    if(!file_exists($thumb)) {
                        $thumb = $upload_path.'/'.$file;
                    }                    
                    $images[$thumb] = $file;
                }
            }

            closedir($handle);
        }

        $view->setCaching(false);
        $view->assign('images', $images );
        $view->assign('baseUrl', System::getBaseURL() );
        
        
        return $view->fetch('user/showImages.tpl');
    }
    
    
}