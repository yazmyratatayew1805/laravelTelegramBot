<?php

namespace App\Http\Controllers;


use App\Events\OrderStore;
use App\Helpers\Telegram;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class OrderController extends Controller
{

    public function store(Order $order, Request $request)
    {
        $key = base64_encode(md5(uniqid()));
        $order = $order->create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email2'),
                'product' => $request->input('product'),
                'secret_key' => $key,
            ]
        );

        event(new OrderStore($order));

        return response()->redirectTo('/');
    }

    public function hello(Telegram $telegram)
    {
        $telegram->sendMessage(env('REPORT_TELEGRAM_ID'), "Приветстую, я АликассаБот чем могу помочь?");
    }

    public function feedback(Telegram $telegram)
    {
        $message = "Ваш вопрос решен?";
        $buttons = [
            'inline_keyboard' =>
                [
                    [
                        [
                            'text' => 'Да',
                            'callback_data' => '1',
                        ],
                        [
                            'text' => 'Нет',
                            'callback_data' => '0',
                        ],
                    ]
                ]
        ];
        $response = $telegram->sendButtons(env('REPORT_TELEGRAM_ID'), $message, json_encode($buttons));
        $response = json_decode($response);
        dd($response);
    }

    public function sethook()
    {
        $data = \Illuminate\Support\Facades\Http::get('https://api.tlgr.org/bot5965018390:AAGYicoLTnJvhjcfVwdsj0idAAVlOjQe8ec/getWebhookInfo');
        dd(json_decode($data->body()));
    }


}
