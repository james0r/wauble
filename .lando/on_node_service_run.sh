#!/bin/sh

run_theme_watch() {
  cd /app/wordpress/wp-content/themes/wauble/ && npm run watch &
  PID=$!
  echo $PID > /tmp/npm.pid
  wait $PID
  return 1
}

run_theme_watch