<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDirtyWord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $dirtyWords = ['apple', 'idiot', 'stupid'];
        $from = $request->all();
        foreach($from as $word){
            if($word == 'content'){
                foreach($dirtyWords as $dirtyWords){
                    if(strpos($word, $dirtyWords) !== false){
                        return response('You cannot use dirty words', 400);
                    }
                }
            }
            }
        
        return $next($request);
    }
}
