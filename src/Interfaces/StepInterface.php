<?php

namespace Pietrantonio\Floware\Interfaces;

/**
 * Interface of a single step.
 */
interface StepInterface {

    public function __invoke($entity);

    public function execute($entity);

}
