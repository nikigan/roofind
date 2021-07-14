<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $creator_id
 * @property float|null $price
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $files
 * @property-read \App\Models\User|null $creator
 * @property-read mixed $excerpt
 * @property-read mixed $first_image
 * @property-read mixed $images
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project userProjects()
 * @method static Builder|Project whereCreatedAt( $value )
 * @method static Builder|Project whereCreatorId( $value )
 * @method static Builder|Project whereDescription( $value )
 * @method static Builder|Project whereFiles( $value )
 * @method static Builder|Project whereId( $value )
 * @method static Builder|Project wherePrice( $value )
 * @method static Builder|Project whereTitle( $value )
 * @method static Builder|Project whereUpdatedAt( $value )
 * @method static Builder|Project whereViews( $value )
 * @mixin \Eloquent
 * @property string|null $lat
 * @property string|null $lon
 * @property string $status
 * @property int|null $executor_id
 * @property int $city_id
 * @property-read \App\Models\City $city
 * @property-read \App\Models\User|null $executor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Feature[] $features
 * @property-read int|null $features_count
 * @property-read \App\Models\Review|null $review
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static Builder|Project whereCityId($value)
 * @method static Builder|Project whereExecutorId($value)
 * @method static Builder|Project whereLat($value)
 * @method static Builder|Project whereLon($value)
 * @method static Builder|Project whereStatus($value)
 */
class Project extends Model {
    use HasFactory;

    protected $guarded = [];

    public function creator() {
        return $this->belongsTo( User::class, 'creator_id' );
    }

    public function executor() {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'features_projects');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeUserProjects( Builder $query ): Builder {
        return $query->where( 'creator_id', '=', auth()->id() );
    }

    public function getExcerptAttribute() {
        return Str::substr( $this->description, 0, 30 );
    }

    public function getFirstImageAttribute() {
        $image = $this->getImagesAttribute()[0] ?? null;
        if ( $image ) {
            $image = asset( 'storage/' . $image );
        }

        return $image ?? 'https://dummyimage.com/360x360/ddd/aaa';
    }

    public function getImagesAttribute() {
        return json_decode( $this->files );
    }
}
