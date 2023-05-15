<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::paginate(6);
        return view('dashboard', compact('comments'));
    }

    public function mydashboard()
    {
        $comments = Comment::where('user_id', Auth::id())->paginate(6);
        return view('profile.mydashboard', compact('comments'));
    }

    public function mylikes()
    {
        $comments = Comment::whereHas('likes',function ($query){
            $query->where('user_id',Auth::id());
        });
        $comments = $comments->paginate(6);
        return view('profile.mylikes', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $storeData = [];
        if($request->file('image')){
            // ディレクトリ
            $dir = 'public/images/comments/';
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            // 取得したファイル名で保存
            $request->file('image')->storeAs($dir, $file_name);
            $storeData += [
                'image' => $file_name,
            ];
        }

        $storeData += [
            'user_id' => Auth::id(),
            'manufacturer' => $request->manufacturer,
            'event' => $request->event,
            'dominant_hand' => $request->dominant_hand,
            'model' => $request->model,
            'available' => $request->available,
            'sale' => $request->sale,
            'similar_products' => $request->similar_products,
            'store' => $request->store,
            'recommends' => $request->recommends,
            'free_review' => $request->free_review,
        ];
        // レビューの作成処理
        $comment = Comment::create($storeData);

        // コメント作成後の処理
        return redirect()->route('comments.show', ['comment' => $comment])->with('success', 'コメントが作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show($comment_id)
    {
        // comment_idを使用して、特定のレコードを取得する
        $comment = Comment::findOrFail($comment_id);

        // user_idを使用して、user_nameを取得する
        $user = User::findOrFail($comment->user_id);
        $user_name = $user->name;

        // 取得したレコードとuser_nameを詳細ビューに渡す
        return view('comments.show', compact('comment', 'user_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit',  compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $storeData = [];
        if($request->file('image')){
            // ディレクトリ
            $dir = 'public/images/comments/';
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            // 取得したファイル名で保存
            $request->file('image')->storeAs($dir, $file_name);
            $storeData += [
                'image' => $file_name,
            ];
        }

        $storeData += [
            'user_id' => Auth::id(),
            'manufacturer' => $request->manufacturer,
            'event' => $request->event,
            'dominant_hand' => $request->dominant_hand,
            'model' => $request->model,
            'available' => $request->available,
            'sale' => $request->sale,
            'similar_products' => $request->similar_products,
            'store' => $request->store,
            'recommends' => $request->recommends,
            'free_review' => $request->free_review,
        ];

        // レビューの作成処理
        Comment::where('id', $comment->id)->update($storeData);

        // コメント作成後の処理
        return redirect()->route('comments.show', ['comment' => $comment->id])->with('success', 'コメントが作成されました');
    }

    /**
     * 指定されたリソースをストレージから削除します。
     * TODO: Storageの画像を削除する処理が必要
     */
    public function destroy(Comment $comment)
    {
        // コメントの削除処理を実行
        $comment->delete();

        // 成功したことを示すメッセージをフラッシュデータに保存
        session()->flash('success', 'コメントが削除されました。');

        // 削除後のリダイレクト先を指定
        return redirect()->route('dashboard');
    }

    public function toggleLike(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $user = Auth::user();

        if ($comment->likes()->where('user_id', $user->id)->exists()) {
            // いいねが既に存在する場合は削除
            $comment->likes()->where('user_id', $user->id)->delete();
            return response()->json(['message' => 'いいねが削除されました']);
        } else {
            // いいねが存在しない場合は追加
            $comment->likes()->create(['user_id' => $user->id]);
            return response()->json(['message' => 'いいねが追加されました']);
        }
    }
}
