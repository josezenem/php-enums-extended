<?php

use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusEnumTest;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusIntEnumTest;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusStringEnumTest;

uses()->beforeEach(function () {
    $this->blog = new class () {
        public function __construct(
            public StatusEnumTest $status = StatusEnumTest::Open,
            public StatusStringEnumTest $stringStatus = StatusStringEnumTest::Open,
            public StatusIntEnumTest $intStatus = StatusIntEnumTest::Open,
        ) {
        }
    };
})->in('Unit');
