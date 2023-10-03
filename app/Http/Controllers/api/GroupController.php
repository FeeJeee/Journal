<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    /**
     * @OA\Get(
     *     path="/api/groups",
     *     summary="Show all groups",
     *     tags={"Groups"},
     *     operationId="groupsIndex",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *         description="Page",
     *         in="query",
     *         name="page",
     *         required=false,
     *         @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Returned groups list",
     *     ),
     * )
     */
    public function index()
    {
        $groups = Group::filter()->paginate(5);

        return GroupResource::collection($groups);
    }

    /**
     * @OA\Post(
     *     path="/api/groups",
     *     summary="Create group",
     *     tags={"Groups"},
     *     operationId="groupsStore",
     *     security={ {"bearer": {} }},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title"},
     *            @OA\Property(property="title", type="string", format="string", example="Group"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned created group"
     *      ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Not enough rights",
     *     ),
     * )
     */
    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->validated());

        return new GroupResource($group);
    }

    /**
     * @OA\Get(
     *     path="/api/groups/{group}",
     *     summary="Show group info",
     *     tags={"Groups"},
     *     operationId="groupsShow",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="Group id",
     *          in="path",
     *          name="group",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned group"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Group not found",
     *     ),
     * )
     */
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * @OA\Put(
     *     path="/api/groups/{group}",
     *     summary="Update group",
     *     tags={"Groups"},
     *     operationId="groupsUpdate",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="Group id",
     *          in="path",
     *          name="group",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title"},
     *            @OA\Property(property="title", type="string", format="string", example="Group"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned created group"
     *      ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Not enough rights",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Group not found",
     *     ),
     * )
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return new GroupResource($group);
    }

    /**
     * @OA\Delete(
     *     path="/api/groups/{group}",
     *     summary="Delete group",
     *     tags={"Groups"},
     *     operationId="groupsDestroy",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="Group id",
     *          in="path",
     *          name="group",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned deleted group"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Group not found",
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Not enough rights",
     *     ),
     * )
     */
    public function destroy(Group $group)
    {
        foreach ($group->users as $user) {
            $user->subjects()->detach();

            $user->delete();
        }

        $group->delete();

        return new GroupResource($group);
    }
}
