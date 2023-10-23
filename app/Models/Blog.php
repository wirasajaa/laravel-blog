<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function annualArticleCount(){
        return $this->select(DB::raw('COUNT(created_at) as total, YEAR(created_at) as year'))->orderBy('year')->groupBy(DB::raw('YEAR(created_at)'))->get();
    }

    public function getBestCategory(){
        return $this->select(DB::raw('COUNT(category_id) as total, category_id'))->groupBy('category_id')->orderBy('total','desc')->limit(3)->get();
    }
    
    public function getTrackUpload(){
        return $this
        ->select(DB::raw('COUNT(category_id) as total,MONTH(created_at) as bulan , MONTHNAME(created_at) as name'))
        ->where(DB::raw('YEAR(created_at)'),DB::raw('YEAR(now())'))
        ->groupBy('bulan','name')
        ->orderBy('bulan','asc')
        ->get();
    }

    public function user(){
        return $this->belongsTo(User::class, 'author','id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
}
