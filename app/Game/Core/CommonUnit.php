<?php

namespace App\Game\Core;

/**
 * Trait CommonUnit
 * @package App\Game\Core
 */
trait CommonUnit
{
    /**
     * 进入游戏.
     *
     * @param array  $data   进入游戏数据.
     * @param string $method 跳转的方法.
     * @return string
     */
    public function generateRedirectGameString(array $data, string $method): string
    {
        $html  = '<h3>正在前往游戏中...</h3>' . PHP_EOL;
        $html .= '<form id="submit" name="submit" action="';
        $html .= $this->gameInfo['inGameUrl'] . '" method="' . $method . '" >' . PHP_EOL;
        foreach ($data as $dataKey => $dataValue) {
            $html .= '<input style="display:none;" name="' . $dataKey . '" value="' . $dataValue . '" />' . PHP_EOL;
        }
        $html .= '<input type="submit" value="提交" style="display:none;" />';
        $html .= '</form>' . PHP_EOL;
        $html .= '<script>document.forms["submit"].submit();</script>';
        return $html;
    }

    /**
     * 得到进入第三方游戏的用户名称.
     *
     * @return string
     */
    public function getToGameName(): string
    {
        $name = $this->userInfo['platform'] . '_' . $this->userInfo['uid'];
        return $name;
    }
}
