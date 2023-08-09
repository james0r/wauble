#!/bin/sh

. /app/.lando/helpers.sh

PID=$(cat /tmp/npm.pid)

echo "Killing npm run watch with PID $PID"

kill_descendant_processes $PID true