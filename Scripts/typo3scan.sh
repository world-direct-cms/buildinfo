#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}typo3scan => TYPO3 Scanner${NOCOLOR}\n"
../.Build/bin/typo3scan scan ../Classes/
printf "\n"
