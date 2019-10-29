<?php

/**
 * @Notes  : 获取 新的webhook数据
 * @return :mixed
 * @user   : Metal
 * @time   : 2019/9/11_下午3:23
 * @throws \yii\base\InvalidConfigException
 */

function actionNewFreshdeskHooks()
{
    header('Access-Control-Allow-Origin: *');
    try {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request                    = Yii::$app->request;
        $headers                    = Yii::$app->getRequest()->getHeaders()->toArray();
        $x_header                   = $headers['x-header'][0];
        $pwd_api                    = 'aaabbbccc';
        $sign                       = md5(md5(trim($pwd_api)) . 'efg');
        if ($x_header != $sign) {
            die();
        }
        $input_data = $request->bodyParams;
        if (empty($input_data)) {
            $input_data = file_get_contents('php://input', 'rb');
        } else {
            $input_data = json_encode($input_data);
        }
        $push                     = json_decode($input_data);
        $params['ticket_id']       = $push->freshdesk_webhook->ticket_id;
        $params['user_email']      = $push->freshdesk_webhook->ticket_contact_email;
        $params['created_at']      = time();
        $params['webhook_content'] = $input_data;
        $params['ip']              = Yii::$app->request->getUserIP();
        $ret                      = Yii::$app->db->createCommand()->insert('new_customer_freshdesk', $params)->execute();
        if ($ret) {
            $data['error_code'] = 0;
            $data['message']    = 'Success!';
            $data['data']       = $ret;
        } else {
            $data['error_code'] = 1;
            $data['message']    = 'Faild!';
            $data['data']       = $ret;
        }
        return $data;
    } catch (\Exception $e) {
        $data['error_code'] = 2;
        $data['message']    = $e->getMessage();
        return $data;
    }
}