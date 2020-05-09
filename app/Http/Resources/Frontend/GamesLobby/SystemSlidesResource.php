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
        $appEnvironment = App::environment();
        return [
                'title'        => $this->title,
                'pic_path'     => config('image_domain.' . $appEnvironment)  . $this->pic_path,
                'redirect_url' => $this->redirect_url,
                'type'         => $this->type,
               ];
    }
}
