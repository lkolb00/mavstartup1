<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AffiliationRequest;
use App\Http\Resources\MavResource;
use App\Http\Resources\MavResourceCollection;
use App\Models\Affiliation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class AffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return MavResourceCollection|JsonResponse
     * @throws AuthorizationException     *
     */
    public function index(Request $request): MavResourceCollection|JsonResponse
    {
        $this->logInfo(__METHOD__);
        if ($this->authorize('viewAny', [Affiliation::class])) {
            $this->logInfo(__METHOD__, Controller::$log_auth_success);
            try {
                if ($request->query('list')) {
                    $this->logInfo(__METHOD__, 'list');
                    $list = DB::table('affiliations')->select(['id', 'name'])
                        ->orderBy('name')
                        ->pluck('name');

                    return response()->json(['data' => $list], 200);
                } else {
                    $this->logInfo(__METHOD__, 'paginate:'.self::$pagination_length['large']);
                    $list = Affiliation::paginate(self::$pagination_length['large']);

                    return new MavResourceCollection($list);
                }
            } catch (QueryException $ex) {
                $this->logQueryException(__METHOD__, $request, $ex);

                return response()->json(['data' => __('messages.model_index_view_unsuccessful', ['model' => 'Project Accessions'])], 422);
            }
        } else {
            return response()->json(['data' => 'Not authorized to view all resources'], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AffiliationRequest $request
     * @return MavResource|JsonResponse
     * @throws AuthorizationException
     */
    public function store(AffiliationRequest $request): MavResource|JsonResponse
    {
        $this->logInfo(__METHOD__);
        if ($this->authorize('create', Affiliation::class)) {
            $this->logInfo(__METHOD__, Controller::$log_auth_success);
            try {
                if (! $this->hasInput($request)) {
                    return response()->json(['data' => 'Request is empty'], 400);
                }
                $object = Affiliation::create($request->all());

                return new MavResource($object);
            } catch (QueryException $ex) {
                $this->logQueryException(__METHOD__, $request, $ex);

                return response()->json(['data' => __('messages.model_add_unsuccessful', ['model' => 'Affiliation'])], 422);
            }
        } else {
            return response()->json(['data' => 'Not authorized to create resource'], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Affiliation|null $affiliation
     * @return MavResource|JsonResponse
     * @throws AuthorizationException
     */
    public function show(Request $request, Affiliation $affiliation = null): MavResource|JsonResponse
    {
        $this->logInfo(__METHOD__);
        if ($this->authorize('view', $affiliation)) {
            $this->logInfo(__METHOD__, Controller::$log_auth_success);
            if (! isset($affiliation)) {
                if ($request->query('id')) {
                    $affiliation = Affiliation::where('id', $request->query('id'))->first();
                }
                if (! isset($affiliation)) {
                    return response()->json(['data' => 'Affiliation not found'], 404);
                }
            }

            $this->logInfo(__METHOD__, $affiliation->id.':'.$affiliation->name);
            return new MavResource($affiliation);
        } else {
            return response()->json(['data' => 'Not authorized to view this resource'], 403);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Affiliation $affiliation
     * @return MavResource|JsonResponse
     * @throws AuthorizationException
     */
    public function update(AffiliationRequest $request, Affiliation $affiliation): MavResource|JsonResponse
    {
        $this->logInfo(__METHOD__, $affiliation->id.':'.$affiliation->name);
        if ($this->authorize('update', [Affiliation::class, $affiliation])) {
            $this->logInfo(__METHOD__, Controller::$log_auth_success);
            try {
                if (! $this->hasInput($request)) {
                    return response()->json(['data' => 'Request is empty'], 400);
                }
                $affiliation->update($request->all());

                return (new MavResource($affiliation))->additional(['message' => __('messages.model_update_successful', ['model' => 'Affiliation']), 200]);
            } catch (QueryException $ex) {
                $this->logQueryException(__METHOD__, $request, $ex);

                return response()->json(['message' => __('messages.model_update_unsuccessful', ['model' => 'Affiliation'])], 404);
            }
        } else {
            return response()->json(['data' => 'Not Authorized to edit resource'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Affiliation $affiliation
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Affiliation $affiliation): JsonResponse
    {
        $this->logInfo(__METHOD__, $affiliation->id.':'.$affiliation->name);
        if ($this->authorize('delete', [Affiliation::class, $affiliation])) {
            $this->logInfo(__METHOD__, Controller::$log_auth_success);
            try {
                $affiliation->delete();

                return response()->json(['data' => 'Resource deleted successfully'], 200);
            } catch (QueryException $ex) {
                $this->logQueryException(__METHOD__, $request, $ex);

                return response()->json(['data' => __('messages.model_delete_unsuccessful', ['model' => 'Affiliation'])], 422);
            }
        } else {
            return response()->json(['data' => 'Not authorized to delete resource'], 403);
        }
    }
}
