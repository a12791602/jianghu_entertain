<?php

$data = [
         //FrontendAuthController
         '100001' => '您没有访问权限',
         '100002' => '账号密码错误',
         '100003' => '不明来源没有对应看守器匹配',
         '100004' => '您还没有登录',
         //ApiMainController
         '100100' => '机器人等不正常客户禁止请求',
         '100101' => '当前域名非法',
         '100102' => '当前域名所属平台不存在',
         '100103' => '获取当前域名时出现错误',
         //RegisterController
         '200001' => '短信发送异常',
         '200002' => '验证码已过期',
         '200003' => '验证码错误',
         //TestController
         '100200' => '对不起, 获取账户锁失败!',
         '100201' => '对不起, 帐变参数传递有误!',
         '100202' => '对不起, 帐号异常!',
         '100203' => '对不起, 用户余额不足!',
         '100204' => '对不起, 用户帐变时发生错误!',
         '100205' => '对不起, 用户冻结金额不足!',
         //RechargeController
         '100300' => '充值通道异常,请联系客服!',
         '100301' => '充值金额不在范围内,充值失败!',
         '100302' => '通道太火爆了,请更换金额或选择其他通道充值!',
         '100303' => '系统繁忙,下单失败!',
         '100304' => '第三方通道异常,请稍候重试或更换其他支付方式!',
         //Verification Code
         '100501' => '短信发送异常',
         '100502' => '验证码已过期',
         '100503' => '验证码错误',
         '100504' => '该用户已存在',
         '100505' => '该用户不存在',
         //CryptMiddleware
         '100600' => 'data参数传入格式错误',
         '100601' => '解密参数缺失',
         '100602' => '当前域名所属平台SSL证书不存在',
         '100603' => '解密数据出现错误',
         '100604' => '解压JSON数据失败',
         '100605' => 'AES解密失败',
         '100606' => 'DATA参数为空',
         '100607' => '传入的参数不符合规范',
         '100608' => '当前平台SSL证书私钥格式不正确',
         '100609' => '当前域名非法',
         '100610' => '当前域名所属平台不存在',
         '100611' => '获取当前域名时出现错误',
         '100612' => 'RSA加密失败',
         '100613' => 'AES加密失败',
         //GamesLobbyController
         '100700' => '对不起,游戏已关闭!',
         //FrontendUserController
         '100800' => '领取成功',
         '100801' => '已领取过晋级赠金',
         '100802' => '已领取过每周赠金',
         //AccountManagementController
         '100900' => '绑定成功',
         '100901' => '删除成功',
         '100902' => '账户不存在',
         '100903' => '提交成功',
         '100904' => '取款中心有未完成的提现申请!',
         '100905' => '系统异常,提现失败!',
         '100906' => '提现金额异常!',
         //RechargeController
         '101000' => '订单状态异常,撤销失败!',
         '101001' => '系统异常,撤销失败!',
         '101002' => '订单异常,撤销失败!',
         '101003' => '订单状态异常,确认付款失败!',
         '101004' => '系统异常,确认付款失败!',
         '101005' => '订单异常,确认付款失败!',
         // PasswordController
         '102001' => '密码修改成功!',
         '102002' => '密码重置成功!',
        ];
return $data;
