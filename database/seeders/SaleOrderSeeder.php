<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaleOrder;
use Carbon\Carbon;

class SaleOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (SaleOrder::count() > 0) {
            return;
        }

        $sampleOrders = [
            [
                'order_id' => 'GM-9A4B12',
                'customer_name' => 'Alex "Apex" Rivera',
                'customer_email' => 'alex.rivera@esports.gg',
                'customer_phone' => '+1 (555) 349-8120',
                'shipping_address' => '742 Evergreen Terrace, Apt 4B',
                'city' => 'Neo Seattle',
                'postal_code' => '98101',
                'payment_method' => 'Credit Card',
                'payment_status' => 'Paid',
                'order_status' => 'Delivered',
                'subtotal' => 389.98,
                'discount' => 38.99,
                'shipping_fee' => 0.00,
                'total_amount' => 350.99,
                'promo_code' => 'GAMER10',
                'items_json' => [
                    [
                        'id' => 'prod-1',
                        'name' => 'CyberStrike Mech Keyboard (Optical RGB)',
                        'price' => 149.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ],
                    [
                        'id' => 'prod-2',
                        'name' => 'AeroPulse 7.1 Wireless Headset',
                        'price' => 199.99,
                        'qty' => 1,
                        'image' => 'slider2.jpg'
                    ],
                    [
                        'id' => 'prod-3',
                        'name' => 'TitanV Ultra Mouse Pad XL',
                        'price' => 39.99,
                        'qty' => 1,
                        'image' => 'slider3.jpg'
                    ]
                ],
                'notes' => 'Customer requested leave at front door with signature.',
                'created_at' => Carbon::now()->subDays(5)->setTime(14, 22),
            ],
            [
                'order_id' => 'GM-8B2F64',
                'customer_name' => 'Sarah "Valkyrie" Chen',
                'customer_email' => 'sarah.chen@streamerhub.io',
                'customer_phone' => '+1 (555) 782-9011',
                'shipping_address' => '1200 Neon District Blvd, Suite 800',
                'city' => 'San Francisco',
                'postal_code' => '94105',
                'payment_method' => 'PayPal',
                'payment_status' => 'Paid',
                'order_status' => 'Shipped',
                'subtotal' => 289.98,
                'discount' => 0.00,
                'shipping_fee' => 0.00,
                'total_amount' => 289.98,
                'promo_code' => null,
                'items_json' => [
                    [
                        'id' => 'prod-4',
                        'name' => 'TitanV Precision Wireless Mouse 26K DPI',
                        'price' => 89.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ],
                    [
                        'id' => 'prod-2',
                        'name' => 'AeroPulse 7.1 Wireless Headset',
                        'price' => 199.99,
                        'qty' => 1,
                        'image' => 'slider2.jpg'
                    ]
                ],
                'notes' => 'Priority Express Shipping applied.',
                'created_at' => Carbon::now()->subDays(3)->setTime(10, 15),
            ],
            [
                'order_id' => 'GM-7C3E81',
                'customer_name' => 'Marcus Vance',
                'customer_email' => 'm.vance@gamingrigs.net',
                'customer_phone' => '+1 (555) 412-6700',
                'shipping_address' => '404 Glitch Avenue',
                'city' => 'Austin',
                'postal_code' => '78701',
                'payment_method' => 'Credit Card',
                'payment_status' => 'Paid',
                'order_status' => 'Processing',
                'subtotal' => 149.99,
                'discount' => 30.00,
                'shipping_fee' => 9.99,
                'total_amount' => 129.98,
                'promo_code' => 'VIP20',
                'items_json' => [
                    [
                        'id' => 'prod-1',
                        'name' => 'CyberStrike Mech Keyboard (Optical RGB)',
                        'price' => 149.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ]
                ],
                'notes' => 'Gift wrapping requested for tournament prize.',
                'created_at' => Carbon::now()->subDays(1)->setTime(18, 45),
            ],
            [
                'order_id' => 'GM-6D1A95',
                'customer_name' => 'Elena "Nyx" Rostova',
                'customer_email' => 'nyx.gamer@frostbyte.org',
                'customer_phone' => '+1 (555) 901-2345',
                'shipping_address' => '88 Cyberpunk Way',
                'city' => 'Chicago',
                'postal_code' => '60601',
                'payment_method' => 'Cash on Delivery',
                'payment_status' => 'Pending',
                'order_status' => 'Pending',
                'subtotal' => 89.99,
                'discount' => 0.00,
                'shipping_fee' => 9.99,
                'total_amount' => 99.98,
                'promo_code' => null,
                'items_json' => [
                    [
                        'id' => 'prod-4',
                        'name' => 'TitanV Precision Wireless Mouse 26K DPI',
                        'price' => 89.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ]
                ],
                'notes' => 'Collect cash upon courier delivery.',
                'created_at' => Carbon::now()->subHours(6)->setTime(9, 30),
            ],
            [
                'order_id' => 'GM-5E9F30',
                'customer_name' => 'Daisuke Takahashi',
                'customer_email' => 'daisuke.t@tokyo-esports.jp',
                'customer_phone' => '+1 (555) 667-8899',
                'shipping_address' => '500 Akihabara Crossing',
                'city' => 'Los Angeles',
                'postal_code' => '90012',
                'payment_method' => 'Credit Card',
                'payment_status' => 'Paid',
                'order_status' => 'Delivered',
                'subtotal' => 439.97,
                'discount' => 43.99,
                'shipping_fee' => 0.00,
                'total_amount' => 395.98,
                'promo_code' => 'GAMER10',
                'items_json' => [
                    [
                        'id' => 'prod-1',
                        'name' => 'CyberStrike Mech Keyboard (Optical RGB)',
                        'price' => 149.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ],
                    [
                        'id' => 'prod-2',
                        'name' => 'AeroPulse 7.1 Wireless Headset',
                        'price' => 199.99,
                        'qty' => 1,
                        'image' => 'slider2.jpg'
                    ],
                    [
                        'id' => 'prod-4',
                        'name' => 'TitanV Precision Wireless Mouse 26K DPI',
                        'price' => 89.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ]
                ],
                'notes' => null,
                'created_at' => Carbon::now()->subDays(7)->setTime(16, 10),
            ],
            [
                'order_id' => 'GM-4F8C19',
                'customer_name' => 'Lucas Morales',
                'customer_email' => 'lucas.m@battlestation.dev',
                'customer_phone' => '+1 (555) 234-5678',
                'shipping_address' => '312 Horizon Peak Rd',
                'city' => 'Denver',
                'postal_code' => '80202',
                'payment_method' => 'Credit Card',
                'payment_status' => 'Refunded',
                'order_status' => 'Cancelled',
                'subtotal' => 149.99,
                'discount' => 0.00,
                'shipping_fee' => 9.99,
                'total_amount' => 159.98,
                'promo_code' => null,
                'items_json' => [
                    [
                        'id' => 'prod-1',
                        'name' => 'CyberStrike Mech Keyboard (Optical RGB)',
                        'price' => 149.99,
                        'qty' => 1,
                        'image' => 'slider1.jpg'
                    ]
                ],
                'notes' => 'Customer cancelled order before dispatch. Refund processed.',
                'created_at' => Carbon::now()->subDays(9)->setTime(11, 00),
            ]
        ];

        foreach ($sampleOrders as $data) {
            SaleOrder::create($data);
        }
    }
}
