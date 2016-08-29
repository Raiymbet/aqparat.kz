<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'short_description', 'text', 'language'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['author_id', 'category_id', 'views', 'shares', 'likes', 'ismainnew'];

    public function author(){
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function posts(){
        return $this->hasOne(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function comments_without_replies(){
        return $this->comments()->commentsWithoutReplies();
    }
    
    public function comments_count(){
        return $this->comments()->count();
    }

    public function likes(){
        return $this->belongsToMany('App\User', 'likes');
    }

    public function SliderNew(){
        return $this->belongsTo(SliderNew::class,'new_id');
    }

    public function translates(){
        return $this->hasMany(Translate::class, 'news_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }
    
    /**
     * query scope nPerGroup
     *
     * @return void
     */
    public function scopeNPerGroup($query, $group, $n = 10)
    {
        // queried table
        $table = ($this->getTable());

        // initialize MySQL variables inline
        $query->from( \DB::raw("(SELECT @rank:=0, @group:=0) as vars, {$table}") );

        // if no columns already selected, let's select *
        if ( ! $query->getQuery()->columns)
        {
            $query->select("{$table}.*");
        }

        // make sure column aliases are unique
        $groupAlias = 'group_'.md5(time());
        $rankAlias  = 'rank_'.md5(time());

        // apply mysql variables
        $query->addSelect(\DB::raw(
            "@rank := IF(@group = {$group}, @rank+1, 1) as {$rankAlias}, @group := {$group} as {$groupAlias}"
        ));

        // make sure first order clause is the group order
        $query->getQuery()->orders = (array) $query->getQuery()->orders;
        array_unshift($query->getQuery()->orders, ['column' => $group, 'direction' => 'asc']);

        // prepare subquery
        $subQuery = $query->toSql();

        // prepare new main base Query\Builder
        $newBase = $this->newQuery()
            ->from(\DB::raw("({$subQuery}) as {$table}"))
            ->mergeBindings($query->getQuery())
            ->where($rankAlias, '<=', $n)
            ->getQuery();

        // replace underlying builder to get rid of previous clauses
        $query->setQuery($newBase);
    }
}
