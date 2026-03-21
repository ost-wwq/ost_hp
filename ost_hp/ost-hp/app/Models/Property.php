<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title', 'property_type', 'status', 'price',
        'address', 'area', 'rooms', 'age',
        'description', 'main_image', 'images', 'published',
    ];

    protected $casts = [
        'images'    => 'array',
        'published' => 'boolean',
        'price'     => 'integer',
        'area'      => 'decimal:2',
        'age'       => 'integer',
    ];

    // 公開中の物件のみ
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    // 種別ラベル
    public static function typeOptions(): array
    {
        return [
            'mansion'  => 'マンション',
            'house'    => '一戸建て',
            'land'     => '土地',
            'office'   => '事務所・店舗',
            'other'    => 'その他',
        ];
    }

    public function typeLabel(): string
    {
        return static::typeOptions()[$this->property_type] ?? $this->property_type;
    }

    // ステータスラベル・カラー
    public static function statusOptions(): array
    {
        return [
            'available' => ['label' => '販売中',   'color' => 'teal'],
            'contract'  => ['label' => '商談中',   'color' => 'orange'],
            'closed'    => ['label' => '成約済み', 'color' => 'gray'],
        ];
    }

    public function statusLabel(): string
    {
        return static::statusOptions()[$this->status]['label'] ?? $this->status;
    }

    public function statusColor(): string
    {
        return static::statusOptions()[$this->status]['color'] ?? 'gray';
    }

    // 価格を日本語表示（○○万円）
    public function priceFormatted(): string
    {
        if ($this->price >= 10000) {
            $oku = intdiv($this->price, 10000);
            $man = $this->price % 10000;
            return $man > 0
                ? number_format($oku) . '億' . number_format($man) . '万円'
                : number_format($oku) . '億円';
        }
        return number_format($this->price) . '万円';
    }

    // 全画像一覧（メイン+追加）
    public function allImages(): array
    {
        $imgs = [];
        if ($this->main_image) {
            $imgs[] = $this->main_image;
        }
        if ($this->images) {
            $imgs = array_merge($imgs, $this->images);
        }
        return $imgs;
    }
}
