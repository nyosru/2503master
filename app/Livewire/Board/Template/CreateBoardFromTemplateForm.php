<?php

namespace App\Livewire\Board\Template;

use App\Http\Controllers\BoardController;
use App\Models\BoardFieldSetting;
use App\Livewire\Cms2\Leed\LeedBoard;
use App\Models\Board;
use App\Models\BoardTemplate;
use App\Models\BoardUser;
use App\Models\ColumnRole;
use App\Models\OrderRequest;
use App\Models\OrderRequestsRename;
use Livewire\Component;

class CreateBoardFromTemplateForm extends Component
{

    public $template_id;
    public $board_name;

    public function setConfigNewBoard( Board $board , $polya)
    {


        //"id" => 2
        //"board_template_id" => 1
        //"name" => "Машина (марка модель цвет)"
        //"pole" => "string1"
        //"sort" => 80
        //"is_enabled" => true
        //"show_on_start" => true
        //"in_telega_msg" => true
        //"created_at" => "2025-08-18T04:28:30.000000Z"
        //"updated_at" => "2025-08-18T04:28:30.000000Z"
        //]
//        dd($polya);

        foreach( $polya as $pole ) {
            BoardController::setRenamePolya($board->id, $pole['pole'], $pole['name'], '', $pole['sort'],
                $pole['is_enabled'],
                $pole['show_on_start'],
                $pole['in_telega_msg'],
                );
        }

//        BoardController::setRenamePolya( $board->id, 'string1', 'Авто (марка модель цвет)', '', 80, true, true , true );
//        BoardController::setRenamePolya( $board->id, 'string2', 'Причина обращения', '', 75, true, true , true );
//        BoardController::setRenamePolya( $board->id, 'price', 'Цена', '', 50, true, true , false );

//        return;
//
////        $ee = $board->id;
////$ee = 23;
////        $in = Board::with([
////            'fieldSettings',
////            'fieldSettings.orderRequest',
////            'fieldSettings.orderRequest.rename',
////            'roles',
////            'invitations',
////            'domain'
////            ])->find($ee);
////        dump($in->toArray());
//
//        $pole = 'string1';
//
//        $s = BoardFieldSetting::create([
//            'board_id' => $board->id,
//            'field_name' => $pole,
//            'sort_order' => 80, 'is_enabled' => true, 'show_on_start' => true, 'in_telega_msg' => true]);
//
////        $in2 = Board::with([
////            'fieldSettings',
////            'fieldSettings.orderRequest',
////            'fieldSettings.orderRequest.rename',
////            'roles',
////            'invitations',
////            'domain'
////        ])->find($in->id);
////            dump($in2->toArray());
////dd($s);
//
//        $s = BoardFieldSetting::create(['board_id' => $board->id, 'field_name' => $pole, 'sort_order' => 80, 'is_enabled' => true, 'show_on_start' => true, 'in_telega_msg' => true]);
////        dd($s);
//
//        $req = OrderRequest::
//            //addSelect('id')->
//            where('pole',$pole)->first();
////        dd($req);
//
//        BoardController::setRenamePolya( $board->id, $req->id, 'Марка модель цвет 777' , '' );
//
////        order_requests
////        OrderRequest::create([  ]);
//
//        $board_id = $board->id;
//
////        OrderRequestsRename::create([ 'board_id' => $board->id, 'order_requests_id' => $s->id,
////            'name' => 'Марка модель цвет', 'description' => '']);
//
//        $pole = 'string2';
//        $s = BoardFieldSetting::create(['board_id' => $board_id, 'field_name' => $pole, 'sort_order' => 70, 'is_enabled' => true, 'show_on_start' => true, 'in_telega_msg' => true]);
//        $ss = OrderRequest::where('pole',$pole)->first();
//        OrderRequestsRename::create([ 'board_id' => $board_id, 'order_requests_id' => $ss->id,
//            'name' => 'Поломка', 'description' => '']);
//
//
//        $pole = 'price';
//        $s = BoardFieldSetting::create(['board_id' => $board_id, 'field_name' => $pole, 'sort_order' => 60, 'is_enabled' => true, 'show_on_start' => true, 'in_telega_msg' => true]);
//        $ss = OrderRequest::where('pole',$pole)->first();
//        OrderRequestsRename::create([ 'board_id' => $board_id, 'order_requests_id' => $ss->id,
//            'name' => 'Цена', 'description' => '']);
//
//
//        $pole = 'phone';
//        $s = BoardFieldSetting::create(['board_id' => $board_id, 'field_name' => $pole, 'sort_order' => 40, 'is_enabled' => true, 'show_on_start' => true, 'in_telega_msg' => true]);
//        $ss = OrderRequest::where('pole',$pole)->first();
//        OrderRequestsRename::create([ 'board_id' => $board_id, 'order_requests_id' => $ss->id,
//            'name' => 'Телефон', 'description' => '']);
//
//        $pole = 'fio';
//        $s = BoardFieldSetting::create(['board_id' => $board_id, 'field_name' => $pole, 'sort_order' => 45, 'is_enabled' => true, 'show_on_start' => true, 'in_telega_msg' => true]);
//        $ss = OrderRequest::where('pole',$pole)->first();
//        OrderRequestsRename::create([ 'board_id' => $board_id, 'order_requests_id' => $ss->id,
//            'name' => 'ФИО Клиент', 'description' => '']);

    }


    public function createBoardFromShablon($template_id)
    {


        $template = BoardTemplate::where('id', $template_id)
            ->with([
                'columns' => function ($query) {
                    $query->orderBy('sorting', 'asc');
                },
                'positions',
                'polya'
            ])
            ->first();

//        foreach( $template->positions as $position ){
//            dump($position);
//        }

//        foreach ($template->columns as $column) {
//            dump($column);
//        }

//        dd($template->toArray());

        //        dd($this->board_name);

        $newBoard = Board::create([
            'name' => $this->board_name,
            'admin_user_id' => auth()->user()->id
        ]);


        $this->setConfigNewBoard($newBoard,$template->polya->toArray());

        foreach ($template->positions as $position) {
//            dump($position);
            $new_position = $newBoard->role()->create([
                'name' => $position->name . date('ymdhis'),
                'name_ru' => $position->name,
                'guard_name' => 'web',
                'board_id' => $newBoard->id
            ]);

        }

        BoardUser::create([
            'board_id' => $newBoard->id,
            'user_id' => auth()->user()->id,
            'role_id' => $new_position->id,
        ]);

        $sort = 1;
        $start = true;

        foreach ($template->columns as $column) {
//            dump($column);

            $datain_col = [
                'name' => $column->name,
                'order' => $sort,
            ];

            if ($start) {
                $datain_col['can_create'] = true;
                $start = false;
            }

            $columnNew = $newBoard->columns()->create($datain_col);

            ColumnRole::create([
                'column_id' => $columnNew->id,
                'role_id' => $new_position->id,
            ]);

            $sort += 2;
        }

        BoardController::enterAs($newBoard->id, $new_position->id);

        session()->flash('createBoardGoodFromTemplate', 'Доска создана, настраивайте шаги, проведите тест драйв!');

        return redirect()->route('leed', [
            'board_id' => $newBoard->id
        ]);


    }

    public function render()
    {
        return view('livewire.board.template.create-board-from-template-form');
    }

}
