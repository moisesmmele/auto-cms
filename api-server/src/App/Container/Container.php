<?php

namespace Moises\AutoCms\App\Container;

class Container
{
    protected $bindings = [];

    public function get(string $id)
    {
        if ($this->has($id)){
            $entry = $this->bindings[$id];
            if (is_callable($entry)){
                return $entry($this);
            }
            $id = $entry;
        }
        return $this->resolve($id);
    }
    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    public function set(string $id, callable|string $concrete): void
    {
        $this->bindings[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        $reflectionClass = new \ReflectionClass($id);
        if (!$reflectionClass->isInstantiable()) {
            throw new \InvalidArgumentException("$id is not instantiable");
        }
        $classConstructor = $reflectionClass->getConstructor();
        if (!$classConstructor) {
            return new $id;
        }
        $parameters = $classConstructor->getParameters();
        if (!$parameters) {
            return new $id;
        }
        $classDependencies = array_map(function(\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();
            if (!$type) {
                throw new \Exception("no type hint for {$name} in {$id}");
            }
            if ($type instanceof \ReflectionUnionType) {
                throw new \Exception("{$name} in {$id} has a union type");
            }
            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            };
            throw new \Exception("Unable to resolve {$name} in {$id} because of invalid parameter");

        }, $parameters);
        return $reflectionClass->newInstanceArgs($classDependencies);
    }

    public function loadBindings(): void
    {
        $bindings = require_once __DIR__ . "/bindings.php";
        foreach ($bindings as $id => $concrete) $this->set($id, $concrete);
    }
}