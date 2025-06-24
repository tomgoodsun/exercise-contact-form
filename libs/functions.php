<?php

/**
 * お問い合わせカテゴリの取得
 *
 * @return array
 */
function getCategories()
{
    return [
        '1' => '仕事の依頼',
        '2' => '求人について',
    ];
}

/**
 * 完了ページ
 *
 * @param string $cmd
 * @param array $request
 * @return array
 */
function processDone(string $cmd, array $request)
{
    $rnd = $request['rnd'] ?? null;

    // unsetするのであえて$_SESSIONに代入
    $_SESSION['rnd'] = $_SESSION['rnd'] ?? null;
    $sesRnd = $_SESSION['rnd'];

    // nullチェック
    $isAvailable = isset($rnd) && isset($sesRnd);

    if ($isAvailable && $rnd == $_SESSION['rnd']) {
        // send mail here
    }

    unset($_SESSION['rnd']);

    return [
        $cmd,
        [
        ]
    ];
}

/**
 * 確認ページ
 *
 * @param string $cmd
 * @param array $request
 * @return array
 */
function processConfirm(string $cmd, array $request)
{
    $rnd = $request['rnd'];

    // 1. Check form values.
    // 2. If error found, set error message and do processInput

    return [
        $cmd,
        [
            'name' => $request['name'],
            'furigana' => $request['furigana'],
            'email' => $request['email'],
            'category' => $request['category'],
            'body' => $request['body'],
            'rnd' => $rnd,
        ]
    ];
}

/**
 * 入力ページ
 *
 * @param string $cmd
 * @param array $request
 * @return array
 */
function processInput(string $cmd, array $request)
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
        $cmd,
        [
            'name' => $request['name'],
            'furigana' => $request['furigana'],
            'email' => $request['email'],
            'category' => $request['category'],
            'body' => $request['body'],
            'rnd' => $rnd,
            'categories' => getCategories(),
        ]
    ];
}

/**
 * セッションの開始
 *
 * @return void
 */
function initSession()
{
    session_start();
}

/**
 * メインルーチン
 *
 * @param string $rootPath
 * @param array $request
 * @return void
 */
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
        list($cmd, $tplVars) = $commands[$cmd]($cmd, $request);
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
