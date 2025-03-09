<?php

return [

    'order_status_admin' => [
        'pending' => [
            'status' => 'Chưa xử lí',
            'details' => 'Đơn hàng của bạn đang chờ xử lí!'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Đã xử lý và sẵn sàng vận chuyển',
            'details' => 'Gói hàng của bạn đã được xử lý và sẽ sớm được chuyển đến đối tác giao hàng của chúng tôi'
        ],
        'dropped_off' => [
            'status' => 'Người bán đã gửi hàng',
            'details' => 'Gói hàng của bạn đã được người bán giao đi'
        ],
        'shipped' => [
            'status' => 'Đã vận chuyển',
            'details' => 'Gói hàng của bạn đã đến cơ sở vận chuyển của chúng tôi'
        ],
        'out_for_delivery' => [
            'status' => 'Đang giao hàng',
            'details' => 'Đối tác giao hàng của chúng tôi sẽ cố gắng giao hàng cho bạn'
        ],
        'delivered' => [
            'status' => 'Đã giao hàng',
            'details' => 'Đã giao hàng'
        ],
        'canceled' => [
            'status' => 'Đơn hàng đã hủy',
            'details' => 'Đơn hàng đã hủy'
        ]

    ],


    'order_status_vendor' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your pacakge has been processed and will be with our delivery parter soon'
        ]
    ]
];
