#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}EXT:buildinfo: phpmd => Check for various stuff => See reports in 'Reports/phpmd'${NOCOLOR}\n"
../.Build/bin/phpmd ../Classes/ html ../.phpmd.xml --reportfile ../Reports/phpmd.html
printf "\n"
