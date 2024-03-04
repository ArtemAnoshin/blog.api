<?php

namespace Artem\Blogapi\Controller;

use Artem\Blogapi\Service\ArticleService;
use Artem\Blogapi\Validator\ArticleValidator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="My Blog API", version="0.1")
 */

class ArticleController
{
    /**
     * @OA\Get(
     *     tags={"Article"},
     *     path="/article/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer" 
     *         ) 
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Статья найдена.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="string", example="ok"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="id", type="integer"),
     *                  @OA\Property(property="author_name", type="string"),
     *                  @OA\Property(property="body", type="string")
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Статья не найдена.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="number", example="false"),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Article not found."
     *              ),
     *         ),
     *     )
     * )
     */
    public function read(int $id)
    {
        $service = new ArticleService();
        $article = $service->getArticleById($id);

        if ($article) {
            response()->json([
                'success' => 'ok',
                'data'  => $article->asArray(),
            ]);
        }

        response()->httpCode(404);
        response()->json([
            'success' => 'false',
            'message'  => 'Article not found.',
        ]);
    }

    /**
     * @OA\Post(
     *     tags={"Article"},
     *     path="/article",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="author_name", type="string"),
     *              @OA\Property(
     *                  property="body",
     *                  type="string",
     *              ),
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Статья успешно добавлена.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="string", example="ok"),
     *              @OA\Property(
     *                  property="article_id",
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
        $validator = new ArticleValidator();
        $validator->validate(input());

        $service = new ArticleService();
        $id = $service->createArticle(input());

        if ($id) {
            response()->httpCode(201);
            response()->json([
                'success' => 'ok',
                'article_id'  => $id,
            ]);
        }

        response()->httpCode(422);
        response()->json([
            'success' => 'false',
            'message'  => 'Something went wrong.',
        ]);
    }

    /**
     * @OA\Get(
     *     tags={"Article"},
     *     path="/articles",
     *     @OA\Parameter(
     *         name="count",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer" 
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer" 
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Список статей с комментариями.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="string", example="ok"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="article_id", type="integer"),
     *                      @OA\Property(property="author_name", type="string"),
     *                      @OA\Property(property="article_text", type="string"),
     *                      @OA\Property(
     *                          property="comments",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(property="comment_id", type="integer"),
     *                              @OA\Property(property="comment_author", type="string"),
     *                              @OA\Property(property="comment_text", type="string"),
     *                          )
     *                      )
     *                  ),
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Статей не найдено.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="number", example="false"),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="No articles found."
     *              ),
     *         ),
     *     )
     * )
     */
    public function list()
    {
        $service = new ArticleService();
        $articles = $service->getArticles(input());

        if ($articles) {
            response()->json([
                'success' => 'ok',
                'data'  => $articles,
            ]);
        }

        response()->json([
            'success' => 'false',
            'message'  => 'No articles found.',
        ]);
    }

    /**
     * @OA\Get(
     *     tags={"Article"},
     *     path="/article/{id}/comments",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer" 
     *         ) 
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Комментарии для статьи.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="string", example="ok"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="comment_id", type="integer"),
     *                   @OA\Property(property="comment_author", type="string"),
     *                   @OA\Property(property="comment_text", type="string")
     *                  ),
     *              ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Комментарии для статьи отсутствуют.",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="number", example="false"),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="The article has no comments."
     *              ),
     *         ),
     *     )
     * )
     */
    public function comments(int $id)
    {
        $service = new ArticleService();
        $comments = $service->getCommentsByArticleId($id);

        if ($comments) {
            response()->json([
                'success' => 'ok',
                'data'  => $comments,
            ]);
        }

        response()->httpCode(404);
        response()->json([
            'success' => 'false',
            'message'  => 'The article has no comments.',
        ]);
    }
}
