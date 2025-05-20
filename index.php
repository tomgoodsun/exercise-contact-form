<?php

function processDone(array $request)
{
    $rnd = $request['rnd'];
    if ($rnd == $_SESSION['rnd']) {
        // send mail here
    }

    unset($_SESSION['rnd']);

    return [
    ];
}

function processConfirm(array $request)
{
    $rnd = $request['rnd'];

    // 1. Check form values.
    // 2. If error found, set error message and do processInput

    return [
        'name' => $request['name'],
        'furigana' => $request['furigana'],
        'email' => $request['email'],
        'category' => $request['category'],
        'body' => $request['body'],
        'rnd' => $rnd,
    ];
}

function processInput(array $request)
{
    $request += [
        'name' => null,
        'furigana' => null,
        'email' => null,
        'category' => null,
        'body' => null,
        'rnd' => null,
    ];

    $rnd = md5(time());
    $_SESSION['rnd'] = $rnd;

    return [
        'name' => $request['name'],
        'furigana' => $request['furigana'],
        'email' => $request['email'],
        'category' => $request['category'],
        'body' => $request['body'],
        'rnd' => $rnd,
    ];
}

function initSession()
{
    session_start();
}

function main(array $request)
{
    initSession();
    $request += [
        'cmd' => 'input',
        'rnd' => null,
    ];
    $cmd = $request['cmd'];

    $commands = [
        'input' => 'processInput',
        'confirm' => 'processConfirm',
        'done' => 'processDone',
    ];

    if (!array_key_exists($cmd, $commands)) {
        $cmd = 'input';
    }
    $tplVars = $commands[$cmd]($request);
    $tplVars['cmd'] = $cmd;
    require_once __DIR__ . '/assets/base.tpl.inc';
}

main($_POST);

