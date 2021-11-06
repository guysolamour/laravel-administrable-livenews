<?php

namespace Guysolamour\Administrable\Extensions\Livenews\Models;

use Illuminate\Support\Str;
use Guysolamour\Administrable\Models\BaseModel;
use Guysolamour\Administrable\Traits\DaterangeTrait;
use Guysolamour\Administrable\Traits\DraftableTrait;
use Guysolamour\Administrable\Casts\DaterangepickerCast;

class Livenews extends BaseModel
{
    private const HTML_HEADINGS  = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

    use DraftableTrait;
    use DaterangeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['size', 'online', 'uppercase', 'started_at', 'ended_at', 'content', 'text_color', 'background_color'];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'extensions_livenews';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'size'       => 'integer',
        'online'     => 'boolean',
        'uppercase'  => 'boolean',
        'started_at' => DaterangepickerCast::class,
        'ended_at'   => DaterangepickerCast::class,
    ];

    /**
     * The default attribute values.
     *
     * @var array
     */
    protected $attributes = [
        'size'             => 30,
        'online'           => true,
        'uppercase'        => false,
        'text_color'       => '#FFFFFF',
        'background_color' => '#FF0000',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $datepickers = [
        'started_at', 'ended_at',
    ];


    public function parseContent(array $tags = ['p', 'h', 'code']): string
    {
        $string = $this->content;

        foreach ($tags as $tag) {
            if ($tag == 'h') {
                foreach (self::HTML_HEADINGS as $h) {
                    $string =  str_replace(["<$h>", "</$h>"], '', $string);
                }
            } else {
                $string =  str_replace(["<$tag>", "</$tag>"], '', $string);
            }
        }

        return $this->uppercase ? Str::upper($string) : $string;
    }

}
