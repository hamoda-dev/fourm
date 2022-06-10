<?php

function create($class, $attr = [], $times = null)
{
    return $class::factory($times)->create($attr);
}

function make($class, $attr = [], $times = null)
{
    return $class::factory($times)->make($attr);
}
