<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App;
use App\Http\Resources\BaseResource;

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
     * @var string $redirect_url Redirect_url.
     */
    private $redirect_url;

    /**
     * @var integer $type Type.
     */
    private $type;

    /**
     * @var string $pic_path Pic_path.
     */
    private $pic_path;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        $pic_path = $this->pic_path;
        if ($pic_path) {
            $pic_path = config('image_domain.' . $this->app_environment) . $pic_path;
        }
        return [
                'title'        => $this->title,
                'pic_path'     => $pic_path,
                'redirect_url' => $this->redirect_url,
                'type'         => $this->type,
               ];
    }
}
