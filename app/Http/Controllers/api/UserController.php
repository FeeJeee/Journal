<?php

namespace App\Http\Controllers\api;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FileService;

class UserController extends Controller
{
    public function __construct(
        protected FileService $fileService,
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Show all users",
     *     tags={"Users"},
     *     operationId="usersIndex",
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
     *         description="Returned users list",
     *     ),
     * )
     */

    public function index()
    {
        $users = User::filter()->paginate(5);

        return UserResource::collection($users);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Create user",
     *     tags={"Users"},
     *     operationId="usersStore",
     *     security={ {"bearer": {} }},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "surname", "patronymic", "email", "password", "password_confirmation", "group_id", "birthdate", "adress", "role"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="surname", type="string", format="string", example="Surname"),
     *            @OA\Property(property="patronymic", type="string", format="string", example="Patronymic"),
     *            @OA\Property(property="email", type="string", format="email", example="example@example.com"),
     *            @OA\Property(property="password", type="string", format="password", example="Password"),
     *            @OA\Property(property="password_confirmation", type="string", format="password", example="Password"),
     *            @OA\Property(property="group_id", type="int", format="string", example="1"),
     *            @OA\Property(property="birthdate", type="date", format="string", example="2000-12-12"),
     *            @OA\Property(property="address",
     *                  @OA\Property(property="city", type="string", format="string", example="City"),
     *                  @OA\Property(property="street", type="string", format="string", example="Street"),
     *                  @OA\Property(property="building", type="int", format="string", example="123"),
     *            ),
     *            @OA\Property(property="role", type="int", format="string", example="1"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned created user"
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
    public function store(StoreUserRequest $request)
    {
        $this->authorize('store', [User::class, $request->validated()]);

        $user = User::create($request->validated());

        event(new UserCreated($user, $request->validated('password')));

        return new UserResource($user);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     summary="Show user info",
     *     tags={"Users"},
     *     operationId="usersShow",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="User id",
     *          in="path",
     *          name="user",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned user"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *     ),
     * )
     */
    public function show(User $user)
    {
        $subjects = $user->subjects();

        return new UserResource($subjects);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}",
     *     summary="Update user",
     *     tags={"Users"},
     *     operationId="usersUpdate",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="User id",
     *          in="path",
     *          name="user",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "surname", "patronymic", "email", "password", "password_confirmation", "group_id", "birthdate", "adress", "role"},
     *            @OA\Property(property="name", type="string", format="string", example="Name"),
     *            @OA\Property(property="surname", type="string", format="string", example="Surname"),
     *            @OA\Property(property="patronymic", type="string", format="string", example="Patronymic"),
     *            @OA\Property(property="email", type="string", format="email", example="example@example.com"),
     *            @OA\Property(property="password", type="string", format="password", example="Password"),
     *            @OA\Property(property="password_confirmation", type="string", format="password", example="Password"),
     *            @OA\Property(property="group_id", type="int", format="string", example="1"),
     *            @OA\Property(property="birthdate", type="date", format="string", example="2000-12-12"),
     *            @OA\Property(property="address",
     *                  @OA\Property(property="city", type="string", format="string", example="City"),
     *                  @OA\Property(property="street", type="string", format="string", example="Street"),
     *                  @OA\Property(property="building", type="int", format="string", example="123"),
     *            ),
     *            @OA\Property(property="role", type="int", format="string", example="1"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned updated user"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Not enough rights",
     *     ),
     * )
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', [$user, $request->validated()]);

        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user}",
     *     summary="Delete user",
     *     tags={"Users"},
     *     operationId="usersDestroy",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="User id",
     *          in="path",
     *          name="user",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned deleted user"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Not enough rights",
     *     ),
     * )
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return new UserResource($user);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}/pdf",
     *     summary="Pdf user",
     *     tags={"Users"},
     *     operationId="usersPdf",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="User id",
     *          in="path",
     *          name="user",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned link to user profile pdf"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *     ),
     * )
     */
    public function toPdf(User $user)
    {
        return $this->fileService->apiUserToPdf($user);
    }
}
