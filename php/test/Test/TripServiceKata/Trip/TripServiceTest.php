<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $tripService;

    protected function setUp(): void
    {
        $this->mockSession = $this->createMock(UserSession::class);
        $this->mockUser = $this->createMock(User::class);
    }

    /** @test */
    public function should_Throw_Exception_When_User_Is_Not_LoggedIn()
    {
        $this->expectException(UserNotLoggedInException::class);
        $this->mockSession->method('getLoggedUser')
            ->willReturn(null);
        $service = new TripService($this->mockSession);
        $service->getTripsByUser($this->mockUser);
    }

    /**
     * @test
     * @dataProvider notFriendProvider
     * @testdox $target user with empty friends
     */
    public function should_Not_Return_Trips_When_Logged_User_Are_Not_Friend(array $friends): void
    {
        $expected = [];

        $this->mockSession->method('getLoggedUser')
            ->willReturn('loggeduser');
        $this->mockUser->method('getFriends')
            ->willReturn($friends);
        $service = new TripService($this->mockSession);
        $actual = $service->getTripsByUser($this->mockUser);

        $this->assertEquals($expected, $actual);
    }

    public function notFriendProvider()
    {
        yield [
            []
        ];
        yield [
            ['natz', '1234']
        ];
    }
}
