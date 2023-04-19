@servers(['staging' => ['jamesauble@vps21571.dreamhostps.com'], 'localhost' => ['127.0.0.1']])
 
@setup
  function logSuccess($message) { return "echo '\033[32m" .$message. "\033[0m';\n"; }
  function logWarn($message) { return "echo '\033[31m" .$message. "\033[0m';\n"; }
  function logInfo($message) { return "echo '\033[36m" .$message. "\033[0m';\n"; }
  function logLine($message) { return "echo '" .$message. "';\n"; }
@endsetup

@task('staging-composer-remote-to-staging', ['on' => 'staging'])
    cd ~/wauble.jamesauble.com
    rm -rf wauble-wordpress/
    git clone git@github.com:james0r/wauble-wordpress.git
    mv wauble-wordpress/composer.json ./composer.json
    mv wauble-wordpress/auth.json ./auth.json
    rm -rf wauble-wordpress/
@endtask

@task('staging-composer-remote-to-localhost', ['on' => 'localhost'])
    rm -rf wauble-wordpress/
    git clone git@github.com:james0r/wauble-wordpress.git
    mv wauble-wordpress/composer.json ./composer.json
    rm -rf wauble-wordpress/
@endtask

@task('staging-composer-install', ['on' => 'staging'])
    source ~/.bash_profile
    cd ~/wauble.jamesauble.com
    composer install
@endtask

@task('localhost-composer-install', ['on' => 'localhost'])
    composer install
@endtask

@story('staging-update-plugins', ['on' => 'staging'])
    composer-remote-to-staging
    composer-install
@endstory

@task('staging-activate-plugins', ['on' => 'staging'])
    cd ~/wauble.jamesauble.com
    wp plugin activate --all
@endtask

@task('test')
  echo 'tested'
@endtask