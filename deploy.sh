#!/usr/bin/env sh

git checkout production
git merge main --no-edit
git push origin production
git checkout main

# Copiat de https://forge.laravel.com/servers/513885/sites/1495024/application
wget https://forge.laravel.com/servers/513885/sites/1495024/deploy/http?token=cViCXgx1k6X4iStEVR7yU86pWcL05Cp8FKWBC99U -O /dev/null
