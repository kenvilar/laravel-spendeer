<?php

function createFactory($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function makeFactory($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}
