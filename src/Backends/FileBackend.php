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





            //TODO: X throws error breaks running program and never gets to throw the exception
            // Workaround?

//            $data = file_get_contents($path);
//
//            if ($data === false) {
//                throw new \RuntimeException(sprintf('Konnte "%s" nicht lesen', $path));
//            }
//
//            return $data;
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



//            if (file_put_contents($path, $data) === false) {
//                throw new \RuntimeException(sprintf('Konnte "%s" nicht schreiben', $path));
//            }
        }
    }
}

