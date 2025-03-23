<?php

namespace Core\Configuration;

class Config
{
    private array $config = [];

    public function add(string $key, array $array): void
    {
        $this->config[$key] = $array;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $segments = explode('.', $key);
        $result = $this->config;

        foreach ($segments as $segment) {
            if(!is_array($result) || !array_key_exists($segment, $result)) {
                return $default;
            }

            $result = $result[$segment];
        }

        return $result;
    }
}