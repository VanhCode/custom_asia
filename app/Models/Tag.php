<?php

namespace App\Models;

use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = "tags";
    protected $guarded = [];

    public function products()
    {
        return $this
            ->belongsToMany(Product::class, ProductTag::class, 'tag_id', 'product_id')
            ->withTimestamps();
    }
    public function productsLanguage($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this
            ->belongsToMany(Product::class, ProductTag::class, 'tag_id', 'product_id')
            ->withTimestamps()->where('language', '=', $language);
    }

    public function productTags($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany(ProductTag::class, 'tag_id', 'id')->where('product_tags.language', '=', $language);
    }
}
