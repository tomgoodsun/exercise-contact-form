<?php

function getCategories()
{
    return [
        '1' => '仕事の依頼',
        '2' => '求人について',
    ];
}

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
        'categories' => getCategories(),
    ];
}

function initSession()
{
    session_start();
}

function main(string $rootPath, array $request)
{
    try {
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
    } catch (ErrorException $e) {
        $cmd = 'error';
        $tplVars = [
            'errorClass' => get_class($e),
            'errorMessage' => $e->getMessage(),
            'errorFile' => $e->getFile(),
            'errorLine' => $e->getLine(),
            'errorTrace' => $e->getTraceAsString(),
            'errorCode' => $e->getCode(),
        ];
    }
    $tplVars['cmd'] = $cmd;
    require_once $rootPath . '/assets/base.tpl.inc';
}
