<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App;
use App\Http\Resources\BaseResource;
use Illuminate\Support\Facades\Storage;

/**
 * Class SystemSlidesResource
 * @package App\Http\Resources\GamesLobby
 */
class SystemSlidesResource extends BaseResource
{

    /**
     * @var string $title Title.
     */
    private $title;

    /**
     * @var string $link Redirect_url.
     */
    private $link;

    /**
     * @var integer $type Type.
     */
    private $type;

    /**
     * @var string $pic Pic_path.
     */
    private $pic;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $pic = isset($this->pic) ? Storage::disk('resources')->url($this->pic) : null;
        return [
                'title'        => $this->title,
                'pic_path'     => $pic,
                'redirect_url' => $this->link,
                'type'         => $this->type,
               ];
    }
}
