<?php

/**
 * Mav JsonResource
 *
 * @category
 *
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2023-2024, Sachin Pawaskar, All rights reserved.
 * @license    Proprietary software, All rights reserved.
 *
 * @version    GIT: $Id$
 *
 * @since      File available since Release 3.0.0
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class MavResource extends JsonResource
{
    protected static array $crud_keys = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by'];

    protected bool $no_crud_ts = false;

    protected $remove_keys = null;

    /**
     * @var array
     */
    public static array $meta = ['meta' => [
        'app_name' => 'Mav Startup',
        'app_version' => '1.0.0',
        'api_version' => '1.0',
        'author' => 'Sachin Pawaskar',
        'author_email' => 'sachinpawaskar@msn.com, spawaskar@unomaha.edu',
        'copyright' => 'Copyright © 2023 - 2024 Sachin Pawaskar. All Rights Reserved.',
    ]];

    /**
     * Create a new resource instance.
     *
     * @param mixed $resource
     * @param array|null $remove_keys
     */
    public function __construct($resource, $remove_keys = null, bool $no_crud_ts = false)
    {
        parent::__construct($resource);
        if (isset($remove_keys)) {
            $this->remove_keys = $remove_keys;
        }
        $this->no_crud_ts = $no_crud_ts;
        if ($this->no_crud_ts === true) {
            $this->remove_keys = isset($remove_keys) ? array_merge($remove_keys, $this::$crud_keys) : $this::$crud_keys;
        }
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (isset($this->remove_keys)) {
            return $this->remove_fields(parent::toArray($request));
        }

        return parent::toArray($request);
    }

    public function with(Request $request): array
    {
        return ['status' => 'success',
            'meta' => array_merge(self::$meta['meta'], ['app' => config('app.name'),
                'app_version' => config('mav.version'),
                'api_version' => config('mav.api_version'),
                'copyright' => __('messages.copyright', ['year_to' => date("Y")]),
            ])
        ];
    }

    protected function remove_fields($array)
    {
        Arr::forget($array, $this->remove_keys);

        return $array;
    }
}

