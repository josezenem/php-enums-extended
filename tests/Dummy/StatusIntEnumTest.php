<?php

namespace Josezenem\PhpEnumsExtended\Tests\Dummy;

use Josezenem\PhpEnumsExtended\Traits\PhpEnumsExtendedTrait;

enum StatusIntEnumTest: int
{
    use PhpEnumsExtendedTrait;

    case Closed = 0;
    case Open = 1;
    case Draft = 2;
}
