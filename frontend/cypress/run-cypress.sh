#!/usr/bin/env bash

testExitCode=0

rm -rf cypress/snapshots/actual/*
npm run start-background

case "$1" in
    case:open)
        cypress open --env type=actual
        ;;
    case:approve)
        cypress run --env type=base
        ;;
    *)
        cypress run --env type=actual
        ;;
esac

testExitCode=$(($testExitCode + $?))
npm run kill-background

if [ "$testExitCode" -ne "0" ]; then
    echo "\n***************************************************"
    echo "Cypress test failures!"
    echo "***************************************************\n"
    exit $testExitCode
fi
