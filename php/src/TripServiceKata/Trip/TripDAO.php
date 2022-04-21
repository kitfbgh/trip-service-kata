<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\Exception\DependentClassCalledDuringUnitTestException;

class TripDAO
{
    /**
     * @throws DependentClassCalledDuringUnitTestException
     */
    public static function findTripsByUser(User $user)
    {
        throw new DependentClassCalledDuringUnitTestException('TripDAO should not be invoked on an unit test.');
    }
}
