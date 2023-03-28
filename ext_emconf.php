<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "buildinfo"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Build Information',
    'description' => 'Plugin contains system information messages for the current build number and the current build date and age, as well as the composer git version (tag).',
    'category' => 'plugin',
    'author' => 'Klaus Hörmann-Engl',
    'author_email' => 'kho@world-direct.at',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.5.7',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.15-12.9.99',
            'fluid_styled_content' => '11.5.15-12.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
