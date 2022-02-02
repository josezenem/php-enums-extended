<?php

use Josezenem\PhpEnumsExtended\Tests\Dummy\Blog;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusStringEnumTest;

it('converts to options array', function () {
    $status_as_array = StatusStringEnumTest::toOptionsArray();

    expect($status_as_array)->toMatchArray([
        'closed' => 'Closed',
        'open' => 'Open',
    ]);
});

it('converts to options array inverse', function () {
    $status_as_array = StatusStringEnumTest::toOptionsInversedArray();

    expect($status_as_array)->toMatchArray([
        'Closed' => 'closed',
        'Open' => 'open',
    ]);
});

it('equals one of the parameters', function () {
    $blog = new Blog();

    expect($blog->stringStatus->equals(StatusStringEnumTest::Open))->toBeTrue();
});

it('does not equal one of the parameters', function () {
    $blog = new Blog();

    expect($blog->stringStatus->doesNotEqual(StatusStringEnumTest::Closed, StatusStringEnumTest::Draft))->toBeTrue();
});
