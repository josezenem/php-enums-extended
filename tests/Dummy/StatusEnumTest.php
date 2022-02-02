<?php

namespace Josezenem\PhpEnumsExtended\Tests\Dummy;

use Josezenem\PhpEnumsExtended\Traits\PhpEnumsExtendedTrait;

enum StatusEnumTest
{
    use PhpEnumsExtendedTrait;

    case Closed;
    case Open;
    case Draft;
}
