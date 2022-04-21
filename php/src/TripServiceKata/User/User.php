<?php

namespace TripServiceKata\User;

use TripServiceKata\Trip\Trip;

class User
{
    private array $trips;
    private array $friends;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->trips = [];
        $this->friends = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTrips(): array
    {
        return $this->trips;
    }

    public function getFriends(): array
    {
        return $this->friends;
    }

    public function addFriend(User $user)
    {
        $this->friends[] = $user;
    }

    public function addTrip(Trip $trip)
    {
        $this->trips[] = $trip;
    }
}
