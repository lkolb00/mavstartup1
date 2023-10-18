<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

/**
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var null
     */
    protected ?User $theUser = null;

    /**
     * @var string
     */
    protected static string $log_auth_success = 'Auth success';

    /**
     * @var int
     */
    protected static int $plural = 10;

    /**
     * @var array|int[]
     */
    protected static array $pagination_length = ['xx-small'=>10, 'x-small'=>25, 'small'=>50, 'medium'=>100, 'large'=>250, 'x-large'=>500, 'xx-large'=>1000];

    /**
     * @var int
     */
    protected int $per_page = 250;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->per_page = ($request->has('per_page')) ? $request->query('per_page') : self::$pagination_length['medium'];

            return $next($request);
        });
    }

    /**
     * @param $input
     * @return void
     */
    public function populateCreateFields(&$input): void
    {
        if (Auth::check() && $input != null) {
            $input['created_by'] = Auth::getName();
            $input['updated_by'] = Auth::getName();
        }
    }

    /**
     * @param $input
     * @return void
     */
    public function populateCreateFieldsWithUserID(&$input): void
    {
        $this->populateCreateFields($input);
        if (Auth::check() && $input != null) {
            $input['user_id'] =  Auth::id();
        }
    }

    /**
     * @param $input
     * @return void
     */
    public function populateUpdateFields(&$input): void
    {
        if (Auth::check() && $input != null) {
            $input['updated_by'] = Auth::getName();
        }
    }

    /**
     * @param $arr_ids
     * @param $ts
     * @return array
     */
    public function populateCreateFieldsForSyncWithIDs($arr_ids, $ts = false): array
    {
        $syncData = [];
        foreach ($arr_ids as $id) {
            if (Auth::check()) {
                if ($ts) {
                    $syncData[$id] = ['created_by' => Auth::getName(), 'updated_by' => Auth::getName(),
                        'created_at' => date_create(), 'updated_at' => date_create(), ];
                } else {
                    $syncData[$id] = ['created_by' => Auth::getName(), 'updated_by' => Auth::getName()];
                }
            }
        }

        return $syncData;
    }

    /**
     * @param $arr_ids
     * @return array
     */
    public function populateTsFieldsForSyncWithIDs($arr_ids): array
    {
        $syncData = [];
        foreach ($arr_ids as $id) {
            $syncData[$id] = ['created_at' => date_create(), 'updated_at' => date_create()];
        }

        return $syncData;
    }

    /**
     * @param $arr_data
     * @param $field
     * @param $type
     * @return array
     */
    public function populateCreateFieldsForSyncWithData($arr_data, $field, $type = 'string'): array
    {
        $syncData = [];
        foreach ($arr_data as $data) {
            if (Auth::check()) {
                if ($type == 'boolean') {
                    $syncData[$data['id']] = [$field => true, 'created_by' => Auth::getName(), 'updated_by' => Auth::getName()];
                } else { // assume string - default
                    $syncData[$data['id']] = [$field => $data[$field], 'created_by' => Auth::getName(), 'updated_by' => Auth::getName()];
                }
            }
        }

        return $syncData;
    }

    /**
     * @return array
     */
    public function getArrayCreateFields(): array
    {
        $input = [];
        if (Auth::check() && $input != null) {
            $input['created_by'] = Auth::getName();
            $input['updated_by'] = Auth::getName();
        }

        return $input;
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getLoginUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        if (Auth::check()) {
            return Auth::user();
        }

        return null;
    }

    /**
     * @return null
     */
    public function getLoginUserId()
    {
        if (Auth::check()) {
            return Auth::id();
        }

        return null;
    }

    /**
     * @param $objects
     * @return array
     */
    public function getListofIdsFromModelCollection($objects): array
    {
        $list = [];
        $count = 0;
        foreach ($objects as $obj) {
            $list[$count++] = $obj->id;
        }

        return $list;
    }

//    public function isAdmin()
//    {
//        $user = $this->getLoginUser();
//
//        return (isset($user)) ? $user->isAdmin() : false;
//    }

    /**
     * @param $method
     * @param Request $request
     * @param QueryException $queryException
     * @return void
     */
    protected function logQueryException($method, Request $request, QueryException $queryException): void
    {
        $user = session('user');
        if (! isset($user)) {
            $user = $this->getLoginUser();
        }
        Log::error($method . ' IP='.$request->getClientIp());
//        Log::error($method. isset($user) ? $user->getName() : '::' .' IP='.$request->getClientIp());
        Log::error($method.' '.$queryException->getMessage());
    }

    /**
     * @param $method
     * @param $msg
     * @return void
     */
    protected function logInfo($method, $msg = null): void
    {
        $user = session('user');
        if (! isset($user)) {
            $user = $this->getLoginUser();
        }
//        Log::info($method.' '.isset($user) ? $user->getName() : '::'.' '.trim($msg));
        Log::info($method.' '.trim($msg));
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function hasInput(Request $request): bool
    {
        return count($request->all()) > 0;
    }
}
