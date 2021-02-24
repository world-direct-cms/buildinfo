#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}EXT:buildinfo: 'typo3scan' => Check code for deprecated methods => Generates report${NOCOLOR}\n"
../.Build/bin/typo3scan scan . --format html --reportFile ../Reports/typo3scan.html
printf "\n"
