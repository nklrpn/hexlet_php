<?php

if (!file_exists($path)) {
    mkdir($path, 0755, $recursive);
} 
rmdir($path);


if (!file_exists($path)) {
    touch($path);
}
unlink($path);


print_r(glob('/var/tmp/*');
print_r(scandir('/var/tmp/*');


$iterator = new \GlobIterator('../*');
foreach ($iterator as $item) {
    print_r($item);
}


$info = new \SplFileInfo(__FILE__);
echo $info->isFile();

/**
 * Реализуйте функцию rrmdir, удаляющую директорию рекурсивно, то есть вместе со всем своим содержимым.
 * Подсказка
 *   Одна из возможных реализаций может использовать итераторы.
 *   Воспользуйтесь функцией scandir вместо функции glob.
 */
 
function rrmdir($dir)
{
    // BEGIN (write your solution here)
    $files = scandir($dir);
    
    foreach ($files as $item) {
        if ($item != '.' && $item != '..') {
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            
            if (is_dir($path)) {
                rrmdir($path);
            } else {
                unlink($path);
            }
        }
    }
    
    rmdir($dir);
    
    /* TEACHER'S SOLUTION */
    $dirIterator = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
    $iterator = new \RecursiveIteratorIterator($dirIterator, \RecursiveIteratorIterator::CHILD_FIRST);
    
    foreach ($iterator as $filename => $fileInfo) {
        if ($fileInfo->isDir()) {
            rmdir($filename);
        } else {
            unlink($filename);
        }
    }
    
    rmdir($dir);
    // END
}