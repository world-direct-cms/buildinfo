<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function() {
        //---------------------------------------------------------------------
        // Load static TS template
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('buildinfo', 'Configuration/TypoScript', 'buildinfo');
    }
);
