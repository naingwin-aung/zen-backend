<?php

namespace App\Http\Middleware;

use App\Services\Admin\LanguageService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rawHeader = $request->header('Accept-Language', config('app.locale', 'en'));
        $primaryLanguage = strtolower(trim(explode(',', (string) $rawHeader)[0]));
        $shortLocale = strtolower(substr(explode('-', $primaryLanguage)[0], 0, 5));

        $languageService = app(LanguageService::class);
        $activeCodes = $languageService->getCodes();

        if (! in_array($shortLocale, $activeCodes, true)) {
            $shortLocale = config('app.fallback_locale', 'en');
        }

        app()->setLocale($shortLocale);

        return $next($request);
    }
}
