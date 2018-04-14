<?php

function createFactory($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}
