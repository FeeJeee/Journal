<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subject::class, 'subject');
    }

    /**
     * @OA\Get(
     *     path="/api/subjects",
     *     summary="Show all subjects",
     *     tags={"Subjects"},
     *     operationId="subjectsIndex",
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
     *         description="Returned subjects list",
     *     ),
     * )
     */
    public function index()
    {
        $subjects = Subject::filter()->paginate(5);

        return SubjectResource::collection($subjects);
    }

    /**
     * @OA\Post(
     *     path="/api/subjects",
     *     summary="Create subject",
     *     tags={"Subjects"},
     *     operationId="subjectsStore",
     *     security={ {"bearer": {} }},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title"},
     *            @OA\Property(property="title", type="string", format="string", example="Subject"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned created subject"
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
    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * @OA\Get(
     *     path="/api/subjects/{subject}",
     *     summary="Show subject info",
     *     tags={"Subjects"},
     *     operationId="subjectsShow",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="Subject id",
     *          in="path",
     *          name="subject",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned subject"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Subject not found",
     *     ),
     * )
     */
    public function show(Subject $subject)
    {
        return new SubjectResource($subject);
    }

    /**
     * @OA\Put(
     *     path="/api/subjects/{subject}",
     *     summary="Update subject",
     *     tags={"Subjects"},
     *     operationId="subjectsUpdate",
     *     security={ {"bearer": {} }},
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
     *            required={"title"},
     *            @OA\Property(property="title", type="string", format="string", example="Subject"),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned created subject"
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
     *         description="Subject not found",
     *     ),
     * )
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * @OA\Delete(
     *     path="/api/subjects/{subject}",
     *     summary="Delete subject",
     *     tags={"Subjects"},
     *     operationId="subjectsDestroy",
     *     security={ {"bearer": {} }},
     *
     *     @OA\Parameter(
     *          description="Subject id",
     *          in="path",
     *          name="subject",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Returned deleted subject"
     *      ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Subject not found",
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Not enough rights",
     *     ),
     * )
     */
    public function destroy(Subject $subject)
    {
        $subject->users()->detach();

        $subject->delete();

        return new SubjectResource($subject);
    }
}
