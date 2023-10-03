<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\StoreGradeRequest;
use App\Http\Requests\Grade\UpdateGradeRequest;
use App\Http\Resources\UserResource;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class GradeController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/users/{user}/subjects",
     *     summary="Create grade",
     *     tags={"Grades"},
     *     operationId="gradesStore",
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
     *            required={"grade", "subject_id", "user_id"},
     *            @OA\Property(property="grade", type="int", format="string", example="5"),
     *            @OA\Property(property="subject_id", type="int", format="string", example="1"),
     *            @OA\Property(property="user_id", type="int", format="string", example="1"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Returned user grades"
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
     *         description="User not found",
     *     ),
     * )
     */

    public function store(StoreGradeRequest $request, User $user)
    {
        Gate::authorize('store-update-delete-grade', $user);

        $user->subjects()->attach($request->validated()['subject_id'], $request->validated());

        $subjects = $user->subjects;

        return new UserResource($subjects);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}/subjects/{subject}",
     *     summary="Update grade",
     *     tags={"Grades"},
     *     operationId="gradesUpdate",
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
     *     @OA\Parameter(
     *          description="Subject id",
     *          in="path",
     *          name="subject",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"grade"},
     *            @OA\Property(property="grade", type="int", format="string", example="5"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Returned user grades"
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
     *         description="Grade not found",
     *     ),
     * )
     */
    public function update(UpdateGradeRequest $request, User $user, Subject $subject)
    {
        Gate::authorize('store-update-delete-grade', $user);

        $user->subjects()->updateExistingPivot($subject->id, $request->validated());

        $subjects = $user->subjects;

        return new UserResource($subjects);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user}/subjects/{subject}/",
     *     summary="Delete grade",
     *     tags={"Grades"},
     *     operationId="gradesDelete",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="User id",
     *          in="path",
     *          name="user",
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Parameter(
     *          description="Subject id",
     *          in="path",
     *          name="subject",
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Returned user grades"
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
     *         description="Grade not found",
     *     ),
     * )
     */
    public function destroy(User $user, Subject $subject)
    {
        Gate::authorize('store-update-delete-grade', $user);

        $user->subjects()->detach($subject->id);

        $subjects = $user->subjects;

        return new UserResource($subjects);
    }
}
