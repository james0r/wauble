@include('vendor/autoload.php');
@setup
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  function logSuccess($message) { return "echo '\033[32m" .$message. "\033[0m';\n"; }
  function logWarn($message) { return "echo '\033[31m" .$message. "\033[0m';\n"; }
  function logInfo($message) { return "echo '\033[36m" .$message. "\033[0m';\n"; }
  function logLine($message) { return "echo '" .$message. "';\n"; }

  $theme_name = $_ENV['THEME_NAME'];
  $local_wp_path = $_ENV['LOCAL_WP_PATH'];
  $remote_platform = $_ENV['REMOTE_PLATFORM'];

  $dev_env = $_ENV['WP_ENGINE_DEVELOPMENT_ENV_NAME'];
  $dev_ssh = $_ENV['WP_ENGINE_DEVELOPMENT_SSH'];

  $staging_env = $_ENV['WP_ENGINE_STAGING_ENV_NAME'];
  $staging_ssh = $_ENV['WP_ENGINE_STAGING_SSH'];

  $dreamhost_ssh = $_ENV['DREAMHOST_SSH'];
  $dreamhost_wp_path = $_ENV['DREAMHOST_WORDPRESS_PATH'];
@endsetup

@servers(['development' => $dev_ssh, 'staging' => $staging_ssh, 'localhost' => ['127.0.0.1'], 'dreamhost' => $dreamhost_ssh])

@story('push-db-to-wp-engine-development')
  export-local-db
  upload-db-to-wpengine-development
  import-db-on-wpengine-development
@endstory

@story('push-db-to-wp-engine-staging')
  export-local-db
  upload-db-to-wpengine-staging
  import-db-on-wpengine-staging
@endstory

@task('export-local-db', ['on' => 'localhost'])
  lando wp db export database-tmp.sql --add-drop-table --path=wordpress --exclude_tables=wp_users,wp_usermeta
@endtask

@task('push-uploads-to-wpengine-development', ['on' => 'localhost'])
  rsync -avr --exclude-from=.rsync/exclude {{$local_wp_path}}/wp-content/uploads/ {{$dev_ssh}}:/sites/{{$dev_env}}/wp-content/uploads
  {{ logSuccess('Uploads pushed to environment -> '. $dev_env); }}
@endtask

@task('push-uploads-to-wpengine-staging', ['on' => 'localhost'])
  rsync -avr --exclude ".DS_STORE" {{$local_wp_path}}/wp-content/uploads/ {{$staging_ssh}}:/sites/{{$staging_env}}/wp-content/uploads
  {{ logSuccess('Uploads pushed to environment -> '. $staging_env); }}
@endtask

@task('push-theme-files-to-wpengine-development', ['on' => 'localhost'])
  lando build:theme
  rsync -avr --delete --exclude-from=.rsync/exclude {{$local_wp_path}}/wp-content/themes/{{$theme_name}}/ {{$dev_ssh}}:/sites/{{$dev_env}}/wp-content/themes/{{$theme_name}}
  {{ logSuccess('Theme files pushed to environment -> '. $dev_env); }}
@endtask

@task('push-theme-files-to-wpengine-staging', ['on' => 'localhost'])
  lando build:theme
  rsync -avr --delete --exclude-from=.rsync/exclude {{$local_wp_path}}/wp-content/themes/{{$theme_name}}/ {{$staging_ssh}}:/sites/{{$staging_env}}/wp-content/themes/{{$theme_name}}
  {{ logSuccess('Theme files pushed to environment -> '. $staging_env); }}
@endtask

@task('push-theme-files-to-dreamhost', ['on' => 'localhost'])
  lando build:theme
  rsync -avr --delete --exclude-from=.rsync/exclude {{$local_wp_path}}/wp-content/themes/{{$theme_name}}/ {{$dreamhost_ssh}}:{{$dreamhost_wp_path}}/wp-content/themes/{{$theme_name}}
  {{ logSuccess('Theme files pushed to environment -> '. $dreamhost_wp_path); }}
@endtask

@task('upload-db-to-wpengine-development', ['on' => 'localhost'])
  sed -i '' 's|http://{{$theme_name}}\.lndo\.site|https://{{$dev_env}}\.wpengine\.com|g' database-tmp.sql
  sed -i '' 's|Database: wordpress|Database: wp_{{$dev_env}}|g' database-tmp.sql
  rsync database-tmp.sql {{$dev_ssh}}:/sites/{{$dev_env}}/wp-content/themes/{{$theme_name}}/
  rm database-tmp.sql
@endtask

@task('upload-db-to-wpengine-staging', ['on' => 'localhost'])
  sed -i '' 's|http://{{$theme_name}}\.lndo\.site|https://{{$staging_env}}\.wpengine\.com|g' database-tmp.sql
  sed -i '' 's|Database: wordpress|Database: wp_{{$staging_env}}|g' database-tmp.sql
  rsync database-tmp.sql {{$staging_ssh}}:/sites/{{$staging_env}}/wp-content/themes/{{$theme_name}}/
  rm database-tmp.sql
@endtask

@task('import-db-on-wpengine-development', ['on' => 'development'])
  wp db import sites/{{$dev_env}}/wp-content/themes/{{$theme_name}}/database-tmp.sql
  rm -rf sites/{{$dev_env}}/wp-content/themes/{{$theme_name}}/database-tmp.sql
  {{ logInfo('You may need to clear WPEngine cache on environment ->' . $dev_env); }}
@endtask

@task('import-db-on-wpengine-staging', ['on' => 'staging'])
  wp db import sites/{{$staging_env}}/wp-content/themes/{{$theme_name}}/database-tmp.sql
  rm -rf sites/{{$staging_env}}/wp-content/themes/{{$theme_name}}/database-tmp.sql
  {{ logInfo('You may need to clear WPEngine cache on environment ->' . $staging_env); }}
@endtask