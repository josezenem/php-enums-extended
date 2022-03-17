<?php

use Josezenem\PhpEnumsExtended\Exceptions\EnumsExtendedException;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusStringEnumTest;

it('converts to options array', function () {
    $status_as_array = StatusStringEnumTest::options();


    expect($status_as_array)->toMatchArray([
        'closed' => 'Closed',
        'open' => 'Open',
    ]);
});

it('converts to options array flipped', function () {
    $status_as_array = StatusStringEnumTest::optionsFlipped();

    expect($status_as_array)->toMatchArray([
        'Closed' => 'closed',
        'Open' => 'open',
    ]);
});

it('equals one of the parameters', function () {
    expect($this->blog->stringStatus->equals(StatusStringEnumTest::Open))->toBeTrue();
});

it('does not equal one of the parameters', function () {
    expect($this->blog->stringStatus->doesNotEqual(StatusStringEnumTest::Closed, StatusStringEnumTest::Draft))->toBeTrue();
});

it('is open by magic method', function () {
    expect($this->blog->stringStatus->isOpen())->toBeTrue();
});

it('is open by calling static magic method', function () {
    expect($this->blog->stringStatus::OPEN())->toEqual('open');
});

it('throws an exception when method does not exist', function () {
    $this->blog->stringStatus::DELETED_DRAFT();
})->throws(EnumsExtendedException::class);

it('is a valid value for the Enum', function () {
    expect(StatusStringEnumTest::exist('open'))->toBeTrue();
});

it('is not a valid value for the Enum', function () {
    expect(StatusStringEnumTest::exist('not open'))->toBeFalse();
});
