<?php

namespace library\backends
{
    class FileBackend
    {
        public function load(string $path): string
        {
            $data = file_get_contents($path);

            if ($data === false) {
                throw new \RuntimeException(sprintf('Konnte "%s" nicht lesen', $path));
            }

            return $data;
        }

        public function save(string $path, string $data)
        {
            if (file_put_contents($path, $data) === false) {
                throw new \RuntimeException(sprintf('Konnte "%s" nicht schreiben', $path));
            }
        }
    }
}

