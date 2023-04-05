<?php

namespace Josezenem\PhpEnumsExtended\Tests\Dummy;

use Josezenem\PhpEnumsExtended\Traits\PhpEnumsExtendedTrait;

enum StatusStringEnumTest: string
{
    use PhpEnumsExtendedTrait;

    case Closed = 'closed';
    case Open = 'open';
    case Draft = 'draft';
}
