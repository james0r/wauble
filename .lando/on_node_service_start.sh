#!/bin/sh

run_theme_watch() {
  cd wordpress/wp-content/themes/wauble/ && npm run watch &
  PID=$!
  echo $PID > /tmp/npm.pid
  wait $PID
  return 1
}

until (ps -p $(cat /tmp/npm.pid)); do
  echo "$PID is running"
  pkill -15 "npx mix watch"
  pkill -15 "npm run watch"
  pkill -15 "mix watch"  
  pkill -15 "watch"
  pkill -15 "webpack"
  run_theme_watch
done