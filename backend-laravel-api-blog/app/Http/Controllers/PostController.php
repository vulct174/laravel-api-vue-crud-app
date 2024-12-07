<?php
/**
 * @author @vulct
 */

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Initialize middleware for the controller.
     * Authenticated routes require Sanctum token except for 'index' and 'show'.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Retrieve and return a collection of all posts with associated user data.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection(Post::with('user')->latest()->get());
    }

    /**
     * Create a new post for the authenticated user.
     *
     * @param Request $request The HTTP request containing the post data.
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required|max:255'],
            'body' => ['required'],
        ]);

        $post = $request->user()->posts()->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => [
                'post' => new PostResource($post),
                'user' => $post->user,
            ],
        ]);
    }

    /**
     * Display details of a specific post.
     *
     * @param Post $post The post to be displayed.
     * @return JsonResponse
     */
    public function show(Post $post)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'post' => new PostResource($post),
                'user' => $post->user,
            ],
        ]);
    }

    /**
     * Update an existing post.
     * Authorization ensures only the owner can modify the post.
     *
     * @param Request $request The HTTP request containing the updated data.
     * @param Post $post The post to be updated.
     * @return JsonResponse
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);

        $data = $request->validate([
            'title' => ['required|max:255'],
            'body' => ['required'],
        ]);

        $post->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => [
                'post' => new PostResource($post),
                'user' => $post->user,
            ],
        ]);
    }

    /**
     * Delete an existing post.
     * Authorization ensures only the owner can delete the post.
     *
     * @param Post $post The post to be deleted.
     * @return JsonResponse
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
}
