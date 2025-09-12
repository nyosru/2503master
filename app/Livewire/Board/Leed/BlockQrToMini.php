<?php

namespace App\Livewire\Board\Leed;

use App\Http\Controllers\LeedController;
use App\Http\Controllers\Services\QrCodeService;
use Livewire\Component;

class BlockQrToMini extends Component
{

    public $qrCode;
    public $link;
    public $leed_id;
    public $board_id;

    public function mount(){
        $qrService = new QrCodeService();
        $this->link = LeedController::createLinkToMini( $this->board_id, $this->leed_id );
        $this->qrCode = $qrService->generateQrCode($this->link, 200);
    }

    public function render()
    {
        return view('livewire.board.leed.block-qr-to-mini');
    }
}
