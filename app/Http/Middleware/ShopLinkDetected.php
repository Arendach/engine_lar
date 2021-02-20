<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Response;

class ShopLinkDetected
{
    /**
     * @var Request
     */
    private $request;

    public function handle(Request $request, Closure $next)
    {
        $this->request = $request;

        if ($this->isNeedRedirect()) {
            return Response::redirectTo(
                $this->generatePath()
            );
        }

        return $next($request);
    }

    private function generatePath(): string
    {
        $currentUrl = $this->request->fullUrl();
        $previous = url()->previous();

        $shop = preg_match('~shop=([a-z]+)~', $previous, $matches) ? $matches[1] : 'shop';

        if (preg_match('~\?~', $currentUrl)) {
            return $currentUrl . '&shop=' . $shop;
        } else {
            return $currentUrl . '?shop=' . $shop;
        }
    }

    private function isNeedRedirect(): bool
    {
        return $this->request->segment(1) == 'shop' && !$this->request->has('shop');
    }
}
