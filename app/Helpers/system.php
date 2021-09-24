<?php

use App\Models\Setting;

/**
 * Update env file
 *
 * TODO: 如果设定的字段不存在于文件中，需要在未尾追加
 */
function systemUpdateEnvFile($data = array())
{
    if (!count($data)) {
        return;
    }

    $pattern = '/([^\=]*)\=[^\n]*/';

    $envFile = base_path() . '/.env';
    $lines = file($envFile);
    $newLines = [];
    foreach ($lines as $line) {
        preg_match($pattern, $line, $matches);

        if (!count($matches)) {
            $newLines[] = $line;
            continue;
        }

        if (!key_exists(trim($matches[1]), $data)) {
            $newLines[] = $line;
            continue;
        }

        $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
        $newLines[] = $line;
    }

    $newContent = implode('', $newLines);
    return file_put_contents($envFile, $newContent);
}

/**
 * System Update Environment Value
 * @param array $values
 * @return bool
 */
function systemUpdateEnvironmentValue(array $values)
{
    $envFile = app()->environmentFilePath();
    $str = file_get_contents($envFile);

    if (count($values) > 0) {
        foreach ($values as $envKey => $envValue) {
            $str .= "\n"; // In case the searched variable is in the last line without \n
            $keyPosition = strpos($str, "{$envKey}=");
            $endOfLinePosition = strpos($str, "\n", $keyPosition);
            $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

            // If key does not exist, add it
            if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }
        }
    }

    $str = substr($str, 0, -1);
    if (!file_put_contents($envFile, $str)) return false;
    return true;
}

/**
 * 获取 setting value
 *
 * @param $key
 * @param $defaultValue
 * @return string
 */
function getSettingValueByKey($key, $defaultValue = null)
{
    $setting = Setting::where('key', $key)->first();

    if ($setting) return $setting->value;

    return $defaultValue;
}

/**
 * 更新 setting
 *
 * @param $key
 * @param $value
 */
function updateSettingColumn($key, $value)
{
    Setting::where('key', $key)->update(['value' => $value]);
}
