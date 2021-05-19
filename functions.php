<?php
function dd()
{
    $args = func_get_args();
    echo '<pre>';
    var_dump($args);
    echo '</pre>';

    exit;
}
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return substr($haystack, 0, $length) === $needle;
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if (!$length) {
        return true;
    }
    return substr($haystack, -$length) === $needle;
}

function call_app_resources(string $rootDir, $allData = array()): array
{
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    $dirContent = scandir($rootDir);
    foreach ($dirContent as $key => $content) {
        $path = $rootDir . SEP . $content;
        if (!in_array($content, $invisibleFileNames)) {
            if (is_file($path) && is_readable($path)) {
                if (!empty(pathinfo($path)) && isset(pathinfo($path)['extension']) && pathinfo($path)['extension'] == 'php') {
                    $allData[] = $path;
                }
            } elseif (is_dir($path) && is_readable($path)) {
                $allData = call_app_resources($path, $allData);
            }
        }
    }
    return $allData;
}
