<?php

    namespace App\Http\Middleware;

    use App\Providers\Constants\ApiConstants;
    use App\Token;
    use App\User;
    use Closure;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Exceptions\TokenExpiredException;
    use Tymon\JWTAuth\Exceptions\TokenInvalidException;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Tymon\JWTAuth\Providers\Auth\AuthInterface;

    class VerifyAuthHeader
    {

        /**
         * Handle an incoming request.
         *
         * @param AuthInterface $auth
         *
         * @internal param \Illuminate\Http\Request $request
         * @internal param Closure $next
         */
        public function __construct(AuthInterface $auth)
        {

            $this->auth = $auth;
        }





        public function handle($request , Closure $next)
        {

            if (!$request->header('Authorization')) {
                return response()->json(['sucess' => FALSE , 'msg' => 'Access token is required'] , ApiConstants::STATUS_BAD_REQUEST);
            }

            try {

                $token = JWTAuth::parseToken();
                $userDetails = JWTAuth::parseToken()->toUser();
                $tokenCheck = User::where(['id' => $userDetails->id])->first();
                //dd($tokenCheck->id .'    '.$tokenCheck->email);

                if (!$tokenCheck) {
                    return response()->json([
                        'success' => FALSE ,
                        'msg'     => 'Please login again.' ,
                        'error'   => 'Please login again.'
                    ] , ApiConstants::STATUS_UNAUTHORIZED);

                }
            } catch (JWTException $ex) {
                return response()->json(['success' => FALSE , 'msg' => $ex->getMessage()] , ApiConstants::STATUS_BAD_REQUEST);
            } catch (TokenInvalidException $ex) {
                return response()->json(['success' => FALSE , 'msg' => $ex->getMessage()] , ApiConstants::STATUS_BAD_REQUEST);
            }

            if ($tokenCheck == FALSE) {
                return response()->json(['success' => FALSE , 'msg' => 'User information cannot be parsed'] , ApiConstants::STATUS_FORBIDDEN);
            }

            return $next($request);

        }





        // get authenticated user
        public function getAuthenticatedUser()
        {

            try {

                if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'] , 404);
                }

            } catch (TokenExpiredException $e) {

                return response()->json(['token_expired'] , $e->getStatusCode());

            } catch (TokenInvalidException $e) {

                return response()->json(['success' => FALSE , 'msg' => $e->getStatusCode()]);
                //                return response()->json(['token_invalid'] , $e->getStatusCode());

            } catch (JWTException $e) {

                return response()->json(['token_absent'] , $e->getStatusCode());

            }

            // the token is valid and we have found the user via the sub claim
            return response()->json(compact('user'));
        }
    }







