<?php

/**
 * Copyright Scribite Team 2011
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @see https://github.com/zikula-modules/Scribite
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class Scribite_Controller_Ajax extends Zikula_Controller_AbstractAjax
{
    /**
     * handle new module/template override submission
     *
     * @return \Zikula_Response_Ajax
     */
    public function submitoverride()
    {
        // check security token
        $this->checkAjaxToken();

        // get POST data
        $action = $this->request->request->get('action', null);
        $rowid = $this->request->request->get('rowid', null);
        $modname = $this->request->request->get('modname', null);
        $editor = $this->request->request->get('editor', null);
        $area = $this->request->request->get('area', null);
        $disabled = $this->request->request->get('disabled', null);
        $params = $this->request->request->get('params', null);

        $deleting = (substr($action, 0, 6) == 'delete');

        // persist the values in the modvar table
        $overrides = ModUtil::getVar('Scribite', 'overrides');
        $paramsArray = [];
        $paramsString = '';
        if (empty($editor)) {
            // validate
            if (empty($area) || strpos($area, ",")) {
                return new Zikula_Response_Ajax_BadData($this->__('The textarea must have a value and cannot contain a comma.'));
            }
            // convert the name/value pair string to an array
            if (!empty($params) && !$deleting) {
                $params = explode(',', $params);
                foreach ($params as $param) {
                    if (strpos($param, ':')) {
                        list($k, $v) = explode(':', trim($param));
                        $paramsArray[trim($k)] = trim($v);
                        $paramsString .= trim($k) . ':' . trim($v) . ',';
                    } else {
                        $paramsArray = [];
                        $paramsString = '';
                        break;
                    }
                }
            }
            if ($area == 'all') {
                $editor = (isset($overrides[$modname]['editor'])) ? $overrides[$modname]['editor'] : null;
                unset($overrides[$modname]);
                if (!$deleting) {
                    $overrides[$modname]['all']['params'] = $paramsArray;
                }
                if (isset($editor)) {
                    $overrides[$modname]['editor'] = $editor;
                }
            } else {
                unset($overrides[$modname][$area]);
                if (!$deleting) {
                    $overrides[$modname][$area]['disabled'] = $disabled;
                    $overrides[$modname][$area]['params'] = $paramsArray;
                }
            }
        } else {
            if ($deleting) {
                unset($overrides[$modname]['editor']);
            } else {
                $overrides[$modname]['editor'] = $editor;
            }
        }

        ModUtil::setVar('Scribite', 'overrides', $overrides);

        // return successful result
        $vars = [
            'action' => $action,
            'rowid' => $rowid,
            'modname' => $modname,
            'editor' => $editor,
            'area' => $area,
            'disabled' => $disabled,
            'params' => rtrim($paramsString, ',')
        ];

        return new Zikula_Response_Ajax($vars);
    }

    public function upload() {
        // check security token        
        //$this->checkAjaxToken($this->request->query->get('csrftoken'));
        //$this->checkAjaxToken();

        $json = array();

        // Check user has permission
        if (!SecurityUtil::checkPermission('Upload::', '::', ACCESS_ADD)) {
            $json['error'] = 'Warning: You do not have permission to upload!';
        }

        $UploadDirectory = ModUtil::getVar('Scribite', 'UploadDirectory');

        $directory = rtrim($UploadDirectory, DIRECTORY_SEPARATOR . ' ');
        if (empty($directory)) {
            $directory = 'images/editoruploads';
        }

        $urldir = System::getBaseUrl() . $directory . '/';

        // Check and/or create directory
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        if (!is_dir($directory)) {
            $json['error'] = $this->__('Error: Can not create destination directory!');
        }

        $filename = '';

        if (!$json) {
            // Check if multiple files are uploaded or just one
            $request_files = $this->request->files->getCollection();
            $files = array();

            if (isset($request_files['upload']) && is_array($request_files['upload'])) {
                $files[] = array(
                    'name'     => $request_files['upload']['name'],
                    'type'     => $request_files['upload']['type'],
                    'tmp_name' => $request_files['upload']['tmp_name'],
                    'error'    => $request_files['upload']['error'],
                    'size'     => $request_files['upload']['size']
                );
            }

            // Allowed file extension types
            $upload_extallowed = '
zip
txt
png
jpe
jpeg
jpg
gif
bmp
ico
tiff
tif
svg
svgz
zip
rar
mp3
mp4
mov
pdf
psd
ai
eps
ps
doc
docx
';
            $extensions_allowed = explode("\n", $upload_extallowed);
            $extensions_allowed = array_map('trim', $extensions_allowed);

            // Allowed file mime types
            $upload_mimeallowed = '
text/plain
image/*
video/*
audio/*
application/*
';
            $mime_allowed = explode("\n", $upload_mimeallowed);
            $mime_allowed = array_map('trim', $mime_allowed);

            foreach ($files as $file) {
                if (is_file($file['tmp_name'])) {
                    // Sanitize the filename
                    $filename = basename(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));

                    // Validate the filename length
                    if ((mb_strlen($filename) < 3) || (mb_strlen($filename) > 255)) {
                        $json['error'] = $this->__('Error: Filename must be between 3 and 255!') . ' (' . $filename . ')';
                    }

                    // Check extension
                    $fileext = mb_substr(strrchr($filename, '.'), 1);
                    if (!in_array(mb_strtolower($fileext), $extensions_allowed)) {
                        $json['error'] = $this->__('Error: Incorrect file type!') . ' (' . $fileext . ')';
                    }

                    $filemimetype = $file['type'];
                    $mine_ok = in_array($filemimetype, $mime_allowed);
                    if (!$mine_ok) {
                        // check for "all" mime given as: image, video
                        $filemime = explode('/', $filemimetype);
                        if (isset($filemime[0]) && $filemime[0]) {
                            $mine_ok = in_array($filemime[0], $mime_allowed);
                            if (!$mine_ok) {
                                // check for "all" mime given as: image/*, video/*
                                $mine_ok = in_array($filemime[0] . '/*', $mime_allowed);
                            }
                        }
                    }
                    if (!$mine_ok) {
                        $json['error'] = $this->__('Error: Incorrect file type!') . ' (' . $filemimetype . ')';
                    }

                    // Return any upload error
                    if ($file['error'] != UPLOAD_ERR_OK) {
                        $json['error'] = $this->__('Error: File could not be uploaded!') . ' ' . $file['error'];
                    }
                } else {
                    $json['error'] = $this->__('Error: File could not be uploaded!');
                }

                if (!$json) {
                    if (!move_uploaded_file($file['tmp_name'], $directory . DIRECTORY_SEPARATOR . $filename)) {
                        $json['error'] = $this->__('Error: File could not be moved to destination directory!') . ' ' . $directory . DIRECTORY_SEPARATOR . $filename;
                    }
                }
            }
        }

        if (isset($json['error']) && $json['error']) {
            $json['uploaded'] = 0;
            $json['fileName'] = '';
            $json['url'] = '';
        } else {
            $json['uploaded'] = 1;
            $json['fileName'] = $filename;
            $json['url'] = $urldir . $filename;
        }

        //header('Content-Type: application/json', true, 200);
        //echo json_encode($json);
        return new Zikula_Response_Ajax_Json($json);
    }
}
