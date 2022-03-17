<?php

use Josezenem\PhpEnumsExtended\Exceptions\EnumsExtendedException;
use Josezenem\PhpEnumsExtended\Tests\Dummy\StatusIntEnumTest;

it('converts to options array', function () {
    $status_as_array = StatusIntEnumTest::options();

    expect($status_as_array)->toMatchArray([
        0 => 'Closed',
        1 => 'Open',
    ]);
});

it('converts to options array flipped', function () {
    $status_as_array = StatusIntEnumTest::optionsFlipped();

    expect($status_as_array)->toMatchArray([
        'Closed' => 0,
        'Open' => 1,
    ]);
});

it('equals one of the parameters', function () {
    expect($this->blog->intStatus->equals(StatusIntEnumTest::Open))->toBeTrue();
});

it('does not equal one of the parameters', function () {
    expect($this->blog->intStatus->doesNotEqual(StatusIntEnumTest::Closed, StatusIntEnumTest::Draft))->toBeTrue();
});

it('is open by magic method', function () {
    expect($this->blog->intStatus->isOpen())->toBeTrue();
});

it('is open by calling static magic method', function () {
    expect($this->blog->intStatus::OPEN())->toEqual(1);
});

it('throws an exception when method does not exist', function () {
    $this->blog->intStatus::DELETED_DRAFT();
})->throws(EnumsExtendedException::class);

it('is a valid value for the Enum', function () {
    expect(StatusIntEnumTest::exists(1))->toBeTrue();
});

it('is not a valid value for the Enum', function () {
    expect(StatusIntEnumTest::exists(11))->toBeFalse();
});
