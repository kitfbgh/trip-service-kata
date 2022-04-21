<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    private UserSession $userSession;
    private TripDAO $tripDAO;

    public function __construct(
        UserSession $userSession,
        TripDAO $tripDAO
    ) {
        $this->userSession = $userSession;
        $this->tripDAO = $tripDAO;
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
                $tripList = $this->tripDAO->findTripsByUser($user);
            }
            return $tripList;
        } else {
            throw new UserNotLoggedInException();
        }
    }
}
