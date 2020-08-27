# .bashrc

# Source global definitions
if [ -f /etc/bashrc ]; then
	. /etc/bashrc
fi

# User specific aliases and functions
source /opt/nexcess/php70u/enable

alias cache='php bin/magento cache:flush'
alias staticBR='php bin/magento setup:static-content:deploy pt_BR -t Magento/luma -f; php bin/magento setup:static-content:deploy pt_BR -t Magento/backend -f'
alias staticUS='php bin/magento setup:static-content:deploy en_US -t Magento/luma -f; php bin/magento setup:static-content:deploy en_US -t Magento/backend -f'
alias upgrade='php bin/magento setup:upgrade'
alias compile='php bin/magento setup:di:compile'
alias production='php bin/magento deploy:mode:set production -s'
alias developer='php bin/magento deploy:mode:set developer'
alias deployShow='php bin/magento deploy:mode:show'
