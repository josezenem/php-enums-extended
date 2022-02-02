<?php


use Josezenem\PhpEnumsExtended\Tests\Dummy\Blog;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusIntEnumTest;

it('converts to options array', function () {
    $status_as_array = StatusIntEnumTest::toOptionsArray();

    expect($status_as_array)->toMatchArray([
        0 => 'Closed',
        1 => 'Open',
    ]);
});

it('converts to options array inverse', function () {
    $status_as_array = StatusIntEnumTest::toOptionsInversedArray();

    expect($status_as_array)->toMatchArray([
        'Closed' => 0,
        'Open' => 1,
    ]);
});

it('equals one of the parameters', function () {
    $blog = new Blog();

    expect($blog->intStatus->equals(StatusIntEnumTest::Open))->toBeTrue();
});

it('does not equal one of the parameters', function () {
    $blog = new Blog();

    expect($blog->intStatus->doesNotEqual(StatusIntEnumTest::Closed, StatusIntEnumTest::Draft))->toBeTrue();
});
