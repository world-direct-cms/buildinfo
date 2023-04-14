<?php

namespace WorldDirect\Buildinfo\Utility;

use TYPO3\CMS\Core\Core\Environment;
use WorldDirect\Buildinfo\Utility\BasicUtility;
use TYPO3\CMS\Core\Localization\Exception\FileNotFoundException;

/*
 * This file is part of the TYPO3 extension "worlddirect/buildinfo".
 *
 * (c) Klaus Hörmann-Engl <klaus.hoermann-engl@world-direct.at>
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

/**
 * Buildinfo Utility
 *
 * @author Klaus Hörmann-Engl
 * @package WorldDirect\Buildinfo\Utility
 */
class BuildinfoUtility
{
    /**
     * Extension configuration
     *
     * @var array<string>
     */
    protected $extConf = null;

    /**
     * The project path
     *
     * @var string
     */
    protected $projectPath = '';

    /**
     * Constructor for new BuildinfoUtility objects.
     *
     * @return void
     */
    public function __construct()
    {
        $this->extConf = BasicUtility::getConfiguration('tx_buildinfo');
        $this->projectPath = Environment::getProjectPath() . '/';
    }

    /**
     * Method returns the file content of a certain type. The function takes a look
     * into the configuration and reads the correct file from disc and return the
     * value.
     *
     * @param string $type The desired typ
     *
     * @return string The type file content
     */
    public function getFileContent(string $type): string
    {
        $file = $type . 'File';

        // Check if the TypoScript settings exists
        if (isset($this->extConf[$file]) && $this->extConf[$file] != '') {
            $infoFile = $this->projectPath . $this->extConf[$file];
            if (file_exists($infoFile) && !empty($infoFile)) {
                return $this->getFormattedFileContent($infoFile, $type);
            }
        }

        // The typoscript settings are not set, therefore return empty
        return '';
    }

    /**
     * Function gets the file and the type of the information.
     * Depending on the type of information the content of file a formatting of this content
     * may happen.
     *
     * @param string $file The file with the content to be formatted
     * @param string $type The type of information
     *
     * @return string The formatted content of the file
     */
    private function getFormattedFileContent(string $file, string $type)
    {
        switch ($type) {
            case 'buildTimestamp':
                $timestamp = '';
                $fileContent = file_get_contents($file);
                if ($fileContent) {
                    $timestamp = $fileContent;
                }
                return BasicUtility::formatTimestamp(intval($timestamp));
            default:
                $fileContent = file_get_contents($file);
                if ($fileContent) {
                    return $fileContent;
                } else {
                    throw new FileNotFoundException();
                }
        }
    }
}
