<?php
    class Hydrator
    {
        public static function hydrate(object $entity, array $data): void
        {
            foreach ($data as $key => $value) {

                $method = 'set' . ucfirst($key);

                if (method_exists($entity, $method)) {
                    $entity->$method(sanitize($value));
                }
            }
        }
    }