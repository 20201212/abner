<?php


namespace app\admin\middleware;


class Auth
{
    public function handle($request, \Closure  $next){
        //前置中间件
        if(empty(session(config('admin.session_admin'))) && !preg_match('(verify|login)', $request->pathinfo()) ){
            return redirect(url('login/index'));
        }
        $response = $next($request);

        return $response;
    }














}