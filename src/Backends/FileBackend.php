<?php

namespace library\backends
{
    class FileBackend
    {
        public function load(string $path): string
        {
            set_error_handler(
                create_function(
                    '$severity, $message, $file, $line',
                    'throw new library\exceptions\ErrorException($message, $severity, $severity, $file, $line);'
                )
            );
            $data = file_get_contents($path);
            restore_error_handler();
            return $data;
        }

        public function save(string $path, string $data)
        {
            set_error_handler(
                create_function(
                    '$severity, $message, $file, $line',
                    'throw new library\exceptions\ErrorException($message, $severity, $severity, $file, $line);'
                )
            );
            file_put_contents($path, $data);
            restore_error_handler();
        }
    }
}

