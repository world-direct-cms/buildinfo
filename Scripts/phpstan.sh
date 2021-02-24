#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}EXT:buildinfo: 'phpstan' => Static code analysis of extension${NOCOLOR}\n"
../.Build/bin/phpstan analyze -c ../.phpstan.neon
printf "\n"
