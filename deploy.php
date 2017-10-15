<?php

namespace Deployer;

require 'recipe/laravel.php';

// Configuration

set('repository', 'git@github.com:alexivenkov/mtg-exchange.git');
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

set('bin/php', '/opt/php70/bin/php');
set('http_user', 'www-data');
set('http_group', 'www-data');

desc('Execute artisan migrate:refresh');
task('artisan:migrate:refresh', function () {
    $output = run('{{bin/php}} {{release_path}}/artisan migrate:refresh --force --seed');
    writeln('<info>' . $output . '</info>');
});

//stage server
host('mtg.egodev.ru')
    ->set('branch', 'master')
    ->set('deploy_path', '/home/a/alena2090/mtg.egodev.ru')
    ->user('alena2090')
    ->port(22)
    ->identityFile('~/.ssh/id_rsa')
    ->forwardAgent(true)
    ->multiplexing(false)
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate:refresh');