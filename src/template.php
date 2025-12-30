<?php
/**
 * Parse PHP template file
 *
 * @param string $path of the template
 * @param array $variables an associative array of variables which are available
 *                         in the PHP template
 * @return string the parsed template
 */
function template($path, $variables)
{
    ob_start();
    extract($variables);
    require $path;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
