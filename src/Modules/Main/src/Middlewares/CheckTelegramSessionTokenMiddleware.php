<?php

declare(strict_types=1);

namespace SmartDelivery\Main\Middlewares;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use SmartDelivery\Telegram\Services\FindTelegramWebAppSessionByTokenService;
use SmartDelivery\User\Services\FindUserByIdService;

final readonly class CheckTelegramSessionTokenMiddleware
{
    public function __construct(
        private FindTelegramWebAppSessionByTokenService $findTelegramWebAppSessionByTokenService,
        private FindUserByIdService $findUserById
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $sessionHeader = $request->header('x-telegram-session');
        if ($sessionHeader === null) {
            $sessionHeader = $request->cookie('session_token');
            if ($sessionHeader === null) {
                throw new HttpException(401, 'Unauthorized');
            }
        }
        $session = $this->findTelegramWebAppSessionByTokenService->handle($sessionHeader);

        if ($session === null) {
            throw new HttpException(401, 'Unauthorized');
        }

        $user = $this->findUserById->handle($session->getUserId());

        if (!$session->isVerified() || Carbon::now()->greaterThan($session->getExpireAt()) || $user === null) {
            throw new HttpException(401, 'Unauthorized');
        }
        //$user = UserModel::query()->find('8e5d575e-d07e-43a2-b236-8319b26a29c3');
        $user = $this->findUserById->handle($user->id);

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
