<?php

function scanFileNameRecursivly($path = '', &$name = array() )
{
    $path = $path == ''? dirname(__FILE__) : $path;
    $lists = @scandir($path);

    if(!empty($lists))
    {
        foreach($lists as $f)
        {

            if(is_dir($path.DIRECTORY_SEPARATOR.$f) && $f != ".." && $f != ".")
            {
                scanFileNameRecursivly($path.DIRECTORY_SEPARATOR.$f, $name);
            }
            else
            {
                $name[] = $path.DIRECTORY_SEPARATOR.$f;

            }
        }
    }
    return $name;
}