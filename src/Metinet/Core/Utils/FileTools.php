<?php

namespace Metinet\Core\Utils;

/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

class FileTools
{
    /**
     * @param $fullPathName Ex: /home/user01/file.log
     * @throws UnableToCreateFile
     */
    static public function createFileIfNotExists($fullPathName)
    {
        if (!file_exists($fullPathName)) {
            if (!is_dir(dirname($fullPathName))) {
                if (!mkdir(dirname($fullPathName), '0777', true)) {

                    throw UnableToCreateFile::permissionDenied($fullPathName);
                }
            }
        }
        if(!touch($fullPathName)) {
            throw UnableToCreateFile::permissionDenied($fullPathName);
        }
    }
}
