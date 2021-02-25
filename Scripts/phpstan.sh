#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}phpstan - PHP Static Analysis Tool${NOCOLOR}\n"
../.Build/bin/phpstan analyze -c ../.phpstan.neon
printf "\n"
