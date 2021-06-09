<?php
  if (!isset($_REQUEST)) {
    return;
  }

  $my_id = '374811416';
  $my_token = 'd5ff3fc7f302a1a42ebf0141d95ece13dfb7eac47c6a29a934fb8aceedb6261090ab60b7337117a838dfb';

  $group_id = '68473974';
  $peer_id = '2000000005';
  $chat_id = '105';

  $confirmation_token = 'df762773';

  $token = 'c273134bc2e4a479c7c23a8a1fc25098f67485b09b5016c3dcf0f9308e1ed77887bc5bc3d770781523650';

  $data = json_decode(file_get_contents('php://input'));

  switch ($data->type) {
    case 'confirmation':
      echo $confirmation_token;
    break;

    case 'group_join':

        $user_id = $data->object->user_id;

        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));

        $first_name = $user_info->response[0]->first_name;
        $last_name = $user_info->response[0]->last_name;
        $user_name = "{$first_name}" . " {$last_name}";

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#9989;@id{$user_id} ({$user_name}) вступил(а) в сообщество",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'group_leave':

        $user_id = $data->object->user_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));

        $first_name = $user_info->response[0]->first_name;
        $last_name = $user_info->response[0]->last_name;
        $user_name = "{$first_name}" . " {$last_name}";

        switch ($data->object->self) {
          case '1':
            $self = 'покинул(а) сообщество';
          break;
          case '0':
            $self = 'удален(а) из сообщества';
          break;
        }

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#10060;@id{$user_id} ({$user_name}) {$self}",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'user_block':

        $user_id = $data->object->user_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));
        $user_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $admin_id = $data->object->admin_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$admin_id}&access_token={$token}&v=5.92"));
        $admin_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $unblock_date = $data->object->unblock_date;

        switch ($data->object->reason) {
          case '0':
            $reason = 'другое';
          break;
          case '1':
            $reason = 'спам';
          break;
          case '2':
            $reason = 'оскорбление участников';
          break;
          case '3':
            $reason = 'нецензурные выражения';
          break;
          case '4':
            $reason = 'сообщения не по теме';
          break;
        }

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#128683;@id{$admin_id} ({$admin_name}) заблокировал пользователя @id{$user_id} ({$user_name}). Причина: {$reason}",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'user_unblock':

        $user_id = $data->object->user_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));
        $user_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $admin_id = $data->object->admin_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$admin_id}&access_token={$token}&v=5.92"));
        $admin_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#10062;@id{$user_id} ({$user_name}) был разблокирован",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'group_officers_edit':

        $user_id = $data->object->user_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));
        $user_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $admin_id = $data->object->admin_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$admin_id}&access_token={$token}&v=5.92"));
        $admin_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        switch ($data->object->level_old) {
          case '0':
            $level_old = 'Участник';
          break;
          case '1':
            $level_old = 'Модератор';
          break;
          case '2':
            $level_old = 'Редактор';
          break;
          case '3':
            $level_old = 'Администратор';
          break;
        }

        switch ($data->object->level_new) {
          case '0':
            $level_new = 'Участник';
          break;
          case '1':
            $level_new = 'Модератор';
          break;
          case '2':
            $level_new = 'Редактор';
          break;
          case '3':
            $level_new = 'Администратор';
          break;
        }

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#10071;@id{$admin_id} ({$admin_name}) изменил(а) права @id{$user_id} ({$user_name}):<br>".
          "{$level_old} > {$level_new}",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);
        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'message_new':

        $user_id = $data->object->from_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));
        $user_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $text = $data->object->text;

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#128229;@id{$user_id} ({$user_name}) написал(а) новое сообщение: {$text}",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'message_reply':

        $user_id = $data->object->peer_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));
        $user_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $text = $data->object->text;

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#128228;Руководитель отправил для @id{$user_id} ({$user_name}) сообщение от имени группы: {$text}",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

    case 'vkpay_transaction':

        $user_id = $data->object->from_id;
        $user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.92"));
        $user_name = "{$user_info->response[0]->first_name}" . " {$user_info->response[0]->last_name}";

        $amount = $data->object->amount;
        $description = $data->object->description;

        $request_params = array(
          'random_id' => mt_rand(1000,9999),
          'peer_id' => $peer_id,
          'chat_id' => $chat_id,
          'message' => "&#128179;@id{$user_id} ({$user_name}) перевёл {$amount}р в сообщество",
          'group_id' => $group_id,
          'access_token' => $token,
          'v' => '5.92'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);

        echo('ok');

    break;

  }
?>
