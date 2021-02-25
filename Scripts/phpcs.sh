#!/bin/bash

COLOR='\033[0;33m'
NOCOLOR='\033[0m'

printf "\n##############################################################"
printf "\n${COLOR}phpcs => PHP CodeSniffer${NOCOLOR}\n"
../.Build/bin/phpcs -s
printf "\n"
