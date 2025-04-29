<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{

    public static $polya_config = [];


    public static function getPolyaConfig()
    {

        self::$polya_config[] = ['pole' => 'name', 'name' => 'Название', 'validate' => 'nullable|string|max:255' ];
        self::$polya_config[] = ['pole' => 'company', 'name' => 'Компания', 'validate' => 'nullable|string|max:255' ];

        self::$polya_config[] = ['pole' => 'cooperativ', 'name' => 'Кооператив', 'validate' => 'nullable|string|max:255' ];

        self::$polya_config[] = ['pole' => 'platform', 'name' => 'Платформа', 'validate' => 'nullable|string|max:255' ];
        self::$polya_config[] = ['pole' => 'link', 'name' => 'Ссылка', 'validate' => 'nullable|string' ];

        self::$polya_config[] = ['pole' => 'base_number', 'name' => 'Номер', 'validate' => 'nullable|string|max:255' ];

        self::$polya_config[] = ['pole' => 'fio', 'name' => 'ФИО', 'validate' => 'nullable|string|max:255' ];
        self::$polya_config[] = ['pole' => 'phone', 'name' => 'Телефон', 'validate' => 'nullable|string|max:20' ];

        self::$polya_config[] = ['pole' => 'fio2', 'name' => 'ФИО2', 'validate' => 'nullable|string|max:255' ];
        self::$polya_config[] = ['pole' => 'phone2', 'name' => 'Телефон2', 'validate' => 'nullable|integer' ];

        self::$polya_config[] = ['pole' => 'telegram', 'name' => 'Телеграм id', 'validate' => 'nullable|string|max:255' ];
        self::$polya_config[] = ['pole' => 'whatsapp', 'name' => 'WatsApp id', 'validate' => 'nullable|string|max:255' ];

        self::$polya_config[] = ['pole' => 'date_start', 'name' => 'Дата старта', 'validate' => 'nullable|date' ];
        self::$polya_config[] = ['pole' => 'comment', 'name' => 'Комментарий', 'validate' => 'nullable|string|max:1000' ];

        self::$polya_config[] = ['pole' => 'budget', 'name' => 'Бюджет', 'validate' => 'nullable|integer' ];
        self::$polya_config[] = ['pole' => 'price', 'name' => 'Цена', 'validate' => 'nullable|integer' ];

        self::$polya_config[] = ['pole' => 'order_product_types_id', 'name' => 'Тип продукта', 'validate' => 'nullable|exists:order_product_types,id' ];

        self::$polya_config[] = ['pole' => 'customer', 'name' => 'Пользователь', 'validate' => 'nullable|string' ];
        self::$polya_config[] = ['pole' => 'payment_due_date', 'name' => 'Дата после оплаты', 'validate' => 'nullable|date' ];
        self::$polya_config[] = ['pole' => 'submit_before', 'name' => 'Подать до', 'validate' => 'nullable|integer' ];

        self::$polya_config[] = ['pole' => 'pay_day_every_year', 'name' => 'Оплата ежегодно', 'validate' => 'nullable|date' ];
        self::$polya_config[] = ['pole' => 'pay_day_every_month', 'name' => 'Оплата ежемесячно', 'validate' => 'nullable|integer' ];

//2. эл.почта заказчика
        self::$polya_config[] = ['pole' => 'email', 'name' => 'E-mail заказчика', 'validate' => 'nullable|string' ];
//3. название переделать в предмет тендера
        self::$polya_config[] = ['pole' => 'obj_tender', 'name' => 'предмет тендера', 'validate' => 'nullable|string' ];
//4. Заказчик
        self::$polya_config[] = ['pole' => 'zakazchick', 'name' => 'Заказчик', 'validate' => 'nullable|string' ];
//5.  срок поставки от и до (45-60 дней)
        self::$polya_config[] = ['pole' => 'post_day_ot', 'name' => 'срок поставки от', 'validate' => 'nullable|integer' ]; // , 'name' => 'Цена', 'validate' => '' ];
        self::$polya_config[] = ['pole' => 'post_day_do', 'name' => 'срок поставки до', 'validate' => 'nullable|integer' ]; // , 'name' => 'Цена', 'validate' => '' ];
//6. место поставки
        self::$polya_config[] = ['pole' => 'mesto_dostavki', 'name' => 'место поставки', 'validate' => 'nullable|string' ];


        return self::$polya_config;

    }

    public static function goto($board_id, $role_id)
    {
//        dd($board_id, $role_id);

        $user = Auth::user();

        $boards = Board::whereHas('boardUsers', function ($query) use ($user, $role_id, $board_id) {
            $query->where('user_id', $user->id);
            $query->where('role_id', $role_id);
            $query->where('board_id', $board_id);
        })
            ->get();

        if (!$boards->count()) {
            session()->flash('errorNoAccess', 'Что то произошло эмпирическое, или У вас нет доступа к этой доске');
            return redirect()->back();
        }

        UserController::setCurentBoard($user->id, $board_id);
//        UserController::setCurentBoard($user->id, $boards->id);
        UserController::updateRole($user->id, $role_id);

        return redirect()->route('leed', ['board_id' => $board_id]);

//        dd($boards->toArray());
//        dd([$board_id,$role_id,$user->id]);

    }

    public static function CreateBoard($user_id, $new_board_name = null)
    {

        $user = User::with('boardUser')->select('id')->findOrFail($user_id);

//        dd($user->toArray());

        Board::create(['name' => ($new_board_name ?? 'Новая доска ' . date('ymdHis'))]);

//        $user->boardUser()->create([
//            'board_id' => $user->board()->create([
//                'name' => $new_board_name ?? 'Новая доска '.date('ymdHis'),
////                'color' => '#000000',
//            ])->id,
//        ]);

        dd($user->toArray());

    }

    /**
     * получаем список связей пользоатель доска
     * @param $board_id
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getBoardUser($board_id = null, $user_id = null, $type = 'mini')
    {
        $return = BoardUser::with([
            'board' => function ($query) use ($board_id, $user_id, $type) {
                $query->withTrashed();
                if ($type == 'mini') {
                    $query->select('id', 'name', 'deleted_at');
                }
            },
            'user' => function ($query) use ($board_id, $user_id, $type) {
                $query->withTrashed();
                if (!empty($user_id)) {
                    $query->whereId($user_id);
                }
                if ($type == 'mini') {
                    $query->select('id', 'name', 'phone_number', 'deleted_at');
                }
            },
//            'role' => function ($query)  use ($board_id,$user_id,$type) {
//                $query->withTrashed();
//                if( $type == 'mini' ){$query->select('id','name','deleted_at');}
//            },
        ])
            ->where(function ($query) use ($board_id) {
                if (!empty($board_id)) {
                    $query->whereBoardId($board_id);
                }
            })

//            ->distinct('user_id')
//            ->pluck('user_id')
//            ->groupBy('user_id')
//            ->select('board_users.*', DB::raw('MIN(board_users.id) as id'))

            ->get();
        return $return;
    }

    public
    static function getCurrentBoard($user_id, $new_board_id = null)
    {

        $user = User::with([
            'boardUser',
            'boardUser.board',
//            'boardUser.board' => function($query) use ($new_board_id) {
//                $query->whereId($new_board_id);
//            },
            'boardUser.role',
        ])->findOrFail($user_id);

//            dd($user->toArray());

        if (!empty($user->boardUser)) {
            foreach ($user->boardUser as $board) {
                if (empty($new_board_id) || $board->board_id == $new_board_id) {
                    $user->current_board_id = $board->board_id;
                    $user->save();
//                    $user->assignRole($board->role_id);
                    $user->roles()->sync([$board->role_id]);
                    return $board->board_id;
                }
            }
//        }elseif (sizeof($user->boardUser) == 1) {
//            $user->current_board_id = $user->boardUser[0]->board_id;
//            $user->save();
//            $user->assignRole($user->boardUser[0]->role->id);
//            return $user->boardUser[0]->id;
        }

        return false;
    }
}
