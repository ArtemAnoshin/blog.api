<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Service\CommentService;
use Artem\Blogapi\Validator\CommentValidator;

class CommentController
{
    /**
     * @OA\Post(
     *     tags={"Comment"},
     *     path="/comment",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="comment_author", type="string"),
     *              @OA\Property(
     *                  property="body",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="article_id",
     *                  type="integer",
     *              ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Комментарий добавлен.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="string", example="ok"),
     *              @OA\Property(
     *                  property="comment_id",
     *                  type="integer",
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Что-то пошло не так. Попробуйте еще раз.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="number", example="false"),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Something went wrong."
     *              ),
     *         ),
     *     )
     * )
     */
    public function create()
    {
        $validator = new CommentValidator();
        $validator->validate(input());


        $service = new CommentService();
        $id = $service->createComment(input());

        if ($id) {
            response()->httpCode(201);
            response()->json([
                'success' => 'ok',
                'comment_id'  => $id,
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'Something went wrong.',
        ]);
    }
}