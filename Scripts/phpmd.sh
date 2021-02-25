#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}phpmd => PHP Mess Detector${NOCOLOR}\n"
../.Build/bin/phpmd ../Classes/ ansi ../.phpmd.xml
printf "\n"
