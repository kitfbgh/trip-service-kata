<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    private UserSession $userSession;

    public function __construct(
        UserSession $userSession
    ) {
        $this->userSession = $userSession;
    }

    /**
     * @throws UserNotLoggedInException
     */
    public function getTripsByUser(User $user): array
    {
        $tripList = [];
        $loggedUser = $this->userSession->getLoggedUser();
        $isFriend = false;
        if ($loggedUser != null) {
            foreach ($user->getFriends() as $friend) {
                if ($friend == $loggedUser) {
                    $isFriend = true;
                    break;
                }
            }
            if ($isFriend) {
                $tripList = TripDAO::findTripsByUser($user);
            }
            return $tripList;
        } else {
            throw new UserNotLoggedInException();
        }
    }
}
