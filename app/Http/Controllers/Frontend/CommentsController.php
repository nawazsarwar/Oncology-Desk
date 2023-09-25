<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Report;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CommentsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comments = Comment::with(['commentable', 'media'])->get();

        return view('frontend.comments.index', compact('comments'));
    }

    public function create()
    {
        abort_if(Gate::denies('comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commentables = Report::pluck('summary', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.comments.create', compact('commentables'));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        if ($request->input('attachment', false)) {
            $comment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $comment->id]);
        }

        return redirect()->route('frontend.comments.index');
    }

    public function edit(Comment $comment)
    {
        abort_if(Gate::denies('comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commentables = Report::pluck('summary', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comment->load('commentable');

        return view('frontend.comments.edit', compact('comment', 'commentables'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        if ($request->input('attachment', false)) {
            if (! $comment->attachment || $request->input('attachment') !== $comment->attachment->file_name) {
                if ($comment->attachment) {
                    $comment->attachment->delete();
                }
                $comment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($comment->attachment) {
            $comment->attachment->delete();
        }

        return redirect()->route('frontend.comments.index');
    }

    public function show(Comment $comment)
    {
        abort_if(Gate::denies('comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->load('commentable');

        return view('frontend.comments.show', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        abort_if(Gate::denies('comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommentRequest $request)
    {
        $comments = Comment::find(request('ids'));

        foreach ($comments as $comment) {
            $comment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('comment_create') && Gate::denies('comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Comment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
