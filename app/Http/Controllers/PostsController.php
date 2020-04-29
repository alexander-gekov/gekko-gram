<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $allUsers = User::all();
        //$posts = Post::whereIn('user_id',$users)->orderBy('created_at','DESC')->get();
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(15);
        foreach ($posts as $post) {
            $post->follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        }

        return view('posts.index', compact('posts', 'allUsers'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = \request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = \request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        //return view('posts.show', compact('post'));
        $post->follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function like(Post $post)
    {
        //$id = auth()->user()->id;
        $user = auth()->user();
        $reacter = $user->getLoveReacter();
        $reactant = $post->getLoveReactant();
        $reactionType = ReactionType::fromName('Like');
        $isNotReacted = $reacter->hasNotReactedTo($reactant);
        if ($isNotReacted) {
            $reacter->reactTo($reactant, $reactionType);
        }
        $reactionCounters = $reactant->getReactionCounters();
        return $reactionCounters;
    }

    public function unlike(Post $post){
        $user = auth()->user();
        $reacter = $user->getLoveReacter();
        $reactant = $post->getLoveReactant();
        $reactionType = ReactionType::fromName('Like');
        $isReacted = $reacter->hasReactedTo($reactant, $reactionType);
        if ($isReacted) {
            $reacter->unreactTo($reactant, $reactionType);
        }
        $reactionCounters = $reactant->getReactionCounters();
        return $reactionCounters;
    }

    public function likeCount(Post $post){
        $reactant = $post->getLoveReactant();
        $reactionCounters = $reactant->getReactionCounters();
        return $reactionCounters;
    }

    public function hasReacted(Post $post){
        $user = auth()->user();
        $reacter = $user->getLoveReacter();
        $reactant = $post->getLoveReactant();
        $reactionType = ReactionType::fromName('Like');
        $isReacted = $reacter->hasReactedTo($reactant, $reactionType);
        if($isReacted){
            return true;
        }
        else{
            return false;
        }
    }
}
