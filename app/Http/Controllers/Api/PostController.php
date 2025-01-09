<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FavoriteRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use ApiResponse;

    private const PAGINATION_COUNT = 1;
    public function index(Request $request)
    {
        try {
            /// Initialize posts query
            $query = Post::query()
            // Filter by category_id if provided
                ->when($request->filled('category_id'), function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
            // Filter by search query if provided
                ->when($request->filled('search'), function ($query) use ($request) {
                    $query->where('title', 'LIKE', "%{$request->search}%");
                })
                ->latest();

            // Paginate the filtered results
            $posts = $query->paginate(self::PAGINATION_COUNT);

            // Check if any posts were found
            if ($posts->isEmpty()) {
                /// Return an error response if no posts were found
                return $this->errorResponse('No posts found', 404);
            }
            // Return a success response with the posts
            $data = [
                'posts' => PostResource::collection($posts),
                'pagination' => [
                    'current_page' => $posts->currentPage(),
                    'last_page' => $posts->lastPage(),
                    'per_page' => $posts->perPage(),
                    'total' => $posts->total(),
                    'previous_page_url' => $posts->previousPageUrl(),
                    'next_page_url' => $posts->nextPageUrl(),
                    'first_page_url' => $posts->url(1),
                    'last_page_url' => $posts->url($posts->lastPage()),
                ],
            ];
            // Return a success response with the posts
            return $this->successResponse($data, 'Posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {

            // Find the post by its ID
            $post = Post::find($id);

            // Check if the post exists
            if (!$post) {

                // If the post doesn't exist, return an error response
                return $this->errorResponse('Post not found', 404);

            }

            // Return a success response with the post
            return $this->successResponse(new PostResource($post), 'Post retrieved successfully');

        } catch (\Exception $e) {

            // If an exception occurs, return an error response
            return $this->errorResponse($e->getMessage(), 500);

        }
    }
    public function addToFavorites(FavoriteRequest $request)
    {
        try {
            // Validate the request data
            $validated = $request->validated();

            // Toggle the post to the authenticated user's favorites
            $favorite = auth('api')->user()->posts()->toggle($validated);

            // Determine the success message based on the result of the toggle operation
            $message = !empty($favorite['attached'])
            ? 'Post added to favorites successfully'
            : 'Post removed from favorites successfully';

            return $this->successResponse(
                [
                    'is_favorite' => !empty($favorite['attached']),
                    'favorite_status' => $favorite,
                ],
                $message,
                200
            );

        } catch (\Exception $e) {
            // If an exception occurs, return an error response
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function getFavorites()
    {
        try {
            // Get the authenticated user
            $user = auth('api')->user();

            // Get the user's favorite posts
            $favorites = $user->posts;

            // Check if there are any favorite posts
            if ($favorites->isEmpty()) {
                // If no favorite posts, return an error response
                return $this->errorResponse('No favorite posts found', 404);
            }

            // Return a success response with the favorite posts
            return $this->successResponse(PostResource::collection($favorites), 'Favorites retrieved successfully');

        } catch (\Exception $e) {
            // If an exception occurs, return an error response
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
