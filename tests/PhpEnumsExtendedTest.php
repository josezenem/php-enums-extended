<?php

use Josezenem\PhpEnumsExtended\Tests\Dummy\Blog;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusEnumTest;

it('converts to options array', function () {
    $status_as_array = StatusEnumTest::toOptionsArray();

    expect($status_as_array)->toMatchArray([
        'Closed' => 'Closed',
        'Open' => 'Open',
    ]);
});

it('converts to options array inverse', function () {
    $status_as_array = StatusEnumTest::toOptionsInversedArray();

    expect($status_as_array)->toMatchArray([
        'Closed' => 'Closed',
        'Open' => 'Open',
    ]);
});

it('equals one of the parameters', function () {
    $blog = new Blog();
    expect(StatusEnumTest::equals($blog->status))->toBeTrue();
});
