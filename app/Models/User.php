<?php

namespace App\Models;

use App\Observers\UserObserver;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements MustVerifyEmail, Wallet, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasWallet, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'phone',
        'email',
        'password',
        'active',
        'verified',
        'address_verified',
        'gender',
        'dob',
        'referrer_id',
        'address',
        'city',
        'state',
        'country_id',
        'zipcode',
        'company'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(new UserObserver());
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('avatar')
            ->useFallbackUrl(Storage::url('profile.png'))
            ->useFallbackPath(Storage::url('profile.png'))
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(150)
                    ->height(150)
                    ->sharpen(10)
                    ->format('jpg')
                    ->fit(Manipulations::FIT_CROP, 150,150)
                    ->nonQueued();
            });
    }

    public function getAvatarUrlAttribute(){
        return $this->getFirstMediaUrl('avatar', 'thumb');
    }

    public function getNameAttribute()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function verifications(){
        return $this->hasMany(UserVerification::class);
    }

    public function delivery_addresses(){
        return $this->hasMany(DeliveryAddress::class);
    }

    public function getDeliveryAddressAttribute(){
        return $this->delivery_addresses()->firstWhere('is_default', '=', true);
    }

    public function getReferralLinkAttribute()
    {
        return route('register', ['ref' => $this->account_id]);
    }

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    public function withdraws(){
        return $this->hasMany(WithdrawRequest::class);
    }

    public function payment_information() {
        return $this->hasOne(PaymentInformation::class);
    }

    public function getAccountVerifiedAttribute(){
        return $this->verified && $this->address_verified;
    }
}
