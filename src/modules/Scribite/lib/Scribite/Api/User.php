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
        if (!in_array($ex, $allowedExtensions)) {
            return LogUtil::registerError($this->__f('Error! Invalid file type: %1$s', $ex));
        }

        //Check file size
        if ($size >= 16000000) {
            return LogUtil::registerError($this->__('Error! Your file is too big. The limit is 14 MB.'));
        }

        $destination = $this->getVar('upload_path');
        $code = FileUtil::uploadFile('file', $destination);
        LogUtil::registerError(FileUtil::uploadErrorMsg($code));


        // create thumbnail
        $imagine = new Imagine\Gd\Imagine();
        $size = new Imagine\Image\Box(120, 120);
        $mode = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $imagine->open($destination . '/' . $name)
                ->thumbnail($size, $mode)
                ->save($destination . '/thumbs/' . $name);
    }

    /**
     * show images
     *
     * @param array $args file values
     * @return status(bool)
     */
    public function showImages($args)
    {
        $view = Zikula_View::getInstance('Scribite', false, null, true);

        $upload_path = $this->getVar('upload_path');
        $images = array();
        if ($handle = opendir($upload_path)) {

            $allowedExtensions = array('png', 'jpg', 'gif', 'jpeg');
            while (false !== ($file = readdir($handle))) {
                $extension = end(explode(".", $file));
                if (in_array($extension, $allowedExtensions)) {
                    $thumb = $upload_path . '/thumbs/' . $file;
                    if (!file_exists($thumb)) {
                        $thumb = $upload_path . '/' . $file;
                    }
                    $images[$thumb] = $file;
                }
            }

            closedir($handle);
        }

        $view->setCaching(false);
        $view->assign('images', $images);
        $view->assign('baseUrl', System::getBaseURL());


        return $view->fetch('user/showImages.tpl');
    }

}