<?php

namespace WorldDirect\Buildinfo\Utility;

use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class BasicUtility
{
    /**
     * Constant holding the language prefix
     */
    const LANG_PREFIX = 'LLL:EXT:buildinfo/Resources/Private/Language/locallang_db.xlf:';

    /**
     * Method returns the TypoScript configuration for a plugin or a module.
     *
     * @param string $type   Wheter it is a plugin or a module
     * @param string $detail The name of the plugin or module
     *
     * @return array<string> The settings array
     */
    public static function getConfiguration(string $type = 'plugin', string $detail): array
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $configurationManager = $objectManager->get(ConfigurationManager::class);
        $extConf = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        if (isset($extConf[$type . '.'][$detail . '.']['settings.']) && is_array($extConf[$type . '.'][$detail . '.']['settings.'])) {
            return $extConf[$type . '.'][$detail . '.']['settings.'];
        }
        return [];
    }

    /**
     * Function converts seconds into words.
     *
     * @param int $seconds The amount of seconds to convert
     * @param LanguageService $langService The language Service for getting text elements
     *
     * @return string A string with the duration in days and hours
     */
    public static function secondsToWords(int $seconds, LanguageService $langService): string
    {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a') . ' ' . $langService->sL(self::LANG_PREFIX . 'buildinfo.days.title') . ', ' . $dtF->diff($dtT)->format('%h') . ' ' . $langService->sL(self::LANG_PREFIX . 'buildinfo.hours.title');
    }

    /**
     * Formats the given unix timestamp to display the date
     * and the age in days.
     *
     * @param int $timestamp The timestamp to be formatted
     * @param LanguageService $langService The language service for translations
     * @param bool $addDuration Whether to add the duration in text or not
     *
     * @return string
     */
    public static function formatTimestamp(int $timestamp, LanguageService $langService, bool $addDuration = false): string
    {
        if ($timestamp) {
            $date = date('d.m.Y H:i', $timestamp);
            if ($addDuration) {
                return $date . ' (' . $langService->sL(self::LANG_PREFIX . 'buildinfo.age.title') . ': ' . self::secondsToWords(intval((time() - $timestamp)), $langService) . ')';
            }
            return $date;
        }
        return '';
    }
}
