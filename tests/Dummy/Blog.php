<?php

namespace Josezenem\PhpEnumsExtended\Tests\Dummy;

class Blog
{
    public function __construct(
        public StatusEnumTest $status = StatusEnumTest::Open,
        public StatusStringEnumTest $stringStatus = StatusStringEnumTest::Open,
        public StatusIntEnumTest $intStatus = StatusIntEnumTest::Open,
    ) {
    }
}
