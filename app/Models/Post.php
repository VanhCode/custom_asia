<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Components\Recusive;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    //use SoftDeletes;
    protected $table = "posts";
    public $parentId = "parent_id";
    protected $guarded = [];
    // public $fillable =['name'];

    protected $appends = ['slug_full','name','slug','description','description_seo','keyword_seo','title_seo','content','language'];
    public function getSlugFullAttribute()
    {
        return makeLink('checkKey', $this->attributes['id'], $this->getSlugAttribute());
    }

    // tạo thêm thuộc tính name
    public function getNameAttribute()
    {
        //  dd($this->translationsLanguage()->first()->name);
        return optional($this->translationsLanguage()->first())->name;
    }

    // tạo thêm thuộc tính slug
    public function getSlugAttribute()
    {
        return optional($this->translationsLanguage()->first())->slug;
    }
    // tạo thêm thuộc tính description
    public function getDescriptionAttribute()
    {
        return optional($this->translationsLanguage()->first())->description;
    }
    // tạo thêm thuộc tính description_seo
    public function getDescriptionSeoAttribute()
    {
        return optional($this->translationsLanguage()->first())->description_seo;
    }

    // tạo thêm thuộc tính keyword_seo
    public function getKeywordSeoAttribute()
    {
        return optional($this->translationsLanguage()->first())->keyword_seo;
    }


    // tạo thêm thuộc tính title_seo
    public function getTitleSeoAttribute()
    {
        return optional($this->translationsLanguage()->first())->title_seo;
    }

    // tạo thêm thuộc tính content
    public function getContentAttribute()
    {
        return optional($this->translationsLanguage()->first())->content;
    }
    // tạo thêm thuộc tính content
    public function getLanguageAttribute()
    {
        return optional($this->translationsLanguage()->first())->language;
    }



    // get tags by relationship nhieu-nhieu by table trung gian post_tags
    // 1 post có nhiều post_tags
    // 1 tag có nhiều post_tags
    // table trung gian post_tags chứa column post_id và tag_id
    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, PostTag::class, 'post_id', 'tag_id')
            ->withTimestamps();
    }
    public function tagsLanguage($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this
            ->belongsToMany(Tag::class, PostTag::class, 'post_id', 'tag_id')
            ->withTimestamps()->where('language', '=', $language);
    }
    public function destinations()
    {
        return $this
            ->belongsToMany(Destination::class, PostDestination::class, 'post_id', 'destination_id')
            ->withTimestamps();
    }
    public function topics()
    {
        return $this
            ->belongsToMany(Topic::class, PostTopic::class, 'post_id', 'topic_id')
            ->withTimestamps();
    }


    // get category by relationship 1 - nhieu
    // 1 category_posts có nhiều post
    // 1 post có 1 category_posts
    // use belongsTo để truy xuất ngược từ post lấy data trong table category
    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_id', 'id');
    }

    // get category by relationship nhiều - 1
    public function getAdmin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    // get comment by relationship nhieu-nhieu by table trung gian post_comments
    // 1 post có nhiều post_comments
    // 1 tag có nhiều post_comments
    // table trung gian post_comments chứa column post_id và tag_id
    public function comments()
    {
        return $this
            ->belongsToMany(Comment::class, PostComment::class, 'post_id', 'comment_id')
            ->withTimestamps();
    }

    public static function getHtmlOption($parentId = "")
    {
        $data = self::all();
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }

    public function key($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(Key::class, "key_id", "id")->where('type', 2)->where('language', '=', $language);
    }
    public function translationsLanguage($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(PostTranslation::class, "post_id", "id")->where('language', '=', $language);
    }
    public function translations()
    {
        return $this->hasMany(PostTranslation::class, "post_id", "id");
    }
    public function postscate()
    {
        return $this
            ->belongsToMany(CategoryPost::class, PostCate::class, 'post_id', 'category_id')
            ->withTimestamps();
    }
}
