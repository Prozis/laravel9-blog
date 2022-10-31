<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $commentController;

    public function __construct(CommentController $commentController)
    {
        $this->commentController = $commentController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = Post::join('users', 'posts.author_id', '=', 'users.id')
                ->select('posts.*', 'users.name')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('descr', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orderBy('posts.created_at', 'desc')
                ->paginate(10);
            return view('index', compact('posts'));

        }
        $posts = Post::join('users', 'author_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10);

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        if (Auth::check()) {
            return view('posts.create', compact('post'));
        }
        return redirect()->route('index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|unique:posts',
            'img' => 'min:10',
            'descr' => 'required|min:10',
        ]);
        $data['author_id'] = Auth::id();
        $data['short_title'] = $this->getShortTitle($data['title']);

        $post = new Post();

        $post->fill($data);

        $post->save();

        $request->session()->flash('status', 'Post added');
        return redirect()->route('post.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::join('users', 'posts.author_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->findOrFail($id);
        $comments = $this->commentController->index($id);
        $newComment = new Comment();

        return view('posts.show', compact('post', 'comments', 'newComment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $this->validate($request, [
            'title' => 'required|unique:posts,title,' . $id,
            'descr' => 'required|min:10'
        ]);
        $data['short_title'] = $this->getShortTitle($data['title']);

        $post->fill($data);
        $post->save();
        $request->session()->flash('status', 'Post updated');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('post.index');

    }

    public function about()
    {
        return view('about');
    }

    protected function getShortTitle($title)
    {
        return (mb_strlen($title > 30)) ? mb_substr($title, 0, 30) . ' ...' : $title;
    }
}
