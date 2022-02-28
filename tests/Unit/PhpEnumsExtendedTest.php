<?php

use Josezenem\PhpEnumsExtended\Exceptions\EnumsExtendedException;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusEnumTest;

it('converts to options array', function () {
    $status_as_array = StatusEnumTest::options();

    expect($status_as_array)->toMatchArray([
        'Closed' => 'Closed',
        'Open' => 'Open',
    ]);
});

it('converts to options array flipped', function () {
    $status_as_array = StatusEnumTest::optionsFlipped();

    expect($status_as_array)->toMatchArray([
        'Closed' => 'Closed',
        'Open' => 'Open',
    ]);
});

it('equals one of the parameters', function () {
    expect($this->blog->status->equals(StatusEnumTest::Open))->toBeTrue();
});

it('does not equal one of the parameters', function () {
    expect($this->blog->status->doesNotEqual(StatusEnumTest::Closed, StatusEnumTest::Draft))->toBeTrue();
});

it('is open by magic method', function () {
    expect($this->blog->status->isOpen())->toBeTrue();
});

it('is open by calling static magic method', function () {
    expect($this->blog->status::OPEN())->toEqual('Open');
});

it('throws an exception when method does not exist', function () {
    $this->blog->status::DELETED_DRAFT();
})->throws(EnumsExtendedException::class);
