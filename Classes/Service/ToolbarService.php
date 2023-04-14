<?php

namespace WorldDirect\Buildinfo\Service;

use TYPO3\CMS\Core\Localization\LanguageService;
use WorldDirect\Buildinfo\Utility\BuildinfoUtility;
use TYPO3\CMS\Backend\Toolbar\Enumeration\InformationStatus;
use TYPO3\CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent;

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
 * ToolbarService
 *
 * @author Klaus Hörmann-Engl
 * @package WorldDirect\Buildinfo\Service
 */
class ToolbarService
{
    /**
     * Constant holding the language prefix
     */
    const LANG_PREFIX = 'LLL:EXT:buildinfo/Resources/Private/Language/locallang_db.xlf:';

    /**
     * The buildinfo utility.
     *
     * @var BuildinfoUtility
     */
    protected $buildinfoUtility = null;

    /**
     * Language service
     *
     * @var LanguageService
     */
    protected $languageService = null;

    /**
     * Constructor for new ToolbarService objects
     */
    public function __construct(BuildinfoUtility $buildinfoUtility)
    {
        $this->buildinfoUtility = $buildinfoUtility;
        $this->languageService = $GLOBALS['LANG'];
    }

    /**
     * Adds a certain information from a file to the SystemInformations toolbar.
     *
     * @param SystemInformationToolbarCollectorEvent $event The system information toolbar event
     * @param string $type Which type is it? "buildnumber", "
     * @param string $icon The desired icon to add
     * @param string $infoStatus The desired info status type
     *
     * @return void
     */
    public function addFileContentToSystemInformation(SystemInformationToolbarCollectorEvent $event, string $type, string $icon, string $infoStatus = InformationStatus::STATUS_INFO):void
    {
        // Get the info content for the specific type (timestamp, gitversion, ...)
        $infoContent = $this->buildinfoUtility->getFileContent($type);

        // IF the read content is not empty, add it to the toolbar items
        if ($infoContent != '') {
            $event->getToolbarItem()->addSystemInformation(
                $this->languageService->sL(self::LANG_PREFIX . 'buildinfo.' . $type . '.title'),
                $infoContent,
                $icon,
                $infoStatus
            );
        }
    }
}
