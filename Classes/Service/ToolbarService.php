<?php

namespace WorldDirect\Buildinfo\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use TYPO3\CMS\Backend\Backend\Event\SystemInformationToolbarCollectorEvent;
use TYPO3\CMS\Backend\Toolbar\Enumeration\InformationStatus;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Localization\LanguageService;
use WorldDirect\Buildinfo\Utility\BasicUtility;

class ToolbarService
{
    /**
     * Constant holding the language prefix
     */
    const LANG_PREFIX = 'LLL:EXT:buildinfo/Resources/Private/Language/locallang_db.xlf:';

    /**
     * Extension configuration
     *
     * @var array<string>
     */
    protected $extConf = null;

    /**
     * Language service
     *
     * @var LanguageService
     */
    protected $languageService = null;

    /**
     * The project path
     *
     * @var string
     */
    protected $projectPath = '';

    /**
     * Constructor for new ToolbarService objects
     */
    public function __construct()
    {
        $this->languageService = $GLOBALS['LANG'];
        $this->extConf = BasicUtility::getConfiguration('tx_buildinfo');
        $this->projectPath = Environment::getProjectPath() . '/';
    }

    /**
     * Adds a certain information from a file to the SystemInformations toolbar.
     *
     * @param SystemInformationToolbarCollectorEvent $event The system information toolbar event
     * @param string $type Which type is it?
     * @param string $icon The desired icon to add
     * @param string $infoStatus The desired info status type
     *
     * @return void
     */
    public function addFileContentToSystemInformation(SystemInformationToolbarCollectorEvent $event, string $type, string $icon, string $infoStatus = InformationStatus::STATUS_INFO):void
    {
        $file = $type . 'File';
        if (isset($this->extConf[$file]) && $this->extConf[$file] != '') {
            $infoFile = $this->projectPath . $this->extConf[$file];
            if (file_exists($infoFile) && !empty($infoFile)) {
                $event->getToolbarItem()->addSystemInformation(
                    $this->languageService->sL(self::LANG_PREFIX . 'buildinfo.' . $type . '.title'),
                    $this->getFormattedFileContent($infoFile, $type),
                    $icon,
                    $infoStatus
                );
            }
        }
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
