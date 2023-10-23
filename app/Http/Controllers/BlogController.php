<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public $blog, $file, $path, $codeFile;
    public function __construct(Blog $blog, FileService $file)
    {
        $this->blog = $blog;
        $this->file = $file;
        $this->path = "thumbnail_image";
        $this->codeFile = "thumbnail";
    }
    public function index()
    {
        $articles = Blog::orderBy('created_at', 'desc')->get()->load('category', 'user');
        return view('admin.articles', compact('articles'));
    }
    public function adminDashboard()
    {
        $articleByYear = $this->blog->annualArticleCount();

        $bestCategory = $this->blog->getBestCategory()->load('category');
        $mostCategory = $bestCategory->map(function ($item) {
            return (object) [
                'total' => $item->total,
                'label' => $item->category->name
            ];
        });

        $trackUpload = $this->blog->getTrackUpload();

        return view('admin.dashboard', compact('articleByYear', 'mostCategory', 'trackUpload'));
    }
    public function create()
    {
        $categories = Category::get();
        return view('admin.add_articles_form', compact('categories'));
    }
    public function store(ArticleRequest $req)
    {
        $validated = $req->validated();
        $slug = Str::slug($req->title, '-');
        DB::beginTransaction();
        try {
            if ($this->blog->where('slug', $slug)->first()) {
                return redirect()->back()->withInput()->withErrors(['title' => 'Title already in use!']);
            } else {
                $validated['slug'] = $slug;
                $validated['author'] = Auth::user()->id;
                $validated['thumbnail'] = $this->file->store($req->file('thumbnail'), $this->path, $this->codeFile);
            }
            $this->blog->create($validated);
            DB::commit();
            return redirect()->route('articles')->with('success', 'Your articles has uplaoded!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => config('app.env') == "local" ? $th->getMessage() : 'Upload file is failed!']);
        }
    }
    public function destroy(Blog $blog)
    {
        if (!Gate::allows('blog-access', [auth()->user(), $blog])) {
            return redirect()->back()->withErrors(['error' => 'Access denied!']);
        }
        try {
            DB::beginTransaction();
            if ($blog->delete()) {
                $this->file->remove($blog->thumbnail, $this->path);
            }
            DB::commit();
            return redirect()->route('articles')->with('success', 'Your article has deleted!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => config('app.env') == "local" ? $th->getMessage() : 'Delete article is failed!']);
        }
    }
}
